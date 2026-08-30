@php
    $itemProgress = (float)$item->progress_percent;
    $targetVol = (float)($item->target_volume ?? 100);
    $realVol = (float)($item->realized_volume ?? 0);
    $unit = $item->volume_unit ?? 'unit';
    $itemExpenseTotal = (float)$item->expenses->sum('total_amount');
@endphp
<div class="col-md-6" id="infraCard_{{ $item->id }}">
    <div class="task-card-phased task-card-item-{{ $item->phase }} h-100 p-4 d-flex flex-column justify-content-between bg-white position-relative" id="cardBox_{{ $item->id }}">
        <div>
            <!-- Card Header -->
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <span class="badge bg-soft-primary text-primary rounded-pill px-2 py-1 small fw-bold mb-1 d-inline-block">{{ $item->category ?? 'Infrastruktur' }}</span>
                    <h5 class="fw-bold text-dark mb-0 fs-6">{{ $item->item_name }}</h5>
                </div>
                <div>
                    @if($item->status == 'selesai' || $itemProgress >= 100 || $realVol >= $targetVol)
                        <span class="badge bg-success text-white px-2 py-1 rounded-pill small fw-bold" id="badgeStatus_{{ $item->id }}">
                            <i class="mdi mdi-check-circle me-1"></i>Selesai (100%)
                        </span>
                    @elseif($item->status == 'proses' || $itemProgress > 0 || $realVol > 0)
                        <span class="badge bg-warning text-dark px-2 py-1 rounded-pill small fw-bold" id="badgeStatus_{{ $item->id }}">
                            <i class="mdi mdi-progress-wrench me-1"></i>Proses ({{ $itemProgress }}%)
                        </span>
                    @else
                        <span class="badge bg-secondary text-white px-2 py-1 rounded-pill small" id="badgeStatus_{{ $item->id }}">
                            <i class="mdi mdi-clock-outline me-1"></i>Belum Mulai
                        </span>
                    @endif
                </div>
            </div>

            <!-- Volume Target & Bobot Specs with Quick Edit Button -->
            <div class="small text-muted mb-3 d-flex flex-wrap align-items-center justify-content-between gap-2 p-2 px-3 bg-light rounded-3 border">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <span><i class="mdi mdi-target text-primary me-1"></i>Target: <b class="text-dark" id="targetVolLabel_{{ $item->id }}">{{ number_format($targetVol, 0, ',', '.') }} {{ $unit }}</b></span>
                    <span>•</span>
                    <span><i class="mdi mdi-weight text-muted me-1"></i>Bobot: <b class="text-dark" id="bobotLabel_{{ $item->id }}">{{ $item->bobot_persen ?? 0 }}%</b></span>
                    @if($item->contractor_name)
                        <span>•</span>
                        <span class="badge bg-white text-dark border"><i class="mdi mdi-account-hard-hat me-1"></i>{{ $item->contractor_name }}</span>
                    @endif
                </div>
                <button type="button" class="btn btn-xs btn-outline-primary py-0 px-2 rounded-pill small" style="font-size: 0.72rem;"
                        onclick="openEditTargetModal({{ $item->id }}, '{{ addslashes($item->item_name) }}', {{ $targetVol }}, '{{ addslashes($unit) }}', {{ $item->bobot_persen ?? 0 }}, {{ $item->cost_estimate ?? 0 }})" 
                        title="Sesuaikan Target Volume & Bobot Pos Ini">
                    <i class="mdi mdi-pencil-outline me-1"></i>Edit Target
                </button>
            </div>

            <!-- Clickable Interactive Expense Pill (Filters Table & Opens Form) -->
            <div class="p-2 px-3 rounded-3 mb-3 d-flex justify-content-between align-items-center card-expense-trigger" 
                 style="background: #faf5ff; border: 1px dashed #c084fc; cursor: pointer; transition: all 0.2s ease;"
                 onclick="selectCardForExpense({{ $item->phase }}, {{ $item->id }}, '{{ addslashes($item->item_name) }}')"
                 title="Klik untuk memilih pos ini & melihat rincian riwayat belanjanya di bawah">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-gradient-primary text-white rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="width: 24px; height: 24px;">
                        <i class="mdi mdi-receipt-text-outline small"></i>
                    </span>
                    <div>
                        <span class="small text-dark fw-bold d-block lh-1">Realisasi Belanja Bahan:</span>
                        <small class="text-primary" style="font-size: 0.72rem;">Klik untuk pilih & lihat rincian &darr;</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold text-danger fs-6" id="cardExpenseVal_{{ $item->id }}">Rp {{ number_format($itemExpenseTotal, 0, ',', '.') }}</span>
                    <span class="btn btn-sm btn-outline-primary py-0 px-2 rounded-pill small" style="font-size: 0.75rem;">
                        Pilih Pos <i class="mdi mdi-arrow-down-circle-outline"></i>
                    </span>
                </div>
            </div>

            <!-- Real Construction Progress Form (Volume-based) -->
            <form id="formInfraItem_{{ $item->id }}" onsubmit="saveRealProgress(event, {{ $item->id }})" enctype="multipart/form-data">
                <input type="hidden" name="target_volume" id="targetVol_{{ $item->id }}" value="{{ $targetVol }}">
                <input type="hidden" name="volume_unit" value="{{ $unit }}">

                <!-- Real Volume Progress Meter -->
                <div class="p-3 bg-light rounded-3 mb-3 border">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="small text-muted fw-bold">Capaian Realisasi Lapangan Saat Ini:</span>
                        <span class="fw-bold text-primary fs-6" id="progressPercentDisplay_{{ $item->id }}">{{ $itemProgress }}%</span>
                    </div>

                    <div class="progress mb-2" style="height: 10px; border-radius: 6px;">
                        <div class="progress-bar progress-bar-striped {{ $itemProgress >= 100 ? 'bg-success' : 'bg-primary' }}" 
                             id="progressBarDisplay_{{ $item->id }}" 
                             role="progressbar" 
                             style="width: {{ $itemProgress }}%; border-radius: 6px;"></div>
                    </div>

                    <div class="row g-2 align-items-center mt-1">
                        <div class="col-7">
                            <label class="small text-muted mb-0">Input Volume Tercapai ({{ $unit }}):</label>
                        </div>
                        <div class="col-5">
                            <div class="input-group input-group-sm">
                                <input type="number" step="any" class="form-control form-control-sm fw-bold text-primary text-end" 
                                       name="realized_volume" 
                                       id="realizedVolInput_{{ $item->id }}" 
                                       value="{{ $realVol }}" 
                                       min="0" 
                                       max="{{ $targetVol * 1.5 }}" 
                                       required 
                                       oninput="calculateVolumePercentage({{ $item->id }})">
                                <span class="input-group-text bg-white px-2 small">{{ $unit }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Input Lapangan Riil -->
                <div class="row g-2 mb-3">
                    <div class="col-sm-6">
                        <label class="small text-muted mb-1 fw-bold">Tanggal Laporan / Cek</label>
                        <input type="date" class="form-control form-control-sm" name="log_date" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-sm-6">
                        <label class="small text-muted mb-1 fw-bold">Mandor / Pelaksana</label>
                        <input type="text" class="form-control form-control-sm" name="contractor_name" placeholder="Nama Mandor Lapangan" value="{{ $item->contractor_name ?? '' }}">
                    </div>
                    <div class="col-sm-6">
                        <label class="small text-muted mb-1 fw-bold">Status Pengerjaan</label>
                        <select class="form-select form-select-sm" name="status" id="statusSelect_{{ $item->id }}">
                            <option value="belum_mulai" {{ $item->status === 'belum_mulai' ? 'selected' : '' }}>Belum Mulai</option>
                            <option value="proses" {{ $item->status === 'proses' ? 'selected' : '' }}>Dalam Proses</option>
                            <option value="selesai" {{ $item->status === 'selesai' || $itemProgress >= 100 ? 'selected' : '' }}>Selesai (100%)</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label class="small text-muted mb-1 fw-bold">Foto Dokumentasi Lapangan</label>
                        @if($item->photo_proof)
                            <!-- Existing Photo Thumbnail Box with Quick Change Option -->
                            <div class="d-flex align-items-center gap-2 p-1 px-2 bg-light rounded-3 border" id="previewContainer_{{ $item->id }}">
                                <img src="{{ asset('storage/' . $item->photo_proof) }}" 
                                     id="imgPreview_{{ $item->id }}" 
                                     alt="Foto" 
                                     class="rounded-2 border object-fit-cover shadow-sm" 
                                     style="width: 36px; height: 36px; cursor: pointer;"
                                     onclick="window.open('{{ asset('storage/' . $item->photo_proof) }}', '_blank')"
                                     title="Klik untuk melihat foto penuh">
                                <div class="flex-grow-1 overflow-hidden">
                                    <span class="small text-dark fw-bold d-block text-truncate lh-sm" style="font-size: 0.78rem;" id="fileNamePreview_{{ $item->id }}">Foto Tersimpan</span>
                                    <a href="{{ asset('storage/' . $item->photo_proof) }}" target="_blank" class="text-primary text-decoration-none small" style="font-size: 0.72rem;">
                                        <i class="mdi mdi-eye me-1"></i>Lihat
                                    </a>
                                </div>
                                <label for="photoInput_{{ $item->id }}" class="btn btn-xs btn-outline-primary py-1 px-2 rounded-pill small mb-0" style="font-size: 0.72rem; cursor: pointer;">
                                    <i class="mdi mdi-camera-retake me-1"></i>Ganti
                                </label>
                                <input type="file" class="d-none" id="photoInput_{{ $item->id }}" name="photo_proof" accept="image/*" onchange="previewCardPhoto(this, {{ $item->id }})">
                            </div>
                        @else
                            <!-- No Photo Yet - Default Input with Live Preview Upon Selection -->
                            <div id="previewContainer_{{ $item->id }}" class="d-none d-flex align-items-center gap-2 p-1 px-2 bg-light rounded-3 border mb-1">
                                <img src="" id="imgPreview_{{ $item->id }}" alt="Preview" class="rounded-2 border object-fit-cover shadow-sm" style="width: 36px; height: 36px;">
                                <div class="flex-grow-1 overflow-hidden">
                                    <span class="small text-dark fw-bold d-block text-truncate lh-sm" style="font-size: 0.78rem;" id="fileNamePreview_{{ $item->id }}">Foto Baru</span>
                                    <span class="badge bg-soft-success text-success" style="font-size: 0.68rem;">Siap Disimpan</span>
                                </div>
                                <label for="photoInput_{{ $item->id }}" class="btn btn-xs btn-outline-primary py-1 px-2 rounded-pill small mb-0" style="font-size: 0.72rem; cursor: pointer;">
                                    Ganti
                                </label>
                            </div>
                            <input type="file" class="form-control form-control-sm" id="photoInput_{{ $item->id }}" name="photo_proof" accept="image/*" onchange="previewCardPhoto(this, {{ $item->id }})">
                        @endif
                    </div>
                    <div class="col-12">
                        <label class="small text-muted mb-1 fw-bold">Catatan Pengerjaan / Kendala</label>
                        <input type="text" class="form-control form-control-sm" name="notes" placeholder="Keterangan kondisi riil di lapangan..." value="{{ $item->notes ?? '' }}">
                    </div>
                </div>

                <div class="d-flex justify-content-end align-items-center pt-2 border-top">
                    <button type="submit" class="btn btn-sm btn-gradient-primary px-3 rounded-pill" id="btnSubmit_{{ $item->id }}">
                        <i class="mdi mdi-check-circle-outline me-1"></i>Simpan Realisasi Progres
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
