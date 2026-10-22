@php
    $itemProgress = (float)$item->progress_percent;
    $targetVol = (float)($item->target_volume ?? 100);
    $realVol = (float)($item->realized_volume ?? 0);
    $unit = $item->volume_unit ?? 'unit';
    $itemExpenseTotal = (float)$item->expenses->sum('total_amount');
@endphp
<div class="col-12 col-xl-6" id="infraCard_{{ $item->id }}">
    <div class="task-card-phased task-card-item-{{ $item->phase }} h-100 p-3 p-md-4 d-flex flex-column justify-content-between bg-white position-relative" id="cardBox_{{ $item->id }}">
        <div>
            <!-- Card Header -->
            <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                <div class="overflow-hidden">
                    <span class="badge bg-soft-primary text-primary rounded-2 px-2 py-1 small fw-bold mb-1 d-inline-block">{{ $item->category ?? 'Infrastruktur' }}</span>
                    <h5 class="fw-bold text-dark mb-0 fs-6">{{ $item->item_name }}</h5>
                </div>
                <div class="flex-shrink-0">
                    @if($item->status == 'selesai' || $itemProgress >= 100 || $realVol >= $targetVol)
                        <span class="badge bg-success text-white px-2 py-1 rounded-2 small fw-bold" id="badgeStatus_{{ $item->id }}">
                            Selesai (100%)
                        </span>
                    @elseif($item->status == 'proses' || $itemProgress > 0 || $realVol > 0)
                        <span class="badge bg-warning text-dark px-2 py-1 rounded-2 small fw-bold" id="badgeStatus_{{ $item->id }}">
                            Proses ({{ $itemProgress }}%)
                        </span>
                    @else
                        <span class="badge bg-secondary text-white px-2 py-1 rounded-2 small" id="badgeStatus_{{ $item->id }}">
                            Belum Mulai
                        </span>
                    @endif
                </div>
            </div>

            <!-- Volume Target & Bobot Specs with Action Buttons -->
            <div class="small text-muted mb-3 d-flex flex-wrap align-items-center justify-content-between gap-2 p-2 px-3 bg-light rounded-3 border">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <span>Target: <b class="text-dark" id="targetVolLabel_{{ $item->id }}">{{ number_format($targetVol, 0, ',', '.') }} {{ $unit }}</b></span>
                    <span>•</span>
                    <span>Bobot: <b class="text-dark" id="bobotLabel_{{ $item->id }}">{{ $item->bobot_persen ?? 0 }}%</b></span>
                    @if($item->contractor_name)
                        <span>•</span>
                        <span class="badge bg-white text-dark border">{{ $item->contractor_name }}</span>
                    @endif
                </div>
                <div class="d-flex align-items-center gap-1 ms-auto ms-sm-0">
                    <button type="button" class="btn-pill-primary"
                            onclick="openEditTargetModal({{ $item->id }}, '{{ addslashes($item->item_name) }}', {{ $targetVol }}, '{{ addslashes($unit) }}', {{ $item->bobot_persen ?? 0 }}, {{ $item->cost_estimate ?? 0 }})" 
                            title="Sesuaikan Target Volume & Bobot Pos Ini">
                        Edit Target
                    </button>
                    <button type="button" class="btn-table-del"
                            onclick="deleteInfrastructureStep({{ $item->id }}, '{{ addslashes($item->item_name) }}')" 
                            title="Hapus Pos Pekerjaan Ini">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </button>
                </div>
            </div>

            <!-- Clickable Interactive Expense Pill (Filters Table & Opens Form) -->
            <div class="p-2 px-3 rounded-3 mb-3 d-flex flex-wrap justify-content-between align-items-center gap-2 card-expense-trigger" 
                 style="background: #faf5ff; border: 1px dashed #c084fc; cursor: pointer; transition: all 0.2s ease;"
                 onclick="selectCardForExpense({{ $item->phase }}, {{ $item->id }}, {{ json_encode($item->item_name) }})"
                 title="Klik untuk memilih pos ini & melihat rincian riwayat belanjanya di bawah">
                <div>
                    <span class="small text-dark fw-bold d-block lh-1">Realisasi Belanja Bahan:</span>
                    <small class="text-primary" style="font-size: 0.72rem;">Klik untuk pilih & lihat rincian</small>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold text-danger fs-6" id="cardExpenseVal_{{ $item->id }}">Rp {{ number_format($itemExpenseTotal, 0, ',', '.') }}</span>
                    <span class="btn-pill-primary">
                        Pilih Pos &rarr;
                    </span>
                </div>
            </div>

            <!-- Real Construction Progress Form (Volume-based) -->
            <form id="formInfraItem_{{ $item->id }}" onsubmit="saveRealProgress(event, {{ $item->id }}, {{ $item->phase }})" data-phase="{{ $item->phase }}" enctype="multipart/form-data">
                <input type="hidden" name="phase" value="{{ $item->phase }}">
                <input type="hidden" name="target_volume" id="targetVol_{{ $item->id }}" value="{{ $targetVol }}">
                <input type="hidden" name="volume_unit" value="{{ $unit }}">

                <!-- Real Volume Progress Meter -->
                <div class="p-3 bg-light rounded-3 mb-3 border">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="small text-muted fw-bold">Capaian Realisasi:</span>
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
                            <label class="small text-muted mb-0">Volume Tercapai ({{ $unit }}):</label>
                        </div>
                        <div class="col-5">
                            <div class="input-group input-group-sm">
                                <input type="number" step="any" class="form-control form-control-sm fw-bold text-primary text-end" 
                                       name="realized_volume" 
                                       id="realizedVolInput_{{ $item->id }}" 
                                       value="{{ $realVol }}" 
                                       min="0" 
                                       required 
                                       oninput="calculateVolumePercentage({{ $item->id }})"
                                       onkeyup="calculateVolumePercentage({{ $item->id }})"
                                       onchange="calculateVolumePercentage({{ $item->id }})">
                                <span class="input-group-text bg-white px-2 small">{{ $unit }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Input Lapangan Riil -->
                <div class="row g-2 mb-3">
                    <div class="col-12 col-sm-6">
                        <label class="small text-muted mb-1 fw-bold">Tanggal Laporan</label>
                        <input type="date" class="form-control form-control-sm" name="log_date" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="small text-muted mb-1 fw-bold">Mandor / Pelaksana</label>
                        <input type="text" class="form-control form-control-sm" name="contractor_name" placeholder="Nama Mandor Lapangan" value="{{ $item->contractor_name ?? '' }}">
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="small text-muted mb-1 fw-bold d-block">Status Pengerjaan</label>
                        <input type="hidden" name="status" id="statusHidden_{{ $item->id }}" value="{{ ($item->status == 'selesai' || $itemProgress >= 100 || $realVol >= $targetVol) ? 'selesai' : (($item->status == 'proses' || $itemProgress > 0 || $realVol > 0) ? 'proses' : 'belum_mulai') }}">
                        <div id="statusBadgeDisplay_{{ $item->id }}" class="p-1 px-2 rounded-2 border d-flex align-items-center bg-light" style="height: 31px;">
                            @if($item->status == 'selesai' || $itemProgress >= 100 || $realVol >= $targetVol)
                                <span class="badge bg-success text-white px-2 py-1 rounded-2 small fw-bold">
                                    Selesai (100%)
                                </span>
                            @elseif($item->status == 'proses' || $itemProgress > 0 || $realVol > 0)
                                <span class="badge bg-warning text-dark px-2 py-1 rounded-2 small fw-bold">
                                    Dalam Proses
                                </span>
                            @else
                                <span class="badge bg-secondary text-white px-2 py-1 rounded-2 small">
                                    Belum Mulai
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="small text-muted mb-1 fw-bold">Foto Dokumentasi</label>
                        @if($item->photo_proof)
                            @php
                                $photoClean = ltrim(preg_replace('/^(storage\/)+/', '', $item->photo_proof), '/');
                                $photoUrl = str_starts_with($item->photo_proof, 'http') 
                                    ? $item->photo_proof 
                                    : (file_exists(public_path($item->photo_proof)) ? asset($item->photo_proof) : (file_exists(public_path('uploads/' . $photoClean)) ? asset('uploads/' . $photoClean) : asset($photoClean)));
                            @endphp
                            <!-- Existing Photo Thumbnail Box -->
                            <div class="d-flex align-items-center gap-2 p-1 px-2 bg-light rounded-3 border" id="previewContainer_{{ $item->id }}">
                                <img src="{{ $photoUrl }}" 
                                     id="imgPreview_{{ $item->id }}" 
                                     alt="Foto" 
                                     class="rounded-2 border object-fit-cover shadow-sm" 
                                     style="width: 36px; height: 36px; cursor: pointer;"
                                     onclick="window.open('{{ $photoUrl }}', '_blank')"
                                     title="Klik untuk melihat foto penuh">
                                <div class="flex-grow-1 overflow-hidden">
                                    <span class="small text-dark fw-bold d-block text-truncate lh-sm" style="font-size: 0.78rem;" id="fileNamePreview_{{ $item->id }}">Foto Tersimpan</span>
                                    <a href="{{ $photoUrl }}" target="_blank" class="text-primary text-decoration-none small fw-semibold" style="font-size: 0.72rem;">
                                        Lihat
                                    </a>
                                </div>
                                <label for="photoInput_{{ $item->id }}" class="btn-pill-xs mb-0" style="cursor: pointer;">
                                    Ganti
                                </label>
                                <input type="file" class="d-none" id="photoInput_{{ $item->id }}" name="photo_proof" accept="image/*" onchange="previewCardPhoto(this, {{ $item->id }})">
                            </div>
                        @else
                            <!-- No Photo Yet - Modern Upload Input -->
                            <div id="previewContainer_{{ $item->id }}" class="d-none d-flex align-items-center gap-2 p-1 px-2 bg-light rounded-3 border mb-1">
                                <img src="" id="imgPreview_{{ $item->id }}" alt="Preview" class="rounded-2 border object-fit-cover shadow-sm" style="width: 36px; height: 36px;">
                                <div class="flex-grow-1 overflow-hidden">
                                    <span class="small text-dark fw-bold d-block text-truncate lh-sm" style="font-size: 0.78rem;" id="fileNamePreview_{{ $item->id }}">Foto Baru</span>
                                    <span class="badge bg-soft-success text-success" style="font-size: 0.68rem;">Siap Disimpan</span>
                                </div>
                                <label for="photoInput_{{ $item->id }}" class="btn-pill-xs mb-0" style="cursor: pointer;">
                                    Ganti
                                </label>
                            </div>
                            <div class="properti-file-upload-modern" id="uploadWrapper_{{ $item->id }}">
                                <input type="file" id="photoInput_{{ $item->id }}" name="photo_proof" accept="image/*" onchange="previewCardPhoto(this, {{ $item->id }})" data-type-name="Foto Lapangan">
                                <div class="properti-file-label-modern py-1 px-2">
                                    <i class="mdi mdi-camera"></i>
                                    <div class="properti-file-info-modern">
                                        <span class="file-title-text small">Pilih Foto Lapangan</span>
                                        <small class="file-sub-text text-muted" style="font-size: 0.68rem;">JPG, PNG (Maks 2MB)</small>
                                    </div>
                                    <span class="properti-file-size"></span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <label class="small text-muted mb-1 fw-bold">Catatan Kendala / Progres</label>
                        <input type="text" class="form-control form-control-sm" name="notes" placeholder="Keterangan kondisi lapangan..." value="{{ $item->notes ?? '' }}">
                    </div>
                </div>

                <div class="d-flex justify-content-end align-items-center pt-2 border-top">
                    <button type="submit" class="btn btn-sm btn-gradient-primary px-4 rounded-2 shadow-sm fw-semibold w-100 w-sm-auto" id="btnSubmit_{{ $item->id }}">
                        Simpan Progres
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
