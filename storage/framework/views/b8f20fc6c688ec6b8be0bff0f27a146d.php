<?php $__env->startSection('title', 'Update Progres Tugas Perizinan - Property Management App'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard-clean.css')); ?>?v=<?php echo e(time()); ?>">
    <style>
        .compact-table-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 6px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
            overflow: hidden;
            width: 100% !important;
        }
        .compact-table-card .card-header {
            background: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
            padding: 1.1rem 1.75rem !important;
        }
        .compact-table-card .card-body {
            padding: 1.75rem !important;
            background: #ffffff !important;
        }
        .form-label-custom {
            font-size: 0.83rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.35rem;
        }
        .form-control-custom,
        .form-select-custom {
            border: 1px solid #cbd5e1;
            border-radius: 5px !important;
            font-size: 0.88rem;
            padding: 0.55rem 0.85rem;
            color: #1e293b;
            background-color: #ffffff;
            transition: all 0.15s ease;
            height: 42px;
        }
        textarea.form-control-custom {
            height: auto !important;
        }
        .form-control-custom:focus,
        .form-select-custom:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
            outline: none;
        }
        .btn-kembali-proyek {
            border-radius: 5px !important;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid #cbd5e1;
            background-color: #ffffff;
            color: #1e293b;
            transition: all 0.15s ease;
        }
        .btn-kembali-proyek:hover {
            background-color: #f8fafc !important;
            border-color: #94a3b8 !important;
            color: #0f172a !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08) !important;
        }

        /* Detail Card Grid */
        .info-panel {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 1.25rem;
        }
        .info-label {
            font-size: 0.73rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.04em;
            color: #64748b;
            margin-bottom: 2px;
        }
        .info-value {
            font-size: 0.92rem;
            font-weight: 600;
            color: #0f172a;
        }

        /* Status Radio Card Selector */
        .status-radio-card {
            border: 1.5px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px 14px;
            cursor: pointer;
            transition: all 0.15s ease;
            background: #ffffff;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .status-radio-card:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }
        .status-radio-card.active {
            border-color: #4f46e5;
            background: #eef2ff;
        }
        .status-radio-card input[type="radio"] {
            margin: 0;
            cursor: pointer;
        }

        /* Timeline Log Mini */
        .timeline-mini {
            position: relative;
            padding-left: 20px;
        }
        .timeline-mini::before {
            content: '';
            position: absolute;
            top: 5px;
            bottom: 5px;
            left: 6px;
            width: 2px;
            background: #e2e8f0;
        }
        .timeline-mini-item {
            position: relative;
            margin-bottom: 14px;
        }
        .timeline-mini-item:last-child {
            margin-bottom: 0;
        }
        .timeline-mini-dot {
            position: absolute;
            left: -20px;
            top: 4px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #ffffff;
            border: 2.5px solid #4f46e5;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Header & Tombol Kembali -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
        <div>
            <h2 class="text-dark mb-1 fw-bold" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Update Progres & Status Tugas
            </h2>
            <p class="text-muted mb-0" style="font-size: 0.88rem;">
                Perbarui persentase penyelesaian, laporkan kendala lapangan, atau unggah dokumen SK izin resmi.
            </p>
        </div>

        <div>
            <a href="<?php echo e(route('perizinan.tugas.index')); ?>" class="btn btn-sm d-inline-flex align-items-center px-3 py-2 shadow-sm btn-kembali-proyek">
                <i class="mdi mdi-arrow-left text-primary" style="font-size: 1.05rem; line-height: 1; margin-right: 6px !important;"></i>
                <span>Kembali ke Daftar Tugas</span>
            </a>
        </div>
    </div>

    <!-- Alert Notifikasi -->
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-3" role="alert" style="border-radius: 5px; background: #fef2f2; color: #991b1b;">
            <i class="mdi mdi-alert-circle fs-5 text-danger" style="margin-right: 6px !important;"></i>
            <div><?php echo e(session('error')); ?></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-3" role="alert" style="border-radius: 5px; background: #fef2f2; color: #991b1b;">
            <div class="fw-bold mb-1">Periksa kembali data yang dimasukkan:</div>
            <ul class="mb-0 ps-3">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Container Utama: Full Width -->
    <div class="row g-3">

        <!-- SISI KIRI: Form Input Update Progres (col-lg-8) -->
        <div class="col-lg-8">
            <div class="card compact-table-card w-100">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 32px; height: 32px; border-radius: 5px; background-color: #dcfce7; color: #16a34a; display: inline-flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0; margin-right: 8px;">
                            <i class="mdi mdi-progress-check"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0" style="font-size: 0.98rem;">Formulir Pembaruan Progres</h5>
                            <small class="text-muted" style="font-size: 0.78rem;">Pembaruan data otomatis tercatat ke dalam Audit Trail atas nama <strong><?php echo e(auth()->user()->name); ?></strong></small>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="<?php echo e(route('perizinan.tugas.progress', $task->id)); ?>" method="POST" enctype="multipart/form-data" id="formUpdateProgresPage">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>

                        <div class="row g-3">

                            <!-- 1. Pilih Status Pekerjaan -->
                            <div class="col-12">
                                <label class="form-label-custom">
                                    Status Penanganan Tugas <span class="text-danger">*</span>
                                </label>
                                <div class="row g-2">
                                    <div class="col-6 col-md-3">
                                        <label class="status-radio-card <?php echo e(old('status', $task->status) == 'Dalam Proses' ? 'active' : ''); ?>" id="cardStatusProses">
                                            <input type="radio" name="status" value="Dalam Proses" <?php echo e(old('status', $task->status) == 'Dalam Proses' ? 'checked' : ''); ?> onchange="onStatusRadioChange('Dalam Proses')">
                                            <div>
                                                <div class="fw-bold text-dark" style="font-size: 0.84rem;">Dalam Proses</div>
                                                <small class="text-muted" style="font-size: 0.7rem;">Sedang diproses dinas</small>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="col-6 col-md-3">
                                        <label class="status-radio-card <?php echo e(old('status', $task->status) == 'Selesai' ? 'active' : ''); ?>" id="cardStatusSelesai">
                                            <input type="radio" name="status" value="Selesai" <?php echo e(old('status', $task->status) == 'Selesai' ? 'checked' : ''); ?> onchange="onStatusRadioChange('Selesai')">
                                            <div>
                                                <div class="fw-bold text-success" style="font-size: 0.84rem;">Selesai / Terbit</div>
                                                <small class="text-muted" style="font-size: 0.7rem;">Izin final telah terbit</small>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="col-6 col-md-3">
                                        <label class="status-radio-card <?php echo e(old('status', $task->status) == 'Terkendala' ? 'active' : ''); ?>" id="cardStatusTerkendala">
                                            <input type="radio" name="status" value="Terkendala" <?php echo e(old('status', $task->status) == 'Terkendala' ? 'checked' : ''); ?> onchange="onStatusRadioChange('Terkendala')">
                                            <div>
                                                <div class="fw-bold text-danger" style="font-size: 0.84rem;">Terkendala</div>
                                                <small class="text-muted" style="font-size: 0.7rem;">Ada hambatan lapangan</small>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="col-6 col-md-3">
                                        <label class="status-radio-card <?php echo e(old('status', $task->status) == 'Pending' ? 'active' : ''); ?>" id="cardStatusPending">
                                            <input type="radio" name="status" value="Pending" <?php echo e(old('status', $task->status) == 'Pending' ? 'checked' : ''); ?> onchange="onStatusRadioChange('Pending')">
                                            <div>
                                                <div class="fw-bold text-secondary" style="font-size: 0.84rem;">Pending</div>
                                                <small class="text-muted" style="font-size: 0.7rem;">Menunggu antrian</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Persentase Progres (%) -->
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <label class="form-label-custom mb-0">
                                        Persentase Progres Pekerjaan <span class="text-danger">*</span>
                                    </label>
                                    <div class="d-flex align-items-center gap-1">
                                        <span class="badge bg-primary px-2 py-1 fs-6 fw-bold" id="badgeProgressVal" style="border-radius: 4px;"><?php echo e(old('progress', $task->progress)); ?>%</span>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-3">
                                    <input type="range" class="form-range flex-grow-1" id="inputProgressRange" min="0" max="100" step="5" value="<?php echo e(old('progress', $task->progress)); ?>" oninput="syncProgressInput(this.value)">
                                    <input type="number" name="progress" id="inputProgressNumber" class="form-control form-control-custom text-center fw-bold" style="width: 80px;" min="0" max="100" value="<?php echo e(old('progress', $task->progress)); ?>" oninput="syncProgressRange(this.value)" required>
                                </div>
                                <div class="d-flex justify-content-between text-muted mt-1" style="font-size: 0.7rem;">
                                    <span>0% (Belum Mulai)</span>
                                    <span>25% (Pengajuan)</span>
                                    <span>50% (Verifikasi)</span>
                                    <span>75% (Tinjau Lapangan)</span>
                                    <span>100% (Izin Sah)</span>
                                </div>
                            </div>

                            <!-- 3. Nomor Dokumen SK (Opsional) -->
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Nomor SK / Dokumen Izin Resmi
                                </label>
                                <input type="text" name="nomor_dokumen" id="inputNomorDokumen" class="form-control form-control-custom" placeholder="Contoh: 503/124/DPMPTSP/2026" value="<?php echo e(old('nomor_dokumen', $task->nomor_dokumen)); ?>">
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                    Wajib diisi jika izin sudah resmi terbit.
                                </small>
                            </div>

                            <!-- 4. Tanggal Terbit Dokumen Resmi -->
                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    Tanggal Terbit Dokumen
                                </label>
                                <input type="date" name="tanggal_terbit" id="inputTanggalTerbit" class="form-control form-control-custom" value="<?php echo e(old('tanggal_terbit', $task->tanggal_terbit ? $task->tanggal_terbit->format('Y-m-d') : '')); ?>">
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                    Tanggal SK ditandatangani oleh instansi terkait.
                                </small>
                            </div>

                            <!-- 5. Upload Berkas Fisik / Scan SK Izin -->
                            <div class="col-12">
                                <label class="form-label-custom">
                                    Unggah File Berkas / Scan SK Izin (PDF / Gambar)
                                </label>
                                <input type="file" name="file_dokumen" class="form-control form-control-custom" accept=".pdf,.jpg,.jpeg,.png">
                                <div class="d-flex flex-wrap align-items-center justify-content-between mt-1">
                                    <small class="text-muted" style="font-size: 0.74rem;">
                                        Format didukung: PDF, JPG, PNG (Maksimal 15MB).
                                    </small>
                                    <?php if($task->file_dokumen): ?>
                                        <a href="<?php echo e(asset('storage/' . $task->file_dokumen)); ?>" target="_blank" class="text-primary fw-semibold d-inline-flex align-items-center gap-1" style="font-size: 0.78rem;">
                                            <i class="mdi mdi-file-document-outline"></i>
                                            <span>Lihat Berkas Terunggah Saat Ini</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- 6. Catatan Progres / Kendala Lapangan -->
                            <div class="col-12">
                                <label class="form-label-custom">
                                    Catatan Perkembangan / Kendala Lapangan
                                </label>
                                <textarea name="kendala" rows="4" class="form-control form-control-custom" placeholder="Tuliskan detail tindak lanjut hari ini, berkas yang kurang, respon dinas, atau kendala yang dihadapi..."><?php echo e(old('kendala', $task->kendala)); ?></textarea>
                                <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">
                                    Catatan ini akan langsung tercatat di timeline riwayat untuk dipantau oleh Kepala Legal & Direksi.
                                </small>
                            </div>

                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex align-items-center justify-content-between pt-4 mt-4 border-top">
                            <a href="<?php echo e(route('perizinan.tugas.index')); ?>" class="btn btn-light border px-4 py-2 fw-semibold d-inline-flex align-items-center" style="border-radius: 5px; font-size: 0.86rem; color: #475569;">
                                <i class="mdi mdi-close" style="font-size: 1rem; margin-right: 6px !important;"></i>
                                <span>Batal</span>
                            </a>

                            <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center" style="border-radius: 5px; font-size: 0.88rem; background-color: #059669; border-color: #059669;">
                                <i class="mdi mdi-check-circle-outline" style="font-size: 1.1rem; margin-right: 8px !important;"></i>
                                <span>Simpan Pembaruan Progres</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- SISI KANAN: Ringkasan Tugas & Timeline Mini (col-lg-4) -->
        <div class="col-lg-4">
            
            <!-- Card 1: Ringkasan Tugas -->
            <div class="card compact-table-card w-100 mb-3">
                <div class="card-header py-2.5 px-3">
                    <h6 class="fw-bold text-dark mb-0 d-flex align-items-center" style="font-size: 0.88rem;">
                        <i class="mdi mdi-information-outline text-primary fs-5" style="margin-right: 6px !important;"></i>
                        <span>Informasi Tugas Terkait</span>
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="mb-3">
                        <div class="info-label">Nama Dokumen / Tugas</div>
                        <div class="info-value" style="font-size: 1rem; color: #1e1b4b;">
                            <?php echo e($task->nama_tugas); ?>

                        </div>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <div class="info-label">Kawasan Properti</div>
                            <div class="info-value" style="font-size: 0.84rem;">
                                <?php echo e($task->proyek_nama ?: ($task->proyek->land_name ?? 'Umum / Bebas')); ?>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="info-label">Instansi / Dinas</div>
                            <div class="info-value" style="font-size: 0.84rem;">
                                <?php echo e($task->instansi ?: '-'); ?>

                            </div>
                        </div>
                    </div>

                    <hr class="my-2 border-light">

                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <div class="info-label">Staf Pelaksana</div>
                            <div class="info-value" style="font-size: 0.84rem;">
                                <?php echo e($task->employee->name ?? 'Belum Ditugaskan'); ?>

                            </div>
                            <small class="text-muted" style="font-size: 0.7rem;"><?php echo e($task->employee->position->name ?? 'Staf Legal'); ?></small>
                        </div>
                        <div class="col-6">
                            <div class="info-label">Tenggat Waktu</div>
                            <div class="info-value" style="font-size: 0.84rem;">
                                <?php echo e($task->deadline ? $task->deadline->format('d M Y') : 'Tidak Ada'); ?>

                            </div>
                            <?php if($task->deadline): ?>
                                <?php if(now()->startOfDay()->gt($task->deadline->startOfDay()) && $task->status !== 'Selesai'): ?>
                                    <span class="badge bg-danger-subtle text-danger" style="font-size: 0.68rem;">Terlambat</span>
                                <?php else: ?>
                                    <small class="text-muted" style="font-size: 0.7rem;"><?php echo e($task->deadline->diffForHumans()); ?></small>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if($task->catatan): ?>
                        <div class="mt-2.5 p-2 rounded-2" style="background: #f1f5f9; font-size: 0.78rem; color: #475569;">
                            <span class="fw-bold d-block text-dark mb-0.5">Instruksi Awal:</span>
                            <?php echo e($task->catatan); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Card 2: Riwayat Terakhir (Audit Trail Mini) -->
            <div class="card compact-table-card w-100">
                <div class="card-header py-2.5 px-3 d-flex align-items-center justify-content-between">
                    <h6 class="fw-bold text-dark mb-0 d-flex align-items-center" style="font-size: 0.88rem;">
                        <i class="mdi mdi-history text-info fs-5" style="margin-right: 6px !important;"></i>
                        <span>Riwayat Terakhir</span>
                    </h6>
                    <span class="badge bg-light text-muted border" style="font-size: 0.7rem;"><?php echo e(count($recentLogs)); ?> log</span>
                </div>
                <div class="card-body p-3">
                    <?php if($recentLogs->isEmpty()): ?>
                        <div class="text-center py-3 text-muted" style="font-size: 0.8rem;">
                            Belum ada riwayat aktivitas tercatat.
                        </div>
                    <?php else: ?>
                        <div class="timeline-mini">
                            <?php $__currentLoopData = $recentLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="timeline-mini-item">
                                    <div class="timeline-mini-dot"></div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="fw-bold text-dark" style="font-size: 0.78rem;"><?php echo e($log->action); ?></span>
                                        <small class="text-muted" style="font-size: 0.68rem;"><?php echo e($log->created_at->diffForHumans()); ?></small>
                                    </div>
                                    <div class="text-muted" style="font-size: 0.73rem; line-height: 1.3;">
                                        <?php echo e(Str::limit($log->keterangan, 90)); ?>

                                    </div>
                                    <div class="d-flex align-items-center gap-1 mt-0.5">
                                        <small class="fw-semibold text-primary" style="font-size: 0.68rem;"><?php echo e($log->user->name ?? 'User'); ?></small>
                                        <?php if($log->new_progress !== null): ?>
                                            <span class="badge bg-light text-dark border py-0 px-1" style="font-size: 0.65rem;"><?php echo e($log->new_progress); ?>%</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function syncProgressInput(val) {
        document.getElementById('inputProgressNumber').value = val;
        document.getElementById('badgeProgressVal').textContent = val + '%';
        autoAdjustStatusByProgress(parseInt(val, 10));
    }

    function syncProgressRange(val) {
        val = parseInt(val, 10) || 0;
        if (val < 0) val = 0;
        if (val > 100) val = 100;
        document.getElementById('inputProgressRange').value = val;
        document.getElementById('badgeProgressVal').textContent = val + '%';
        autoAdjustStatusByProgress(val);
    }

    function onStatusRadioChange(status) {
        // Update highlight class pada radio card
        ['cardStatusProses', 'cardStatusSelesai', 'cardStatusTerkendala', 'cardStatusPending'].forEach(function(id) {
            var el = document.getElementById(id);
            if (el) el.classList.remove('active');
        });

        if (status === 'Selesai') {
            document.getElementById('cardStatusSelesai').classList.add('active');
            syncProgressRange(100);
        } else if (status === 'Dalam Proses') {
            document.getElementById('cardStatusProses').classList.add('active');
            var curr = parseInt(document.getElementById('inputProgressNumber').value, 10);
            if (curr === 0 || curr >= 100) {
                syncProgressRange(25);
            }
        } else if (status === 'Terkendala') {
            document.getElementById('cardStatusTerkendala').classList.add('active');
            var curr = parseInt(document.getElementById('inputProgressNumber').value, 10);
            if (curr >= 100) {
                syncProgressRange(50);
            }
        } else if (status === 'Pending') {
            document.getElementById('cardStatusPending').classList.add('active');
            syncProgressRange(0);
        }
    }

    function autoAdjustStatusByProgress(progress) {
        var radios = document.getElementsByName('status');
        if (progress === 100) {
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].value === 'Selesai') {
                    radios[i].checked = true;
                    highlightRadioCard('cardStatusSelesai');
                    break;
                }
            }
        } else if (progress === 0) {
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].value === 'Pending') {
                    radios[i].checked = true;
                    highlightRadioCard('cardStatusPending');
                    break;
                }
            }
        } else {
            // Jika status saat ini Selesai atau Pending, ubah ke Dalam Proses
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked && (radios[i].value === 'Selesai' || radios[i].value === 'Pending')) {
                    for (var j = 0; j < radios.length; j++) {
                        if (radios[j].value === 'Dalam Proses') {
                            radios[j].checked = true;
                            highlightRadioCard('cardStatusProses');
                            break;
                        }
                    }
                    break;
                }
            }
        }
    }

    function highlightRadioCard(activeId) {
        ['cardStatusProses', 'cardStatusSelesai', 'cardStatusTerkendala', 'cardStatusPending'].forEach(function(id) {
            var el = document.getElementById(id);
            if (el) el.classList.remove('active');
        });
        var activeEl = document.getElementById(activeId);
        if (activeEl) activeEl.classList.add('active');
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.partial.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\Property-Management-Web-App\resources\views/perizinan/tugas/progres.blade.php ENDPATH**/ ?>