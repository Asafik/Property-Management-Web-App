@extends('layouts.partial.app')
@section('content')
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <h2>Daftar Tugas Staff Marketing</h2>
            </div>
            <div class="col-md-6 text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTaskModal">
                    + Tambah Tugas Baru
                </button>
            </div>
            <div class="modal fade" id="createTaskModal" tabindex="-1" aria-labelledby="createTaskModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createTaskModalLabel">Tambah Tugas Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('marketing.tugas.store') }}" method="POST">
                            @csrf
                            <div class="modal-body text-start">

                                <div class="mb-3">
                                    <label for="employee_id" class="form-label">Ditugaskan Kepada <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="employee_id" name="employee_id" required>
                                        <option value="" disabled selected>-- Pilih Staff Marketing --</option>
                                        @foreach ($marketingStaff as $staff)
                                            <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="nama_tugas" class="form-label">Nama Tugas <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_tugas" name="nama_tugas" required
                                        placeholder="Masukkan nama tugas...">
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Opsional..."></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="deadline" class="form-label">Tenggat Waktu (Deadline) <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="deadline" name="deadline" required>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="Pending" selected>Pending</option>
                                        <option value="Proses">Proses</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Tugas</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Staff Marketing</th>
                                <th>Nama Tugas</th>
                                <th>Deskripsi</th>
                                <th>Tenggat Waktu (Deadline)</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tugas as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->employee->name ?? 'Tidak ada staff' }}</td>
                                    <td>{{ $item->nama_tugas }}</td>
                                    <td>{{ Str::limit($item->deskripsi, 50) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}</td>
                                    <td>
                                        @if ($item->status == 'Selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif($item->status == 'Proses')
                                            <span class="badge bg-warning text-dark">Proses</span>
                                        @else
                                            <span class="badge bg-secondary">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('marketing.tugas.progress', $item->id) }}"
                                            class="btn btn-sm btn-info text-white">
                                            Progress
                                        </a>

                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editTaskModal{{ $item->id }}">
                                            Edit
                                        </button>

                                        <form action="{{ route('marketing.tugas.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah kamu yakin ingin menghapus tugas ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <div class="modal fade" id="editTaskModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editTaskModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editTaskModalLabel{{ $item->id }}">
                                                    Edit Tugas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <form action="{{ route('marketing.tugas.update', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body text-start">

                                                    <div class="mb-3">
                                                        <label for="employee_id_{{ $item->id }}"
                                                            class="form-label">Ditugaskan Kepada <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" id="employee_id_{{ $item->id }}"
                                                            name="employee_id" required>
                                                            <option value="" disabled>-- Pilih Staff Marketing --
                                                            </option>
                                                            @foreach ($marketingStaff as $staff)
                                                                <option value="{{ $staff->id }}"
                                                                    {{ $item->employee_id == $staff->id ? 'selected' : '' }}>
                                                                    {{ $staff->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="nama_tugas_{{ $item->id }}"
                                                            class="form-label">Nama Tugas <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control"
                                                            id="nama_tugas_{{ $item->id }}" name="nama_tugas"
                                                            value="{{ $item->nama_tugas }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="deskripsi_{{ $item->id }}"
                                                            class="form-label">Deskripsi</label>
                                                        <textarea class="form-control" id="deskripsi_{{ $item->id }}" name="deskripsi" rows="3">{{ $item->deskripsi }}</textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="deadline_{{ $item->id }}"
                                                            class="form-label">Tenggat Waktu (Deadline) <span
                                                                class="text-danger">*</span></label>
                                                        <input type="date" class="form-control"
                                                            id="deadline_{{ $item->id }}" name="deadline"
                                                            value="{{ \Carbon\Carbon::parse($item->deadline)->format('Y-m-d') }}"
                                                            required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="status_{{ $item->id }}" class="form-label">Status
                                                            <span class="text-danger">*</span></label>
                                                        <select class="form-select" id="status_{{ $item->id }}"
                                                            name="status" required>
                                                            <option value="Pending"
                                                                {{ $item->status == 'Pending' ? 'selected' : '' }}>Pending
                                                            </option>
                                                            <option value="Proses"
                                                                {{ $item->status == 'Proses' ? 'selected' : '' }}>Proses
                                                            </option>
                                                            <option value="Selesai"
                                                                {{ $item->status == 'Selesai' ? 'selected' : '' }}>Selesai
                                                            </option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-warning">Update Tugas</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        Belum ada data tugas untuk staff marketing.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
