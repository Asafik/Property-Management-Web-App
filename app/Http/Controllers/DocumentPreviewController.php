<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class DocumentPreviewController extends Controller
{
    /**
     * Preview / stream dokumen KPR di tab baru.
     *
     * Cara kerja:
     *  - PDF  → di-stream dengan Content-Disposition: inline (browser render langsung)
     *  - Gambar → redirect ke URL storage (langsung tampil di tab baru)
     *  - Lainnya → download (Content-Disposition: attachment)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function preview(Request $request)
    {
        // Ambil path dari query string, contoh: ?path=kpr/dokumen/xxx.pdf
        $path = $request->query('path');

        if (!$path) {
            abort(404, 'Path dokumen tidak ditemukan.');
        }

        // Cegah path traversal
        $path = Str::of($path)->ltrim('/')->toString();
        if (Str::contains($path, ['..', '//'])) {
            abort(403, 'Akses ditolak.');
        }

        // Pastikan file ada di storage
        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        $fullPath   = Storage::disk('public')->path($path);
        $ext        = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        $fileName   = basename($path);

        $imageExts  = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
        $pdfExts    = ['pdf'];

        if (in_array($ext, $pdfExts)) {
            // Stream PDF inline → browser render langsung di tab baru
            return response()->file($fullPath, [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $fileName . '"',
                'X-Frame-Options'     => 'SAMEORIGIN',
            ]);
        }

        if (in_array($ext, $imageExts)) {
            // Untuk gambar, cukup redirect ke URL storage publik
            return redirect(asset('storage/' . $path));
        }

        // File lain → download
        return response()->download($fullPath, $fileName);
    }
}
