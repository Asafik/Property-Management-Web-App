<?php

if (!function_exists('resolveFileUrl')) {
    /**
     * Helper universal untuk mengatasi variasi path uploads, storage, dokumen, dll
     *
     * @param string|null $path
     * @return string
     */
    function resolveFileUrl(?string $path): string
    {
        if (empty($path)) {
            return '';
        }

        // Jika sudah URL lengkap (http:// atau https://)
        if (preg_match('/^https?:\/\//i', $path)) {
            return $path;
        }

        // Hapus slash di awal
        $cleanPath = ltrim($path, '/');

        // 1. Cek langsung di public_path($cleanPath)
        if (file_exists(public_path($cleanPath))) {
            return asset($cleanPath);
        }

        // 2. Cek di public/uploads/$cleanPath jika path belum ada awalan uploads/
        if (!str_starts_with($cleanPath, 'uploads/') && file_exists(public_path('uploads/' . $cleanPath))) {
            return asset('uploads/' . $cleanPath);
        }

        // 3. Cek di public/storage/$cleanPath jika path belum ada awalan storage/
        if (!str_starts_with($cleanPath, 'storage/') && file_exists(public_path('storage/' . $cleanPath))) {
            return asset('storage/' . $cleanPath);
        }

        // 4. Cek apakah ada di storage/app/public/
        if (str_starts_with($cleanPath, 'storage/')) {
            $subPath = substr($cleanPath, 8);
            if (file_exists(storage_path('app/public/' . $subPath))) {
                return asset($cleanPath);
            }
        }

        // Fallback default
        if (str_starts_with($cleanPath, 'uploads/') || str_starts_with($cleanPath, 'storage/')) {
            return asset($cleanPath);
        }

        return asset('uploads/' . $cleanPath);
    }
}
