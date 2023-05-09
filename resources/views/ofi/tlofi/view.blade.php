@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <form action="{{ url('data-ofi/tlofi/input/' . $ofi->id_ofi) }}" method="post" enctype="multipart/form-data"
            accept-charset="utf-8">
            @csrf
            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h2>Form OFI</h2>
                            </div><br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">No. OFI</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_ofi" disabled class="form-control" id="no_ofi"
                                        value="{{ $ofi->no_ofi }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Proses Audit</label>
                                <div class="col-sm-6">
                                    <select name="proses_audit" disabled id="proses_audit" class="form-control">
                                        <option value="Internal" {{ $ofi->proses_audit == 'Internal' ? 'selected' : '' }}>
                                            Internal</option>
                                        <option value="Eksternal" {{ $ofi->proses_audit == 'Eksternal' ? 'selected' : '' }}>
                                            Eksternal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Objek Audit</label>
                                <div class="col-sm-6">
                                    <select name="tema_audit" id="tema_audit" class="form-control" disabled>
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersTema as $data_usersTema)
                                            <option value="{{ $data_usersTema->id }}"
                                                {{ $ofi->tema_audit == $data_usersTema->id ? 'selected' : '' }}>
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
                                                {{ $ofi->objek_audit == $data_usersAuditee->id ? 'selected' : '' }}>
                                                {{ $data_usersAuditee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jenis Temuan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" value="OFI" id="jenis_temuan"
                                        name="jenis_temuan" disabled>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Terbit OFI</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_terbitofi" disabled class="form-control"
                                        id="tgl_terbitofi" value="{{ $ofi->tgl_terbitofi }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Deadline OFI</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_deadline" disabled class="form-control"
                                        id="tgl_deadline" value="{{ $ofi->tgl_deadline }}">
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-6">
                                    <select name="status" disabled id="status" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option {{ $ofi->status == 'Data Belum Lengkap' ? 'selected' : '' }}>>Data Belum
                                            Lengkap</option>
                                        <option {{ $ofi->status == 'Belum Ditindaklanjuti' ? 'selected' : '' }}>>Belum
                                            Ditindaklanjuti</option>
                                        <option {{ $ofi->status == 'Sudah Ditindaklanjuti' ? 'selected' : '' }}>>Sudah
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
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Dari Bagian/Departemen</label>
                                <div class="col-sm-6">
                                    {{-- <input type="text" name="asal_dept" disabled class="form-control"
                                        id="asal_dept" value="{{ $ofi->asal_dept }}"> --}}
                                    <select name="asal_dept" id="asal_dept" class="form-control" disabled>
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersAuditee as $data_usersAuditee)
                                            <option value="{{ $data_usersAuditee->id }}"
                                                {{ $ofi->asal_dept == $data_usersAuditee->id ? 'selected' : '' }}>
                                                {{ $data_usersAuditee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Proyek</label>
                                <div class="col-sm-6">
                                    <input type="text" name="proyek" disabled class="form-control" id="proyek"
                                        value="{{ $ofi->proyek }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Usulan Peningkatan
                                    Produk/Proses/Sistem Mutu</label>
                                <div class="col-sm-6">
                                    <input type="text" name="usulan_ofi" disabled class="form-control"
                                        id="usulan_ofi" value="{{ $ofi->usulan_ofi }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Departemen yang
                                    mengerjakan</label>
                                <div class="col-sm-6">
                                    {{-- <input type="text" name="dept_ygmngrjkn" disabled class="form-control"
                                        id="dept_ygmngrjkn" value="{{ $ofi->dept_ygmngrjkn }}"> --}}
                                    {{-- <select name="dept_ygmngrjkn" id="dept_ygmngrjkn" class="form-control" disabled>
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersAuditee as $data_usersAuditee)
                                            <option value="{{ $data_usersAuditee->id }}"
                                                {{ $ofi->dept_ygmngrjkn == $data_usersAuditee->id ? 'selected' : '' }}>
                                                {{ $data_usersAuditee->name }}</option>
                                        @endforeach
                                    </select> --}}
                                    <select name="objek_audit" {{ empty($tlofi) ? '' : 'disabled' }} id="objek_audit"
                                        class="form-control">
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersAuditee as $data_usersAuditee)
                                            <option value="{{ $data_usersAuditee->id }}"
                                                {{ $ofi->objek_audit == $data_usersAuditee->id ? 'selected' : '' }}>
                                                {{ $data_usersAuditee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Permasalahan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="uraian_permasalahan" disabled class="form-control"
                                        id="uraian_permasalahan" value="{{ $ofi->uraian_permasalahan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Peningkatan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="usulan_peningkatan" disabled class="form-control"
                                        id="usulan_peningkatan" value="{{ $ofi->usulan_peningkatan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Diusulkan
                                    oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_dept_pengusul" disabled class="form-control"
                                        id="ttd_dept_pengusul" value="{{ $ofi->ttd_dept_pengusul }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control" value="{{ $ofi->ttd_dept_pengusul }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diusulkan oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="dept_pengusul" disabled class="form-control"
                                        id="dept_pengusul" value="{{ $ofi->dept_pengusul }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Diusulkan</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_diusulkan" disabled class="form-control"
                                        id="tgl_diusulkan" value="{{ $ofi->tgl_diusulkan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Disetujui
                                    Oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_disetujui_oleh_ofi" disabled class="form-control"
                                        id="ttd_disetujui_oleh_ofi" value="{{ $ofi->ttd_disetujui_oleh_ofi }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control"
                                        value="{{ $ofi->ttd_disetujui_oleh_ofi }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Disetujui Oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="disetujui_oleh" disabled class="form-control"
                                        id="disetujui_oleh" value="{{ $ofi->disetujui_oleh }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Disetujui</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_disetujui" disabled class="form-control"
                                        id="tgl_disetujui" value="{{ $ofi->tgl_disetujui }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Disposisi Wakil
                                    Manajemen</label>
                                <div class="col-sm-6">
                                    <select name="disposisi" disabled id="disposisi" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option {{ $ofi->disposisi == 'OFI ditolak' ? 'selected' : '' }}>OFI ditolak
                                        </option>
                                        <option {{ $ofi->disposisi == 'OFI diterima' ? 'selected' : '' }}>OFI diterima
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Diselesaikan
                                    Oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_disposisi" disabled class="form-control"
                                        id="ttd_disposisi" value="{{ $ofi->ttd_disposisi }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control" value="{{ $ofi->ttd_disposisi }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diselesaikan Oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="disposisi_diselesaikan_oleh" disabled
                                        class="form-control" id="disposisi_diselesaikan_oleh"
                                        value="{{ $ofi->disposisi_diselesaikan_oleh }}">
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
                                <h2>Input Tindak Lanjut OFI</h2>
                            </div><br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Tindak Lanjut Usulan
                                    Peningkatan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="tl_usulanofi" disabled
                                        value="{{ $tlofi->tl_usulanofi }}" class="form-control" id="tl_usulanofi"
                                        placeholder="Masukkan tindak lanjut usulan" style="font-style:italic">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Ditindaklanjuti
                                    oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_tlofi_oleh" disabled
                                        value="{{ $tlofi->ttd_tlofi_oleh }}" class="form-control" id="ttd_tlofi_oleh"
                                        style="font-style:italic">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" value="{{ $tlofi->ttd_tlofi_oleh }}" class="form-control"
                                        style="font-style:italic" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Ditindaklanjuti oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_pekerjatl" disabled
                                        value="{{ $tlofi->nama_pekerjatl }}" class="form-control" id="nama_pekerjatl"
                                        placeholder="Masukkan disini" style="font-style:italic">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Tanggal Tindak Lanjut</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_tl" disabled value="{{ $tlofi->tgl_tl }}"
                                        class="form-control" id="tgl_tl">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Uraian Verifikasi</label>
                                <div class="col-sm-6">
                                    <textarea type="text" name="uraian_verif" disabled class="form-control" id="uraian_verif" rows="5"
                                        placeholder="Masukkan uraian verifikasi" style="font-style:italic">{{ $tlofi->uraian_verif }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Hasil Verifikasi</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hasil_verif" disabled
                                        {{ $tlofi->hasil_verif == 'efektif' ? 'checked' : '' }} id="inlineRadio1"
                                        value="efektif">
                                    <label class="form-check-label" for="inlineRadio1">Efektif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hasil_verif" disabled
                                        {{ $tlofi->hasil_verif == 'tdk_efektif' ? 'checked' : '' }} id="inlineRadio2"
                                        value="tdk_efektif">
                                    <label class="form-check-label" for="inlineRadio2">Tidak Efektif</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Diverifikasi
                                    Oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_tlofi_verif" disabled
                                        value="{{ $tlofi->ttd_tlofi_verif }}" class="form-control" id="ttd_tlofi_verif"
                                        style="font-style:italic">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" value="{{ $tlofi->ttd_tlofi_verif }}" class="form-control"
                                        style="font-style:italic" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diverifikasi Oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_verifikator" disabled
                                        value="{{ $tlofi->nama_verifikator }}" class="form-control"
                                        id="nama_verifikator" placeholder="Masukkan disini" style="font-style:italic">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Verifikasi</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_verif" disabled value="{{ $tlofi->tgl_verif }}"
                                        class="form-control" id="tgl_verif">
                                </div>
                            </div>

                            <br>
                            <a href="{{ !empty($ref_page) ? url($ref_page) : url('data-ofi') }}" title="Kembali"
                                class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tgl_terbitofi = document.getElementById('tgl_terbitofi');
            var tgl_deadline = document.getElementById('tgl_deadline');

            tgl_terbitofi.addEventListener('change', function() {
                if (tgl_terbitofi.value !== '') {
                    var deadline = new Date(tgl_terbitofi.value);
                    deadline.setDate(deadline.getDate() + 60);
                    tgl_deadline.valueAsDate = deadline;
                } else {
                    tgl_deadline.value = '';
                }
            });
        });
    </script>
@endsection
