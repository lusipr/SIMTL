@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <form action="{{ url('data-ncr/tlncr/input/' . $ncr->id_ncr . (!empty($ref_page) ? '/' . $ref_page : '')) }}"
            method="post" enctype="multipart/form-data" accept-charset="utf-8">
            @csrf
            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h2>Form NCR</h2>
                            </div><br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">No. NCR</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_ncr" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : 'disabled' }} id="no_ncr"
                                        value="{{ $ncr->no_ncr }}" readonly>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jenis Temuan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" value="NCR" id="jenis_temuan"
                                        name="jenis_temuan" readonly>
                                </div>
                            </div>
                            <br>
                            
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Proses Audit</label>
                                <div class="col-sm-6">
                                    <select name="proses_audit" id="proses_audit" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : 'disabled' }} readonly>
                                        <option value="Internal" {{ $ncr->proses_audit == 'Internal' ? 'selected' : '' }}>
                                            Internal</option>
                                        <option value="Eksternal" {{ $ncr->proses_audit == 'Eksternal' ? 'selected' : '' }}>
                                            Eksternal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tema Audit</label>
                                <div class="col-sm-6">
                                    <select name="tema_audit" id="tema_audit" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : 'disabled' }} readonly>
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersTema as $data_usersTema)
                                            <option value="{{ $data_usersTema->id }}"
                                                {{ $ncr->tema_audit == $data_usersTema->id ? 'selected' : '' }}>
                                                {{ $data_usersTema->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Objek Audit</label>
                                <div class="col-sm-6">
                                    <select name="objek_audit" id="objek_audit" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? 'disabled' : 'disabled' }}>
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersAuditee as $data_usersAuditee)
                                            <option value="{{ $data_usersAuditee->id }}"
                                                {{ $ncr->objek_audit == $data_usersAuditee->id ? 'selected' : '' }}>
                                                {{ $data_usersAuditee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Terbit NCR</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_terbitncr" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : 'disabled' }} id="tgl_terbitncr"
                                        value="{{ $ncr->tgl_terbitncr }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Deadline</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_deadline" class="form-control" id="tgl_deadline"
                                        value="{{ $ncr->tgl_deadline }}"
                                        {{ auth()->user()->role == 'Admin' ? '' : 'disabled' }}>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                            </div>
                            <br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Bab yang diaudit</label>
                                <div class="col-sm-6">
                                    <input type="text" name="bab_audit" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : 'disabled' }} id="bab_audit"
                                        value="{{ $ncr->bab_audit }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Dokumen Acuan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="dok_acuan" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : 'disabled' }} id="dok_acuan"
                                        value="{{ $ncr->dok_acuan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Ketidaksesuaian</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" {{ auth()->user()->role == 'Admin' ? '' : 'disabled' }} name="uraian_ncr"
                                        id="uraian_ncr" rows="5">{{ $ncr->uraian_ncr }}</textarea>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-6">
                                    <select name="kategori" id="kategori" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : 'disabled' }}>
                                        <option value="">- Pilih -</option>
                                        <option {{ $ncr->kategori == 'Mayor' ? 'selected' : '' }}>Mayor</option>
                                        <option {{ $ncr->kategori == 'Minor' ? 'selected' : '' }}>Minor</option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Auditor</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_auditor" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : 'disabled' }} id="ttd_auditor"
                                        value="{{ $ncr->ttd_auditor }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control" value="{{ $ncr->ttd_auditor }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Auditor</label>
                                <div class="col-sm-6">
                                    <input type="name" name="nama_auditor" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : 'disabled' }} id="nama_auditor"
                                        value="{{ $ncr->nama_auditor }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Diakui Oleh
                                    (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_auditee" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="ttd_auditee" value="{{ $ncr->ttd_auditee }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control" value="{{ $ncr->ttd_auditee }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diakui oleh (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="diakui_oleh" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="diakui_oleh" value="{{ $ncr->diakui_oleh }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Disetujui Oleh
                                    (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_auditee_gm_sm" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="ttd_auditee_gm_sm" value="{{ $ncr->ttd_auditee_gm_sm }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control" value="{{ $ncr->ttd_auditee_gm_sm }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Disetujui oleh (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="disetujui_oleh" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="disetujui_oleh" value="{{ $ncr->disetujui_oleh }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal disetujui SM/GM</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_accgm" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="tgl_accgm" value="{{ $ncr->tgl_accgm }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Rencana Tanggal
                                    Penyelesaian</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_planaction" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="tgl_planaction" value="{{ $ncr->tgl_planaction }}">
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h2>Input Tindak Lanjut NCR</h2>
                            </div>
                            <br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Akar Penyebab Masalah</label>
                                <div class="col-sm-6">
                                    <textarea name="akar_masalah" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="akar_masalah" rows="5" placeholder="Masukkan akar penyebab masalah" style="font-style:italic">{{ isset($tlncr->akar_masalah) ? $tlncr->akar_masalah : '' }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Perbaikan</label>
                                <div class="col-sm-6">
                                    <textarea name="uraian_perbaikan" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="uraian_perbaikan" rows="5" placeholder="Masukkan uraian perbaikan" style="font-style:italic">{{ isset($tlncr->uraian_perbaikan) ? $tlncr->uraian_perbaikan : '' }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Uraian Pencegahan untuk menjamin
                                    tidak terulang</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        name="uraian_pencegahan" id="uraian_pencegahan" rows="5" placeholder="Masukkan uraian pencegahan"
                                        style="font-style:italic">{{ isset($tlncr->uraian_pencegahan) ? $tlncr->uraian_pencegahan : '' }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Penyelesaian</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_action"
                                        value="{{ isset($tlncr->tgl_action) ? $tlncr->tgl_action : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="tgl_action">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Disetujui oleh
                                    (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_tl_gm" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="ttd_tl_gm" value="{{ isset($tlncr->ttd_tl_gm) ? $tlncr->ttd_tl_gm : '' }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control"
                                        value="{{ isset($tlncr->ttd_tl_gm) ? $tlncr->ttd_tl_gm : '' }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Disetujui oleh (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="disetujui_oleh" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="disetujui_oleh"
                                        value="{{ isset($tlncr->disetujui_oleh) ? $tlncr->disetujui_oleh : '' }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Disetujui GM</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_accgm"
                                        value="{{ isset($tlncr->tgl_accgm) ? $tlncr->tgl_accgm : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}
                                        id="tgl_accgm">
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Bukti</label>
                                <div class="col-sm-6">
                                    <input type="file" name="bukti" id="bukti" class="form-control"
                                        accept="application/pdf"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                    <p class="help-block">
                                        <font color="red">"Format file .pdf"</font>
                                    </p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Uraian Verifikasi</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}
                                        name="uraian_verifikasi" id="uraian_verifikasi" rows="5" placeholder="Masukkan uraian verifikasi"
                                        style="font-style:italic">{{ isset($tlncr->uraian_verifikasi) ? $tlncr->uraian_verifikasi : '' }}</textarea>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Hasil Verifikasi</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hasil_verif"
                                        {{ isset($tlncr->hasil_verif) && $tlncr->hasil_verif == 'efektif' ? 'checked' : '' }}
                                        id="inlineRadio1" value="efektif"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}>
                                    <label class="form-check-label" for="inlineRadio1">Efektif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hasil_verif"
                                        {{ isset($tlncr->hasil_verif) && $tlncr->hasil_verif == 'tdk_efektif' ? 'checked' : '' }}
                                        id="inlineRadio2" value="tdk_efektif"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}>
                                    <label class="form-check-label" for="inlineRadio2">Tidak Efektif</label>
                                </div>
                            </div>

                            <br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Diverifikasi
                                    Oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_tl_verif_auditor"
                                        value="{{ isset($tlncr->ttd_tl_verif_auditor) ? $tlncr->ttd_tl_verif_auditor : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}
                                        id="ttd_tl_verif_auditor" style="font-style:italic">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text"
                                        value="{{ isset($tlncr->ttd_tl_verif_auditor) ? $tlncr->ttd_tl_verif_auditor : '' }}"
                                        class="form-control" style="font-style:italic" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diverifikasi oleh</label>
                                <div class="col-sm-6">
                                    <input type="name" name="verifikator"
                                        value="{{ isset($tlncr->verifikator) ? $tlncr->verifikator : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}
                                        id="verifikator" placeholder="Masukkan nama verifikator"
                                        style="font-style:italic">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Verifikasi</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_verif"
                                        value="{{ isset($tlncr->tgl_verif) ? $tlncr->tgl_verif : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}
                                        id="tgl_verif">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Rekomendasi tinjauan
                                    manajemen</label>
                                <div class="col-sm-6">
                                    <textarea type="name" name="rekomendasi" class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }} id="rekomendasi"
                                        rows="5" placeholder="Masukkan rekomendasi tinjauan" style="font-style:italic">{{ isset($tlncr->rekomendasi) ? $tlncr->rekomendasi : '' }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Tanda Tangan Diverifikasi oleh
                                    SM Departemen Tata Kelola Perusahaan</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_tl_verif_adm"
                                        value="{{ isset($tlncr->ttd_tl_verif_adm) ? $tlncr->ttd_tl_verif_adm : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}
                                        id="ttd_tl_verif_adm" style="font-style:italic">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text"
                                        value="{{ isset($tlncr->ttd_tl_verif_adm) ? $tlncr->ttd_tl_verif_adm : '' }}"
                                        class="form-control" style="font-style:italic" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Diverifikasi oleh SM Departemen
                                    Tata Kelola Perusahaan</label>
                                <div class="col-sm-6">
                                    <input type="name" name="namasm_verif"
                                        value="{{ isset($tlncr->namasm_verif) ? $tlncr->namasm_verif : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}
                                        id="namasm_verif" placeholder="Masukkan nama SM Dept. TKP"
                                        style="font-style:italic">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Verifikasi SM Departemen
                                    Tata Kelola Perusahaan</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_verif_adm2"
                                        value="{{ isset($tlncr->tgl_verif_adm2) ? $tlncr->tgl_verif_adm2 : '' }}"
                                        class="form-control"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}
                                        id="tgl_verif">
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-6">
                                    <select name="status"
                                        id="status" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option {{ $ncr->status == 'Tindak Lanjut Belum Sesuai' ? 'selected' : '' }}>Tindak
                                            Lanjut Belum Sesuai</option>
                                        <option {{ $ncr->status == 'Belum Ditindaklanjuti' ? 'selected' : '' }}>Belum
                                            Ditindaklanjuti</option>
                                        <option {{ $ncr->status == 'Sudah Ditindaklanjuti' ? 'selected' : '' }}>Sudah
                                            Ditindaklanjuti</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-info">Simpan</button>
                            <a href="{{ !empty($ref_page) ? url($ref_page) : url('data-ncr') }}" title="Batal"
                                class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tgl_terbitncr = document.getElementById('tgl_terbitncr');
            var tgl_deadline = document.getElementById('tgl_deadline');

            tgl_terbitncr.addEventListener('change', function() {
                if (tgl_terbitncr.value !== '') {
                    var deadline = new Date(tgl_terbitncr.value);
                    deadline.setDate(deadline.getDate() + 45);
                    tgl_deadline.valueAsDate = deadline;
                } else {
                    tgl_deadline.value = '';
                }
            });
        });
    </script>
@endsection
