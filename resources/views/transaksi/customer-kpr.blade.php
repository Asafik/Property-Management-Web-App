@extends('layouts.partial.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Daftar Customer KPR</h4>

            <form method="GET" action="{{ route('customer.kpr') }}">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama customer..."
                        value="{{ request('search') }}">
                    <button class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Customer</th>
                            <th>Unit</th>
                            <th>Harga</th>
                            <th>Sales</th>
                            <th>Status</th>
                            <th>Tanggal Booking</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $key => $booking)
                            <tr>
                                <td>{{ $bookings->firstItem() + $key }}</td>
                                <td>{{ $booking->customer->full_name ?? '-' }}</td>
                                <td>{{ $booking->unit->unit_code ?? '-' }}</td>
                                <td>
                                    Rp {{ number_format($booking->unit->price ?? 0, 0, ',', '.') }}
                                </td>
                                <td>{{ $booking->sales->name ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        {{ strtoupper($booking->status) }}
                                    </span>
                                </td>
                                <td>{{ $booking->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('transaksi.kpr.approve', $booking->id) }}"
                                        class="btn btn-sm btn-primary">
                                        Approve
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Tidak ada data customer KPR
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $bookings->links() }}
                </div>

            </div>
        </div>

    </div>
@endsection
