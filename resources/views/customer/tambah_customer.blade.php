@extends('layouts.partial.app')

@section('title', 'Tambah Customer - Property Management App')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/marketing/add-customer.css') }}">

    @php
        $isEdit = isset($customer);
        $formAction = $isEdit ? route('customer.update', $customer->id) : route('customer.store');
        $displayId = $isEdit ? $customer->customer_id : $customerId;
    @endphp

    <div class="container-fluid p-3 p-md-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="text-dark mb-1 fw-bold">
                                <i class="mdi {{ $isEdit ? 'mdi-account-edit' : 'mdi-account-plus' }} me-2" style="color: #9a55ff;"></i>
                                {{ $isEdit ? 'Edit Customer' : 'Tambah Customer Baru' }}
                            </h3>
                            <p class="text-muted mb-0 small">
                                <i class="mdi mdi-information-outline me-1"></i>
                                Input data lengkap customer untuk keperluan booking, KPR, dan transaksi properti
                            </p>
                        </div>
                        <div class="d-none d-sm-block">
                            <i class="mdi mdi-account-multiple" style="font-size: 2.5rem; color: #9a55ff; opacity: 0.2;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

        <div class="add-row mb-3">
            <div class="add-col-12">
                <div class="add-card add-bg-light border-0">
                    <div class="add-card-body py-3">
                        <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2">
                            <div><span class="add-badge add-badge-primary">{{ $displayId }}</span></div>
                            <div class="add-text-muted small d-flex align-items-center">
                                <i class="mdi mdi-calendar me-1 add-text-primary"></i>
                                <span>Tanggal: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>
                            </div>
                            <div class="ms-sm-auto mt-2 mt-sm-0">
                                <span class="add-badge add-badge-success">{{ $isEdit ? 'Update Mode' : 'New Customer' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($isEdit) @method('PUT') @endif

            <div class="add-row">
                <div class="add-col-12">
                    <div class="add-card">
                        <div class="add-card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                            <h4 class="mb-0 d-flex align-items-center">
                                <i class="mdi mdi-account-plus me-2 add-text-primary"></i>
                                Form Input Data Customer
                            </h4>
                            <div class="d-flex gap-2">
                                <span class="add-badge add-badge-danger">* Wajib</span>
                                <span class="add-badge add-badge-secondary">Opsional</span>
                            </div>
                        </div>
                        <div class="add-card-body">
                            <div class="add-alert add-alert-info d-flex align-items-start gap-2 mb-4">
                                <i class="mdi mdi-information-outline mt-1 flex-shrink-0"></i>
                                <span>Data customer akan digunakan untuk booking unit, pengajuan KPR, dan dokumen legal. Pastikan data sesuai dengan dokumen resmi.</span>
                            </div>

                            <div class="add-custom-tabs-wrapper overflow-auto mb-3">
                                <ul class="add-custom-tabs" id="customerTab" role="tablist">
                                    <li class="add-custom-tab-item"><a class="add-custom-tab-link active" id="pribadi-tab" data-toggle="tab" href="#pribadi" role="tab"><i class="mdi mdi-account"></i> <span>Pribadi</span></a></li>
                                    <li class="add-custom-tab-item"><a class="add-custom-tab-link" id="alamat-tab" data-toggle="tab" href="#alamat" role="tab"><i class="mdi mdi-map-marker"></i> <span>Alamat</span></a></li>
                                    <li class="add-custom-tab-item"><a class="add-custom-tab-link" id="kontak-tab" data-toggle="tab" href="#kontak" role="tab"><i class="mdi mdi-phone"></i> <span>Kontak</span></a></li>
                                    <li class="add-custom-tab-item"><a class="add-custom-tab-link" id="pekerjaan-tab" data-toggle="tab" href="#pekerjaan" role="tab"><i class="mdi mdi-briefcase"></i> <span>Pekerjaan</span></a></li>
                                    <li class="add-custom-tab-item"><a class="add-custom-tab-link" id="keluarga-tab" data-toggle="tab" href="#keluarga" role="tab"><i class="mdi mdi-account-group"></i> <span>Keluarga</span></a></li>
                                    <li class="add-custom-tab-item"><a class="add-custom-tab-link" id="dokumen-tab" data-toggle="tab" href="#dokumen" role="tab"><i class="mdi mdi-file-document"></i> <span>Dokumen</span></a></li>
                                </ul>
                            </div>

                            <div class="tab-content mt-3 mt-md-4" id="customerTabContent">
                                <div class="add-custom-tab-pane active" id="pribadi" role="tabpanel">
                                    <div class="add-row">
                                        <div class="add-col-md-6"><div class="add-form-group"><label>Nama Lengkap <span class="add-text-danger">*</span></label><input type="text" class="add-form-control" name="full_name" value="{{ old('full_name', $customer->full_name ?? '') }}" placeholder="Sesuai KTP"></div></div>
                                        <div class="add-col-md-6"><div class="add-form-group"><label>Nama Panggilan</label><input type="text" class="add-form-control" name="nickname" value="{{ old('nickname', $customer->nickname ?? '') }}" placeholder="Contoh: John"></div></div>
                                    </div>
                                    <div class="add-row">
                                        <div class="add-col-md-6"><div class="add-form-group"><label>NIK <span class="add-text-danger">*</span></label><input type="text" class="add-form-control" name="nik" value="{{ old('nik', $customer->nik ?? '') }}" placeholder="16 digit" maxlength="16"></div></div>
                                        <div class="add-col-md-6"><div class="add-form-group"><label>Nomor Kartu Keluarga</label><input type="text" class="add-form-control" name="no_kk" value="{{ old('no_kk', $customer->no_kk ?? '') }}" placeholder="16 digit" maxlength="16"></div></div>
                                    </div>
                                    <div class="add-row">
                                        <div class="add-col-md-4"><div class="add-form-group"><label>Tempat Lahir</label><input type="text" class="add-form-control" name="birthplace" value="{{ old('birthplace', $customer->birthplace ?? '') }}" placeholder="Jakarta"></div></div>
                                        <div class="add-col-md-4">
                                            <div class="add-form-group"><label>Tanggal Lahir</label>
                                                <div class="add-date-input"><i class="mdi mdi-calendar"></i><input type="date" class="add-form-control" name="date_birth" value="{{ old('date_birth', $customer->date_birth ?? '') }}"></div>
                                            </div>
                                        </div>
                                        <div class="add-col-md-4"><div class="add-form-group"><label>Usia (Tahun)</label><input type="number" class="add-form-control" name="age" value="{{ old('age', $customer->age ?? '') }}" placeholder="30" readonly></div></div>
                                    </div>
                                    <div class="add-row">
                                        <div class="add-col-md-4">
                                            <div class="add-form-group"><label>Jenis Kelamin</label>
                                                <select class="add-form-control" name="gender">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="L" {{ old('gender', $customer->gender ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                    <option value="P" {{ old('gender', $customer->gender ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="add-col-md-4">
                                            <div class="add-form-group"><label>Agama</label>
                                                <select class="add-form-control" name="religion">
                                                    <option value="">-- Pilih --</option>
                                                    @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Lainnya'] as $rel)
                                                        <option value="{{ $rel }}" {{ old('religion', $customer->religion ?? '') == $rel ? 'selected' : '' }}>{{ $rel }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="add-col-md-4">
                                            <div class="add-form-group"><label>Kewarganegaraan</label>
                                                <select class="add-form-control" name="nationality">
                                                    <option value="WNI" {{ old('nationality', $customer->nationality ?? '') == 'WNI' ? 'selected' : '' }}>WNI</option>
                                                    <option value="WNA" {{ old('nationality', $customer->nationality ?? '') == 'WNA' ? 'selected' : '' }}>WNA</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add-row">
                                        <div class="add-col-md-4">
                                            <div class="add-form-group"><label>Status Pernikahan</label>
                                                <select class="add-form-control" name="marital_status">
                                                    <option value="">-- Pilih --</option>
                                                    @foreach(['Belum Menikah', 'Menikah', 'Cerai'] as $st)
                                                        <option value="{{ $st }}" {{ old('marital_status', $customer->marital_status ?? '') == $st ? 'selected' : '' }}>{{ $st }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="add-col-md-4">
                                            <div class="add-form-group"><label>Tanggal Pernikahan</label>
                                                <div class="add-date-input"><i class="mdi mdi-calendar"></i><input type="date" class="add-form-control" name="marital_date" value="{{ old('marital_date', $customer->marital_date ?? '') }}"></div>
                                            </div>
                                        </div>
                                        <div class="add-col-md-4"><div class="add-form-group"><label>Jumlah Anak</label><input type="number" class="add-form-control" name="child_count" value="{{ old('child_count', $customer->child_count ?? '0') }}" min="0"></div></div>
                                    </div>
                                </div>

                                <div class="add-custom-tab-pane" id="alamat" role="tabpanel">
                                    <div class="add-section-title"><i class="mdi mdi-home"></i> Alamat Domisili Saat Ini</div>
                                    <div class="add-row">
                                        <div class="add-col-md-4">
                                            <div class="add-form-group"><label>Provinsi</label>
                                                <select class="add-form-control" id="provinsiDomisili" name="domicile_province">
                                                    <option value="">-- Pilih Provinsi --</option>
                                                    @foreach(['Aceh','Sumatera Utara','Sumatera Barat','Riau','Kepulauan Riau','Jambi','Sumatera Selatan','Bangka Belitung','Bengkulu','Lampung','DKI Jakarta','Jawa Barat','Jawa Tengah','DI Yogyakarta','Jawa Timur','Banten','Bali','Nusa Tenggara Barat','Nusa Tenggara Timur','Kalimantan Barat','Kalimantan Tengah','Kalimantan Selatan','Kalimantan Timur','Kalimantan Utara','Sulawesi Utara','Gorontalo','Sulawesi Tengah','Sulawesi Barat','Sulawesi Selatan','Sulawesi Tenggara','Maluku','Maluku Utara','Papua','Papua Barat','Papua Selatan','Papua Tengah','Papua Pegunungan','Papua Barat Daya'] as $p)
                                                        <option value="{{ $p }}" {{ old('domicile_province', $customer->domicile_province ?? '') == $p ? 'selected' : '' }}>{{ $p }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="add-col-md-4"><div class="add-form-group"><label>Kota/Kabupaten</label><input type="text" class="add-form-control" id="kotaDomisili" name="domicile_city" value="{{ old('domicile_city', $customer->domicile_city ?? '') }}" placeholder="Jakarta Selatan"></div></div>
                                        <div class="add-col-md-4"><div class="add-form-group"><label>Kecamatan</label><input type="text" class="add-form-control" id="kecamatanDomisili" name="domicile_subdistrict" value="{{ old('domicile_subdistrict', $customer->domicile_subdistrict ?? '') }}" placeholder="Kebayoran Baru"></div></div>
                                    </div>
                                    <div class="add-row">
                                        <div class="add-col-md-4"><div class="add-form-group"><label>Kelurahan/Desa</label><input type="text" class="add-form-control" id="kelurahanDomisili" name="domicile_village" value="{{ old('domicile_village', $customer->domicile_village ?? '') }}" placeholder="Cipete"></div></div>
                                        <div class="add-col-6 add-col-md-2"><div class="add-form-group"><label>RT</label><input type="text" class="add-form-control" id="rtDomisili" name="domicile_rt" value="{{ old('domicile_rt', $customer->domicile_rt ?? '') }}" placeholder="001"></div></div>
                                        <div class="add-col-6 add-col-md-2"><div class="add-form-group"><label>RW</label><input type="text" class="add-form-control" id="rwDomisili" name="domicile_rw" value="{{ old('domicile_rw', $customer->domicile_rw ?? '') }}" placeholder="002"></div></div>
                                        <div class="add-col-md-4"><div class="add-form-group"><label>Kode Pos</label><input type="text" class="add-form-control" id="kodePosDomisili" name="domicile_postal_code" value="{{ old('domicile_postal_code', $customer->domicile_postal_code ?? '') }}" placeholder="12345"></div></div>
                                    </div>
                                    <div class="add-form-group"><label>Alamat Lengkap Domisili</label><textarea class="add-form-control" id="alamatDomisili" name="domicile_address" rows="2" placeholder="Jl. Contoh No. 123">{{ old('domicile_address', $customer->domicile_address ?? '') }}</textarea></div>

                                    <hr class="add-hr">

                                    <div class="add-checkbox-wrapper mb-4">
                                        <input type="checkbox" class="add-checkbox-input" id="alamatSamaKTP">
                                        <label class="add-checkbox-label" for="alamatSamaKTP"><i class="mdi mdi-check-circle add-check-icon"></i><span class="add-check-text">Alamat domisili sama dengan alamat KTP</span></label>
                                    </div>
                                    <div class="add-section-title"><i class="mdi mdi-card-account-details"></i> Alamat Sesuai KTP</div>
                                    <div class="add-row">
                                        <div class="add-col-md-4">
                                            <div class="add-form-group"><label>Provinsi</label>
                                                <select class="add-form-control" id="provinsiKTP" name="province">
                                                    <option value="">-- Pilih Provinsi --</option>
                                                    @foreach(['Aceh','Sumatera Utara','Sumatera Barat','Riau','Kepulauan Riau','Jambi','Sumatera Selatan','Bangka Belitung','Bengkulu','Lampung','DKI Jakarta','Jawa Barat','Jawa Tengah','DI Yogyakarta','Jawa Timur','Banten','Bali','Nusa Tenggara Barat','Nusa Tenggara Timur','Kalimantan Barat','Kalimantan Tengah','Kalimantan Selatan','Kalimantan Timur','Kalimantan Utara','Sulawesi Utara','Gorontalo','Sulawesi Tengah','Sulawesi Barat','Sulawesi Selatan','Sulawesi Tenggara','Maluku','Maluku Utara','Papua','Papua Barat','Papua Selatan','Papua Tengah','Papua Pegunungan','Papua Barat Daya'] as $p)
                                                        <option value="{{ $p }}" {{ old('province', $customer->province ?? '') == $p ? 'selected' : '' }}>{{ $p }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="add-col-md-4"><div class="add-form-group"><label>Kota/Kabupaten</label><input type="text" class="add-form-control" id="kotaKTP" name="city" value="{{ old('city', $customer->city ?? '') }}" placeholder="Jakarta Selatan"></div></div>
                                        <div class="add-col-md-4"><div class="add-form-group"><label>Kecamatan</label><input type="text" class="add-form-control" id="kecamatanKTP" name="subdistrict" value="{{ old('subdistrict', $customer->subdistrict ?? '') }}" placeholder="Kebayoran Baru"></div></div>
                                    </div>
                                    <div class="add-row">
                                        <div class="add-col-md-4"><div class="add-form-group"><label>Kelurahan/Desa</label><input type="text" class="add-form-control" id="kelurahanKTP" name="village" value="{{ old('village', $customer->village ?? '') }}" placeholder="Cipete"></div></div>
                                        <div class="add-col-6 add-col-md-2"><div class="add-form-group"><label>RT</label><input type="text" class="add-form-control" id="rtKTP" name="rt" value="{{ old('rt', $customer->rt ?? '') }}" placeholder="001"></div></div>
                                        <div class="add-col-6 add-col-md-2"><div class="add-form-group"><label>RW</label><input type="text" class="add-form-control" id="rwKTP" name="rw" value="{{ old('rw', $customer->rw ?? '') }}" placeholder="002"></div></div>
                                        <div class="add-col-md-4"><div class="add-form-group"><label>Kode Pos</label><input type="text" class="add-form-control" id="kodePosKTP" name="postal_code" value="{{ old('postal_code', $customer->postal_code ?? '') }}" placeholder="12345"></div></div>
                                    </div>
                                    <div class="add-form-group"><label>Alamat Lengkap KTP</label><textarea class="add-form-control" id="alamatKTP" name="address" rows="2" placeholder="Jl. Contoh No. 123">{{ old('address', $customer->address ?? '') }}</textarea></div>
                                </div>

                                <div class="add-custom-tab-pane" id="kontak" role="tabpanel">
                                    <div class="add-row">
                                        <div class="add-col-md-6"><div class="add-form-group"><label>No. HP / WA <span class="add-text-danger">*</span></label><input type="text" class="add-form-control" name="phone" value="{{ old('phone', $customer->phone ?? ($guest->phone ?? '')) }}" placeholder="081234567890"></div></div>
                                        <div class="add-col-md-6"><div class="add-form-group"><label>No. Telepon Rumah</label><input type="text" class="add-form-control" name="home_phone" value="{{ old('home_phone', $customer->home_phone ?? '') }}" placeholder="021-1234567"></div></div>
                                    </div>
                                    <div class="add-row">
                                        <div class="add-col-md-6"><div class="add-form-group"><label>Email Pribadi</label><input type="email" class="add-form-control" name="email" value="{{ old('email', $customer->email ?? '') }}" placeholder="john@example.com"></div></div>
                                        <div class="add-col-md-6"><div class="add-form-group"><label>Email Kantor</label><input type="email" class="add-form-control" name="office_email" value="{{ old('office_email', $customer->office_email ?? '') }}" placeholder="john@company.com"></div></div>
                                    </div>
                                    <div class="add-section-title mt-3"><i class="mdi mdi-share-variant"></i> Media Sosial <span class="add-badge add-badge-secondary ms-2" style="font-size: 0.65rem;">Opsional</span></div>
                                    <div class="add-row">
                                        <div class="add-col-md-6"><div class="add-form-group"><label>Instagram</label><div class="add-input-group"><div class="add-input-group-prepend"><span class="add-input-group-text">@</span></div><input type="text" class="add-form-control" name="instagram" value="{{ old('instagram', $customer->instagram ?? '') }}" placeholder="username"></div></div></div>
                                        <div class="add-col-md-6"><div class="add-form-group"><label>Facebook</label><input type="text" class="add-form-control" name="facebook" value="{{ old('facebook', $customer->facebook ?? '') }}" placeholder="nama.profil"></div></div>
                                    </div>
                                </div>

                                <div class="add-custom-tab-pane" id="pekerjaan" role="tabpanel">
                                    <div class="add-row">
                                        <div class="add-col-md-6">
                                            <div class="add-form-group"><label>Status Pekerjaan</label>
                                                <select class="add-form-control" name="job_status" id="jobStatus">
                                                    <option value="">-- Pilih --</option>
                                                    @foreach(['Karyawan Swasta','PNS','Wiraswasta','Ibu Rumah Tangga','Pensiunan','Lainnya'] as $j)
                                                        <option value="{{ $j }}" {{ old('job_status', $customer->job_status ?? '') == $j ? 'selected' : '' }}>{{ $j }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="add-col-md-6" id="jobStatusLainnyaWrapper" style="{{ old('job_status', $customer->job_status ?? '') == 'Lainnya' ? 'display:block' : 'display:none' }}">
                                            <div class="add-form-group"><label>Masukkan Status Pekerjaan</label><input type="text" class="add-form-control" id="jobStatusLainnya" name="job_status_lainnya" value="{{ old('job_status_lainnya', $customer->job_status_lainnya ?? '') }}" placeholder="Tulis di sini..."></div>
                                        </div>
                                        <div class="add-col-md-6"><div class="add-form-group"><label>Perusahaan</label><input type="text" class="add-form-control" name="company_name" value="{{ old('company_name', $customer->company_name ?? '') }}" placeholder="PT. Contoh Abadi"></div></div>
                                    </div>
                                    <div class="add-row">
                                        <div class="add-col-md-6"><div class="add-form-group"><label>Penghasilan Pokok (Rp)</label><div class="add-input-group"><div class="add-input-group-prepend"><span class="add-input-group-text">Rp</span></div><input type="text" class="add-form-control" name="main_income" value="{{ old('main_income', $customer->main_income ?? '') }}" placeholder="10.000.000"></div></div></div>
                                        <div class="add-col-md-6"><div class="add-form-group"><label>Penghasilan Tambahan (Rp)</label><div class="add-input-group"><div class="add-input-group-prepend"><span class="add-input-group-text">Rp</span></div><input type="text" class="add-form-control" name="side_income" value="{{ old('side_income', $customer->side_income ?? '') }}" placeholder="2.000.000"></div></div></div>
                                    </div>
                                    <div class="add-row">
                                        <div class="add-col-md-6"><div class="add-form-group"><label>NPWP</label><input type="text" class="add-form-control" name="npwp" value="{{ old('npwp', $customer->npwp ?? '') }}" placeholder="XX.XXX.XXX.X-XXX.XXX"></div></div>
                                    </div>
                                </div>

                                <div class="add-custom-tab-pane" id="keluarga" role="tabpanel">
                                    <div class="add-section-title"><i class="mdi mdi-account-heart"></i> Data Pasangan</div>
                                    <div class="add-row">
                                        <div class="add-col-md-6"><div class="add-form-group"><label>Nama Lengkap Pasangan</label><input type="text" class="add-form-control" name="spouse_name" value="{{ old('spouse_name', $customer->spouse_name ?? '') }}" placeholder="Jane Doe"></div></div>
                                        <div class="add-col-md-6"><div class="add-form-group"><label>NIK Pasangan</label><input type="text" class="add-form-control" name="spouse_nik" value="{{ old('spouse_nik', $customer->spouse_nik ?? '') }}" placeholder="16 digit"></div></div>
                                    </div>
                                    <hr class="add-hr">
                                    <div class="add-section-title"><i class="mdi mdi-account-multiple"></i> Data Orang Tua</div>
                                    <div class="add-row">
                                        <div class="add-col-md-6"><div class="add-form-group"><label>Nama Ayah</label><input type="text" class="add-form-control" name="father_name" value="{{ old('father_name', $customer->father_name ?? '') }}" placeholder="John Doe Sr."></div></div>
                                        <div class="add-col-md-6"><div class="add-form-group"><label>Nama Ibu</label><input type="text" class="add-form-control" name="mother_name" value="{{ old('mother_name', $customer->mother_name ?? '') }}" placeholder="Jane Doe Sr."></div></div>
                                    </div>
                                </div>

                                <div class="add-custom-tab-pane" id="dokumen" role="tabpanel">
                                    <div class="add-row">
                                        @foreach(['uploadKtp' => 'KTP', 'uploadKk' => 'Kartu Keluarga', 'uploadNpwp' => 'NPWP', 'uploadPasangan' => 'KTP Pasangan'] as $f => $l)
                                            <div class="add-col-md-6">
                                                <div class="add-form-group">
                                                    <label>Upload {{ $l }}</label>
                                                    <div class="add-file-upload">
                                                        <input type="file" id="{{ $f }}" name="{{ $f }}">
                                                        <div class="add-file-label">
                                                            <i class="mdi mdi-cloud-upload"></i>
                                                            <div class="add-file-info"><span class="file-name-text">Klik untuk upload {{ $l }}</span><small>Format: JPG, PNG, PDF (Max 2MB)</small></div>
                                                        </div>
                                                    </div>
                                                    @if($isEdit)
                                                        @php $doc = $customer->documents->where('document_name', str_replace('upload', '', $f) == 'Ktp' ? 'KTP' : (str_replace('upload', '', $f) == 'Kk' ? 'Kartu Keluarga' : (str_replace('upload', '', $f) == 'Npwp' ? 'NPWP' : 'KTP Pasangan')))->first(); @endphp
                                                        @if($doc) 
                                                             @php
                                                                 $fileUrl = file_exists(public_path('uploads/' . $doc->file)) ? asset('uploads/' . $doc->file) : asset('storage/' . $doc->file);
                                                                 $ext = pathinfo($doc->file, PATHINFO_EXTENSION);
                                                                 $downloadName = str_replace(' ', '_', $l) . '_' . str_replace(' ', '_', $customer->full_name) . '.' . $ext;
                                                             @endphp
                                                             <div class="mt-2 text-end d-flex justify-content-end gap-2">
                                                                 <a href="{{ $fileUrl }}" target="_blank" class="btn btn-sm btn-outline-info py-1"> 
                                                                     <i class="mdi mdi-eye me-1"></i> Lihat
                                                                 </a>
                                                                 <a href="{{ $fileUrl }}" download="{{ $downloadName }}" class="btn btn-sm btn-outline-success py-1"> 
                                                                     <i class="mdi mdi-download me-1"></i> Download
                                                                 </a>
                                                             </div> 
                                                         @endif
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <hr class="add-hr">
                            <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mt-4">
                                <div class="d-flex flex-wrap gap-2 w-100 w-sm-auto">
                                    <button type="button" class="add-btn add-btn-outline-secondary" id="btnPrevGlobal"><i class="mdi mdi-arrow-left me-1"></i>Kembali</button>
                                    <button type="reset" class="add-btn add-btn-secondary"><i class="mdi mdi-refresh me-1"></i>Reset</button>
                                    <button type="button" id="btnNextGlobal" class="add-btn add-btn-primary">Lanjut <i class="mdi mdi-arrow-right ms-1"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            // --- 1. Logika Tab Sederhana ---
            $('.add-custom-tab-link').on('click', function(e) {
                e.preventDefault();
                $('.add-custom-tab-link').removeClass('active');
                $('.add-custom-tab-pane').removeClass('active');
                $(this).addClass('active');
                $($(this).attr('href')).addClass('active');
            });

            // --- 2. Logika Tanggal Lahir & Usia ---
            $('input[name="date_birth"]').on('change', function() {
                if (!this.value) return;
                const birth = new Date(this.value);
                const today = new Date();
                let age = today.getFullYear() - birth.getFullYear();
                if (today.getMonth() < birth.getMonth() || (today.getMonth() == birth.getMonth() && today.getDate() < birth.getDate())) age--;
                $('input[name="age"]').val(age);
            });

            // --- 3. Logika Sinkronisasi Alamat (Domisili ke KTP) ---
            $("#alamatSamaKTP").on("change", function() {
                const fields = ["provinsi", "kota", "kecamatan", "kelurahan", "rt", "rw", "kodePos", "alamat"];
                fields.forEach(f => {
                    const dom = document.getElementById(f + "Domisili");
                    const ktp = document.getElementById(f + "KTP");
                    if (this.checked) {
                        ktp.value = dom.value;
                        if(ktp.tagName === "SELECT") ktp.disabled = true; else ktp.readOnly = true;
                    } else {
                        ktp.value = "";
                        if(ktp.tagName === "SELECT") ktp.disabled = false; else ktp.readOnly = false;
                    }
                });
            });

            // --- 4. Logika Input Pekerjaan Lainnya ---
            $("#jobStatus").on("change", function() {
                $("#jobStatusLainnyaWrapper").toggle(this.value === "Lainnya");
            });

            // --- 5. UI Nama File Saat Upload ---
            $('input[type="file"]').on('change', function() {
                const fileName = this.files[0] ? this.files[0].name : 'Klik untuk upload';
                $(this).siblings('.add-file-label').find('.file-name-text').text(fileName);
            });

            // --- 6. Navigasi Tombol Lanjut & Kembali ---
            const btnNext = document.getElementById("btnNextGlobal");
            const btnPrev = document.getElementById("btnPrevGlobal");
            const tabLinks = document.querySelectorAll(".add-custom-tab-link");
            const form = document.querySelector('form');

            function updateButtonState() {
                const activeIdx = Array.from(tabLinks).findIndex(t => t.classList.contains('active'));
                btnPrev.disabled = activeIdx === 0;

                if (activeIdx === tabLinks.length - 1) {
                    btnNext.innerHTML = '{{ $isEdit ? "Update Customer" : "Simpan Customer" }} <i class="mdi mdi-content-save ms-1"></i>';
                    btnNext.type = "submit";
                } else {
                    btnNext.innerHTML = 'Lanjut <i class="mdi mdi-arrow-right ms-1"></i>';
                    btnNext.type = "button";
                }
            }

            btnNext.onclick = function(e) {
                if (this.type === "submit") return;
                e.preventDefault();
                const activeIdx = Array.from(tabLinks).findIndex(t => t.classList.contains('active'));
                if (activeIdx < tabLinks.length - 1) {
                    tabLinks[activeIdx + 1].click();
                    updateButtonState();
                    window.scrollTo(0, 0);
                }
            };

            btnPrev.onclick = function() {
                const activeIdx = Array.from(tabLinks).findIndex(t => t.classList.contains('active'));
                if (activeIdx > 0) {
                    tabLinks[activeIdx - 1].click();
                    updateButtonState();
                    window.scrollTo(0, 0);
                }
            };

            tabLinks.forEach(t => t.addEventListener("click", () => setTimeout(updateButtonState, 10)));

            // --- 7. Logika Kirim Data AJAX (Tanpa Console Log) ---
            $(form).on('submit', function(e) {
                e.preventDefault();

                let fullName = $('input[name="full_name"]').val();
                if (!fullName || fullName.trim() === '') {
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Nama lengkap wajib diisi!' });
                    return false;
                }

                Swal.fire({
                    title: 'Sedang memproses...',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });

                let formData = new FormData(this);
                let actionUrl = $(this).attr('action');

                $.ajax({
                    url: actionUrl,
                    type: 'POST', // Tetap POST agar multipart PUT Laravel terbaca
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data customer telah berhasil diproses.',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = '{{ route("customer.data") }}';
                        });
                    },
                    error: function(xhr) {
                        let msg = 'Terjadi kesalahan sistem.';
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            msg = 'Periksa kembali inputan Anda:<br><ul class="text-left">';
                            $.each(errors, function(key, value) {
                                msg += '<li>' + value[0] + '</li>';
                            });
                            msg += '</ul>';
                        }
                        Swal.fire({ icon: 'error', title: 'Simpan Gagal', html: msg });
                    }
                });
            });

            updateButtonState();
        });
    </script>
@endpush
