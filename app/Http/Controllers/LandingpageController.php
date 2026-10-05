<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Guest;
use App\Models\LandBank;
use App\Models\LandBankUnit;
use App\Models\Employee;
use App\Models\MarketingTask;

class LandingpageController extends Controller
{
    public function index()
    {
        // Filter unit: Hanya yang diposting (is_published), kondisi tersedia (ready), dan bangunan 100% (selesai)
        $unitFilterKondisi = function ($q) {
            $q->where(function ($sub) {
                $sub->whereIn('status', ['ready', 'tersedia', 'available'])
                    ->orWhereNull('status');
            })
            ->where(function ($sub) {
                $sub->whereIn('construction_progress', ['selesai', '100', '100%'])
                    ->orWhere('construction_progress', 'LIKE', '%100%');
            });
        };

        $publishedUnits = LandBankUnit::with(['landBank', 'landingPage'])
            ->whereHas('landingPage', function ($q) {
                $q->where('is_published', true);
            })
            ->where($unitFilterKondisi)
            ->orderBy('updated_at', 'desc')
            ->get();

        $landBanks = LandBank::withCount([
            'units' => function ($q) use ($unitFilterKondisi) {
                $q->whereHas('landingPage', function ($sub) {
                    $sub->where('is_published', true);
                })
                ->where($unitFilterKondisi);
            }
        ])
        ->with([
            'units' => function ($q) use ($unitFilterKondisi) {
                $q->whereHas('landingPage', function ($sub) {
                    $sub->where('is_published', true);
                })
                ->where($unitFilterKondisi);
            }
        ])
        ->orderBy('name', 'asc')
        ->get();

        return view('home.index', compact('publishedUnits', 'landBanks'));
    }

    /**
     * Halaman Detail Publik Unit Perumahan Dinamis
     */
    public function detail($id = null)
    {
        if ($id) {
            $unit = LandBankUnit::with(['landBank', 'landingPage'])->find($id);
        } else {
            // Ambil unit pertama yang ditayangkan di website
            $unit = LandBankUnit::with(['landBank', 'landingPage'])
                ->whereHas('landingPage', function ($q) {
                    $q->where('is_published', true);
                })
                ->first();

            if (!$unit) {
                $unit = LandBankUnit::with(['landBank', 'landingPage'])->first();
            }
        }

        if (!$unit) {
            return redirect()->route('landingpage')->with('error', 'Unit properti tidak ditemukan.');
        }

        $lp = $unit->landingPage;

        // Helper Resolve Foto
        $resolveImgUrl = function ($path) {
            if (empty($path)) return null;
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) return $path;
            if (file_exists(public_path($path))) return asset($path);
            return asset('storage/' . ltrim($path, '/'));
        };

        $defaultPlaceholder = 'https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg?auto=compress&cs=tinysrgb&w=1200&h=600&fit=crop';
        $mainPhoto = $resolveImgUrl($unit->photo) ?: $defaultPlaceholder;

        $galleryPhotos = [];
        if ($lp && is_array($lp->gallery) && count($lp->gallery) > 0) {
            foreach ($lp->gallery as $gPath) {
                if ($resolved = $resolveImgUrl($gPath)) {
                    $galleryPhotos[] = $resolved;
                }
            }
        }

        // Susun 4 slot foto (Foto utama + galeri)
        $allPhotos = array_merge([$mainPhoto], $galleryPhotos);
        while (count($allPhotos) < 4) {
            $allPhotos[] = $mainPhoto;
        }
        $allPhotos = array_slice($allPhotos, 0, 4);

        // Rekomendasi unit lainnya yang juga berstatus tayang
        $otherUnits = LandBankUnit::with(['landBank', 'landingPage'])
            ->where('id', '!=', $unit->id)
            ->whereHas('landingPage', function ($q) {
                $q->where('is_published', true);
            })
            ->take(3)
            ->get();

        return view('home.detail', compact('unit', 'lp', 'mainPhoto', 'allPhotos', 'otherUnits', 'resolveImgUrl'));
    }

    /**
     * Tampilkan Halaman Mandiri Formulir Buku Tamu / Data Tamu Prospek
     */
    public function bukuTamu(Request $request)
    {
        $projects = LandBank::with('units')->get();
        $units = LandBankUnit::all();
        $agents = Employee::where('position_id', 2)->get();
        if ($agents->isEmpty()) {
            $agents = Employee::all();
        }
        // Hanya tampilkan tugas kategori "proyeksi" di buku tamu landing page
        $marketingTasks = MarketingTask::where('kategori', \App\Models\MarketingTask::KATEGORI_PROYEKSI)
                            ->orderBy('nama_tugas')
                            ->get();

        $selectedProjectId = $request->get('project_id', $projects->first()->id ?? null);
        $selectedUnitId = $request->get('unit_id', null);
        $currentUnit = null;

        if ($selectedUnitId) {
            $currentUnit = LandBankUnit::with('landBank')->find($selectedUnitId);
            if ($currentUnit) {
                $selectedProjectId = $currentUnit->land_bank_id;
                $unitName = ($currentUnit->unit_name ?: 'Unit ' . $currentUnit->unit_code) . ' (' . ($currentUnit->landBank->name ?? 'Perumahan') . ')';
            }
        }

        if (!isset($unitName) || empty($unitName)) {
            $unitName = $request->get('unit', 'Unit Siap Huni');
        }

        $selectedAgentId = $request->get('agent_id', $request->get('assigned_to', null));

        // Cari tugas kategori "proyeksi" (Proyeksi / Akuisisi Tamu)
        $defaultMarketingTaskId = null;
        if ($selectedAgentId) {
            $agentTask = MarketingTask::where('kategori', MarketingTask::KATEGORI_PROYEKSI)
                ->where('employee_id', $selectedAgentId)
                ->where('status', '!=', 'Selesai')
                ->latest()
                ->first();
            if ($agentTask) {
                $defaultMarketingTaskId = $agentTask->id;
            }
        }

        if (!$defaultMarketingTaskId) {
            $matchedTask = $marketingTasks->first(function ($t) {
                return str_contains(strtolower($t->nama_tugas), 'cari calon pembeli') || str_contains(strtolower($t->nama_tugas), 'pembeli') || str_contains(strtolower($t->nama_tugas), 'akuisisi');
            });
            $defaultMarketingTaskId = $matchedTask ? $matchedTask->id : ($marketingTasks->first()->id ?? null);
        }

        return view('home.buku-tamu', compact(
            'projects',
            'units',
            'agents',
            'marketingTasks',
            'selectedProjectId',
            'selectedUnitId',
            'selectedAgentId',
            'currentUnit',
            'unitName',
            'defaultMarketingTaskId'
        ));
    }

    /**
     * Simpan Pengisian Buku Tamu Web Langsung ke Database CRM (Tabel Guests / Tamu Prospek)
     * Format field persis sama dengan TamuController::store
     */
    public function storeBukuTamu(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'phone'             => 'required|string|max:50',
            'email'             => 'nullable|email|max:255',
            'source'            => 'required',
            'marketing_task_id' => 'nullable|exists:marketing_tasks,id',
            'land_bank_id'      => 'required|exists:land_banks,id',
            'unit_id'           => 'nullable|exists:land_bank_units,id',
            'status'            => 'required',
            'assigned_to'       => 'nullable|exists:employees,id',
            'next_follow_up'    => 'required|date',
            'budget'            => 'nullable',
            'notes'             => 'nullable|string|max:1000',
        ]);

        // Siapkan Assigned To (Agent default jika tidak dipilih)
        $assignedTo = $request->assigned_to;
        if (!$assignedTo) {
            $defaultAgent = Employee::where('position_id', 2)->first() ?? Employee::first();
            $assignedTo = $defaultAgent ? $defaultAgent->id : null;
        }

        // Tentukan tugas marketing: Harus kategori Proyeksi / Akuisisi Tamu
        $marketingTaskId = $request->marketing_task_id;
        if ($assignedTo) {
            // Prioritaskan tugas proyeksi aktif milik agent/staff terpilih
            $staffTask = MarketingTask::where('kategori', MarketingTask::KATEGORI_PROYEKSI)
                ->where('employee_id', $assignedTo)
                ->where('status', '!=', 'Selesai')
                ->latest()
                ->first();
            if ($staffTask) {
                $marketingTaskId = $staffTask->id;
            }
        }

        // Jika belum ada, gunakan tugas proyeksi aktif yang tersedia
        if (!$marketingTaskId) {
            $defaultTask = MarketingTask::where('kategori', MarketingTask::KATEGORI_PROYEKSI)
                ->where('status', '!=', 'Selesai')
                ->latest()
                ->first()
                ?? MarketingTask::where('kategori', MarketingTask::KATEGORI_PROYEKSI)->first();
            $marketingTaskId = $defaultTask?->id;
        }

        // Susun Catatan & Budget
        $cleanBudget = null;
        if ($request->filled('budget')) {
            $cleanBudget = preg_replace('/\D/', '', $request->budget);
        }

        $notesFinal = $request->notes ?? '';
        if ($cleanBudget) {
            $budgetFormatted = 'Rp ' . number_format((float)$cleanBudget, 0, ',', '.');
            $notesFinal = trim("Budget: " . $budgetFormatted . ($notesFinal ? "\n" . $notesFinal : ""));
        }

        // Simpan persis ke Tabel Guests
        $guest = Guest::create([
            'name'              => $request->name,
            'marketing_task_id' => $marketingTaskId,
            'phone'             => $request->phone,
            'email'             => $request->email ?: null,
            'source'            => $request->source,
            'land_bank_id'      => $request->land_bank_id,
            'unit_id'           => $request->unit_id ?: null,
            'notes'             => $notesFinal ?: null,
            'status'            => $request->status,
            'assigned_to'       => $assignedTo,
            'last_follow_up'    => now(),
            'next_follow_up'    => $request->next_follow_up,
        ]);

        return redirect()->route('home.buku-tamu')->with('success', [
            'name'  => $guest->name,
            'phone' => $guest->phone,
            'id'    => $guest->id,
            'msg'   => 'Terima kasih, ' . $guest->name . '! Data tamu / prospek Anda telah resmi tersimpan di sistem Graha Cipta Sejahtera.'
        ]);
    }
}
