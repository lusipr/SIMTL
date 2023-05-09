@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
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
                                <input type="text" name="no_ncr" disabled class="form-control" id="no_ncr"
                                    value="{{ $ncr->no_ncr }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Proses Audit</label>
                            <div class="col-sm-6">
                                <select name="proses_audit" disabled id="proses_audit" class="form-control">
                                    <option value="Internal" {{ $ncr->proses_audit == 'Internal' ? 'selected' : '' }}>
                                        Internal</option>
                                    <option value="Eksternal" {{ $ncr->proses_audit == 'Eksternal' ? 'selected' : '' }}>
                                        Eksternal</option>
                                </select>
                            </div>
                        </div>
                       
                        {{-- <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tema Audit</label>
                            <div class="col-sm-6">
                                <select name="tema_audit" disabled id="tema_audit" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option {{ $ncr->tema_audit == 'ISO 9001' ? 'selected' : '' }}>ISO 9001</option>
                                    <option {{ $ncr->tema_audit == 'ISO 45001' ? 'selected' : '' }}>ISO 45001</option>
                                    <option {{ $ncr->tema_audit == 'ISO 14001' ? 'selected' : '' }}>ISO 14001</option>
                                    <option {{ $ncr->tema_audit == 'ISO 37001' ? 'selected' : '' }}>ISO 37001</option>
                                </select>
                            </div>
                        </div> --}}

                        <div class="row-mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tema Audit</label>
                            <div class="col-sm-6">
                                <select name="tema_audit" id="tema_audit" class="form-control" disabled>
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
                                <select name="objek_audit" id="objek_audit" class="form-control" disabled>
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
                        <div class="row-mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Jenis Temuan</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" value="NCR" id="jenis_temuan"
                                    name="jenis_temuan" disabled>
                                {{-- <select name="jenis_temuan" disabled id="jenis_temuan" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option {{ $ncr->jenis_temuan == 'Ketidaksesuaian' ? 'selected' : '' }}>Ketidaksesuaian
                                    </option>
                                    <option {{ $ncr->jenis_temuan == 'Potensi Peningkatan' ? 'selected' : '' }}>Potensi
                                        Peningkatan</option>
                                </select> --}}
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Terbit NCR</label>
                            <div class="col-sm-6">
                                <input type="date" name="tgl_terbitncr" disabled class="form-control" id="tgl_terbitncr"
                                    value="{{ $ncr->tgl_terbitncr }}">
                            </div>
                        </div>

                        <div class="row-mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-6">
                                <select name="status" disabled id="status" class="form-control"
                                {{ auth()->user()->role == 'Admin' ? '' : 'disabled' }}>
                                    <option value="">- Pilih -</option>
                                    <option {{ $ncr->status == 'Data Belum Lengkap' ? 'selected' : '' }}>Data Belum Lengkap
                                    </option>
                                    <option {{ $ncr->status == 'Belum Ditindaklanjuti' ? 'selected' : '' }}>Belum
                                        Ditindaklanjuti</option>
                                    <option {{ $ncr->status == 'Sudah Ditindaklanjuti' ? 'selected' : '' }}>Sudah
                                        Ditindaklanjuti</option>
                                </select>
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
                        </div><br>
                        <!--<input type='hidden' class="form-control" name="id_ncr" disabled value=""readonly>-->

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Bab yang diaudit</label>
                            <div class="col-sm-6">
                                <input type="text" name="bab_audit" disabled class="form-control" id="bab_audit"
                                    value="{{ $ncr->bab_audit }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Dokumen Acuan</label>
                            <div class="col-sm-6">
                                <input type="text" name="dok_acuan" disabled class="form-control" id="dok_acuan"
                                    value="{{ $ncr->dok_acuan }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Ketidaksesuaian</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="uraian_ncr" disabled id="uraian_ncr" rows="5">{{ $ncr->uraian_ncr }}</textarea>
                            </div>
                        </div>

                        <div class="row-mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-6">
                                <select name="kategori" disabled id="kategori" class="form-control">
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
                                <input type="file" name="ttd_auditor" disabled class="form-control" id="ttd_auditor"
                                    value="{{ $ncr->ttd_auditor }}">
                                <p class="help-block">
                                    <font color="red">"Format file .jpeg,jpg,png"</font>
                                </p>
                                <input type="text" disabled class="form-control" value="{{ $ncr->ttd_auditor }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Auditor</label>
                            <div class="col-sm-6">
                                <input type="name" name="nama_auditor" disabled class="form-control"
                                    id="nama_auditor" value="{{ $ncr->nama_auditor }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Diakui Oleh
                                (SM/GM)</label>
                            <div class="col-sm-6">
                                <input type="file" name="ttd_auditee" disabled class="form-control" id="ttd_auditee"
                                    value="{{ $ncr->ttd_auditee }}">
                                <p class="help-block">
                                    <font color="red">"Format file .jpeg,jpg,png"</font>
                                </p>
                                <input type="text" disabled class="form-control" value="{{ $ncr->ttd_auditee }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Diakui Oleh (M/SM)</label>
                            <div class="col-sm-6">
                                <input type="name" name="diakui_oleh" disabled class="form-control" id="diakui_oleh"
                                    value="{{ $ncr->diakui_oleh }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Disetujui oleh
                                (SM/GM)</label>
                            <div class="col-sm-6">
                                <input type="file" name="ttd_auditee_gm_sm" disabled class="form-control"
                                    id="ttd_auditee_gm_sm" value="{{ $ncr->ttd_auditee_gm_sm }}">
                                <p class="help-block">
                                    <font color="red">"Format file .jpeg,jpg,png"</font>
                                </p>
                                <input type="text" disabled class="form-control"
                                    value="{{ $ncr->ttd_auditee_gm_sm }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Disetujui oleh (SM/GM)</label>
                            <div class="col-sm-6">
                                <input type="name" name="disetujui_oleh" disabled class="form-control"
                                    id="disetujui_oleh" value="{{ $ncr->disetujui_oleh }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal disetujui GM</label>
                            <div class="col-sm-6">
                                <input type="date" name="tgl_accgm" disabled class="form-control" id="tgl_accgm"
                                    value="{{ $ncr->tgl_accgm }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Rencana Tanggal
                                Penyelesaian</label>
                            <div class="col-sm-6">
                                <input type="date" name="tgl_planaction" disabled class="form-control"
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
                        </div><br>
                        <!--<input type='hidden' class="form-control" name="id_ncr" disabled value=""readonly>-->

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Akar Penyebab Masalah</label>
                            <div class="col-sm-6">
                                <textarea name="akar_masalah" disabled class="form-control" id="akar_masalah" rows="5"
                                    placeholder="Masukkan akar penyebab masalah" style="font-style:italic">{{ $tlncr->akar_masalah }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Perbaikan</label>
                            <div class="col-sm-6">
                                <textarea name="uraian_perbaikan" disabled class="form-control" id="uraian_perbaikan" rows="5"
                                    placeholder="Masukkan uraian perbaikan" style="font-style:italic">{{ $tlncr->uraian_perbaikan }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-6 col-form-label">Uraian Pencegahan untuk menjamin
                                tidak terulang</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="uraian_pencegahan" disabled id="uraian_pencegahan" rows="5"
                                    placeholder="Masukkan uraian pencegahan" style="font-style:italic">{{ $tlncr->uraian_pencegahan }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Penyelesaian</label>
                            <div class="col-sm-6">
                                <input type="date" name="tgl_action" disabled value="{{ $tlncr->tgl_action }}"
                                    class="form-control" id="tgl_action">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Disetujui Oleh
                                (SM/GM)</label>
                            <div class="col-sm-6">
                                <input type="file" name="ttd_tl_gm" class="form-control" disabled id="ttd_tl_gm"
                                    value="{{ $tlncr->ttd_tl_gm }}">
                                <p class="help-block">
                                    <font color="red">"Format file .jpeg,jpg,png"</font>
                                </p>
                                <input type="text" class="form-control" disabled value="{{ $tlncr->ttd_tl_gm }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Disetujui oleh (SM/GM)</label>
                            <div class="col-sm-6">
                                <input type="name" name="disetujui_oleh" class="form-control" disabled
                                    id="disetujui_oleh" value="{{ $tlncr->disetujui_oleh }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Disetujui GM</label>
                            <div class="col-sm-6">
                                <input type="date" name="tgl_accgm" disabled value="{{ $tlncr->tgl_accgm }}"
                                    class="form-control" id="tgl_accgm">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-6 col-form-label">Uraian Verifikasi</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="uraian_verifikasi" disabled id="uraian_verifikasi" rows="5"
                                    placeholder="Masukkan uraian verifikasi" style="font-style:italic">{{ $tlncr->uraian_verifikasi }}</textarea>
                            </div>
                        </div>

                        <div class="row-mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Hasil Verifikasi</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hasil_verif" disabled
                                    {{ $tlncr->hasil_verif == 'efektif' ? 'checked' : '' }} id="inlineRadio1"
                                    value="efektif">
                                <label class="form-check-label" for="inlineRadio1">Efektif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hasil_verif" disabled
                                    {{ $tlncr->hasil_verif == 'tdk_efektif' ? 'checked' : '' }} id="inlineRadio2"
                                    value="tdk_efektif">
                                <label class="form-check-label" for="inlineRadio2">Tidak Efektif</label>
                            </div>
                        </div>

                        <br>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Diverifikasi
                                oleh</label>
                            <div class="col-sm-6">
                                <input type="file" name="ttd_tl_verif_auditor" disabled
                                    value="{{ $tlncr->ttd_tl_verif_auditor }}" class="form-control"
                                    id="ttd_tl_verif_auditor" style="font-style:italic">
                                <p class="help-block">
                                    <font color="red">"Format file .jpeg,jpg,png"</font>
                                </p>
                                <input type="text" disabled value="{{ $tlncr->ttd_tl_verif_auditor }}"
                                    class="form-control" style="font-style:italic">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Diverifikasi oleh</label>
                            <div class="col-sm-6">
                                <input type="name" name="verifikator" disabled value="{{ $tlncr->verifikator }}"
                                    class="form-control" id="verifikator" placeholder="Masukkan nama verifikator"
                                    style="font-style:italic">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Verifikasi</label>
                            <div class="col-sm-6">
                                <input type="date" name="tgl_verif" disabled value="{{ $tlncr->tgl_verif }}"
                                    class="form-control" id="tgl_verif">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-6 col-form-label">Rekomendasi tinjauan
                                manajemen</label>
                            <div class="col-sm-6">
                                <textarea type="name" name="rekomendasi" disabled class="form-control" id="rekomendasi" rows="5"
                                    placeholder="Masukkan rekomendasi tinjauan" style="font-style:italic">{{ $tlncr->rekomendasi }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-6 col-form-label">Tanda Tangan Diverifikasi oleh SM
                                Departemen
                                Tata Kelola Perusahaan</label>
                            <div class="col-sm-6">
                                <input type="file" name="ttd_tl_verif_adm" disabled
                                    value="{{ $tlncr->ttd_tl_verif_adm }}" class="form-control" id="ttd_tl_verif_adm"
                                    style="font-style:italic">
                                <p class="help-block">
                                    <font color="red">"Format file .jpeg,jpg,png"</font>
                                </p>
                                <input type="text" disabled value="{{ $tlncr->ttd_tl_verif_adm }}"
                                    class="form-control" style="font-style:italic">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="colFormLabel" class="col-sm-6 col-form-label">Diverifikasi oleh SM Departemen
                                Tata Kelola Perusahaan</label>
                            <div class="col-sm-6">
                                <input type="name" name="namasm_verif" disabled value="{{ $tlncr->namasm_verif }}"
                                    class="form-control" id="namasm_verif" placeholder="Masukkan nama SM Dept. TKP"
                                    style="font-style:italic">
                            </div>
                        </div>
                        <br>
                        <a href="{{ !empty($ref_page) ? url($ref_page) : url('data-ncr') }}" title="Kembali"
                            class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
