@extends('layouts.partial.app')

@section('content')
<div class="container mt-4">
    <h3>Daftar Semua Menu</h3>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th>Nama Menu</th>
                    <th>Route / Link</th>
                    <th>Menu Induk (Parent)</th>
                    <th>Posisi (Hak Akses)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td> 
                        
                        <td>
                            @if($item->icon)
                                <i class="mdi {{ $item->icon }} me-1"></i>
                            @endif
                            <strong>{{ $item->name }}</strong>
                        </td> 
                        
                        <td>
                            @if($item->route)
                                <span class="badge bg-info text-dark">{{ $item->route }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td> 
                        
                        {{-- MENAMPILKAN NAMA PARENT MENU --}}
                        <td>
                            @if($item->parent)
                                {{ $item->parent->name }}
                            @else
                                <span class="badge bg-secondary">Menu Utama</span>
                            @endif
                        </td>
                        
                        {{-- MENAMPILKAN DAFTAR POSISI (MENU_POSITION) --}}
                        <td>
                            @forelse($item->positions as $pos)
                                {{-- Ubah $pos->name jika nama kolom di tabel positions beda --}}
                                <span class="badge bg-success me-1">{{ $pos->name }}</span>
                            @empty
                                <span class="text-danger small">Belum ada akses</span>
                            @endforelse
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">Data menu belum ada di database.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection