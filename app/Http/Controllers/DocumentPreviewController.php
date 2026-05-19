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
     *  - Gambar → di-stream dengan Content-Disposition: inline (browser render langsung)
     *  - Lainnya → download (Content-Disposition: attachment)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\RedirectResponse
     */
    public function preview(Request $request)
    {
        // Ambil path dari query string, contoh: ?path=uploads/customer_documents/xxx.pdf
        $path = $request->query('path');

        if (!$path) {
            abort(404, 'Path dokumen tidak ditemukan.');
        }

        // Cegah path traversal
        $path = Str::of($path)->ltrim('/')->toString();
        if (Str::contains($path, ['..', '//'])) {
            abort(403, 'Akses ditolak.');
        }

        // Tentukan full path file. Coba di public_path terlebih dahulu (karena kita simpan uploads di public)
        $fullPath = public_path($path);

        if (!file_exists($fullPath)) {
            // Coba di storage disk public
            if (Storage::disk('public')->exists($path)) {
                $fullPath = Storage::disk('public')->path($path);
            } else {
                abort(404, 'File tidak ditemukan.');
            }
        }

        $ext        = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
        $fileName   = basename($fullPath);

        $imageExts  = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'];
        $pdfExts    = ['pdf'];

        $mimeType = 'application/octet-stream';
        if (in_array($ext, $pdfExts)) {
            $mimeType = 'application/pdf';
        } elseif (in_array($ext, $imageExts)) {
            $mimeType = 'image/' . ($ext === 'jpg' ? 'jpeg' : $ext);
        }

        // Kembalikan response inline agar dirender langsung oleh browser di tab baru
        return response()->file($fullPath, [
            'Content-Type'        => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
            'X-Frame-Options'     => 'SAMEORIGIN',
        ]);
    }
}
