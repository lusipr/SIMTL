@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <form action="{{ url('data-ofi/edit/' . $ofi->id_ofi) }}" method="post" enctype="multipart/form-data"
            accept-charset="utf-8">
            @csrf
            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h2>Edit OFI</h2>
                            </div><br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">No. OFI</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_ofi" class="form-control" id="no_ofi"
                                        value="{{ $ofi->no_ofi }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Proses Audit</label>
                                <div class="col-sm-6">
                                    <select name="proses_audit" id="proses_audit" class="form-control">
                                        <option value="Internal" {{ $ofi->proses_audit == 'Internal' ? 'selected' : '' }}>Internal</option>
                                        <option value="Eksternal" {{ $ofi->proses_audit == 'Eksternal' ? 'selected' : '' }}>Eksternal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tema Audit</label>
                                <div class="col-sm-6">
                                    <select name="tema_audit" id="tema_audit" class="form-control">
                                        <option>- Pilih -</option>
                                        <option {{ $ofi->tema_audit == 'ISO 9001' ? 'selected' : '' }}>ISO 9001</option>
                                        <option {{ $ofi->tema_audit == 'ISO 45001' ? 'selected' : '' }}>ISO 45001</option>
                                        <option {{ $ofi->tema_audit == 'ISO 14001' ? 'selected' : '' }}>ISO 14001</option>
                                        <option {{ $ofi->tema_audit == 'ISO 37001' ? 'selected' : '' }}>ISO 37001</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Objek Audit</label>
                                <div class="col-sm-6">
                                    <select name="objek_audit" id="objek_audit" class="form-control">
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
                                    <input class="form-control" type="text" value="OFI" id="jenis_temuan" disabled
                                        readonly>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Terbit OFI</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_terbitofi" class="form-control" id="tgl_terbitofi"
                                        value="{{ $ofi->tgl_terbitofi }}">
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-6">
                                    <select name="status" id="status" class="form-control">
                                        <option>- Pilih -</option>
                                        <option {{ $ofi->status == 'Data Belum Lengkap' ? 'selected' : '' }}>Data Belum Lengkap</option>
                                        <option {{ $ofi->status == 'Belum Ditindaklanjuti' ? 'selected' : '' }}>Belum Ditindaklanjuti</option>
                                        <option {{ $ofi->status == 'Sudah Ditindaklanjuti' ? 'selected' : '' }}>Sudah Ditindaklanjuti</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Bukti</label>
                                <div class="col-sm-6">
                                    <input type="file" name="bukti" id="bukti" class="form-control"
                                        accept="application/pdf">
                                    <p class="help-block">
                                        <font color="red">"Format file .pdf"</font>
                                    </p>
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
                                <h2>Edit Form OFI</h2>
                            </div><br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Dari Bagian/Departemen</label>
                                <div class="col-sm-6">
                                    <input type="text" name="asal_dept" class="form-control" id="asal_dept"
                                        value="{{ $ofi->asal_dept }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Proyek</label>
                                <div class="col-sm-6">
                                    <input type="text" name="proyek" class="form-control" id="proyek"
                                        value="{{ $ofi->proyek }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Usulan Peningkatan
                                    Produk/Proses/Sistem Mutu</label>
                                <div class="col-sm-6">
                                    <input type="text" name="usulan_ofi" class="form-control" id="usulan_ofi"
                                        value="{{ $ofi->usulan_ofi }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Departemen yang
                                    mengerjakan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="dept_ygmngrjkn" class="form-control" id="dept_ygmngrjkn"
                                        value="{{ $ofi->dept_ygmngrjkn }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Permasalahan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="uraian_permasalahan" class="form-control"
                                        id="uraian_permasalahan" value="{{ $ofi->uraian_permasalahan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Peningkatan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="usulan_peningkatan" class="form-control"
                                        id="usulan_peningkatan" value="{{ $ofi->usulan_peningkatan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diusulkan oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="dept_pengusul" class="form-control" id="dept_pengusul"
                                        value="{{ $ofi->dept_pengusul }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Diusulkan</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_diusulkan" class="form-control" id="tgl_diusulkan"
                                        value="{{ $ofi->tgl_diusulkan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Disetujui Oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="disetujui_oleh" class="form-control" id="disetujui_oleh"
                                        value="{{ $ofi->disetujui_oleh }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Disetujui</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_disetujui" class="form-control" id="tgl_disetujui"
                                        value="{{ $ofi->tgl_disetujui }}">
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Disposisi Wakil
                                    Manajemen</label>
                                <div class="col-sm-6">
                                    <select name="disposisi" id="disposisi" class="form-control">
                                        <option>- Pilih -</option>
                                        <option {{ $ofi->disposisi == 'OFI ditolak' ? 'selected' : '' }}>OFI ditolak</option>
                                        <option {{ $ofi->disposisi == 'OFI diterima' ? 'selected' : '' }}>OFI diterima</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Deadline</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_deadline" class="form-control" id="tgl_deadline"
                                        value="{{ $ofi->tgl_deadline }}">
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-info">Simpan</button>
                            <a href="{{ url('data-ofi') }}" title="Kembali" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
