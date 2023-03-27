@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>Input Form NC</h2>
                        </div><br>
                        <form action="{{ url('data-nc/form/' . $nc->id_nc) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Opsi Temuan</label>
                                <div class="col-sm-6">
                                    <select name="opsi_temuan" disabled id="opsi_temuan" class="form-control">
                                        <option value="NCR" {{ $nc->opsi_temuan == 'NCR' ? 'selected' : '' }}>NCR</option>
                                        <option value="OFI" {{ $nc->opsi_temuan == 'OFI' ? 'selected' : '' }}>OFI</option>
                                        <option value="Observasi" {{ $nc->opsi_temuan == 'Observasi' ? 'selected' : '' }}>Observasi</option>
                                        <option value="CAR" {{ $nc->opsi_temuan == 'CAR' ? 'selected' : '' }}>CAR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">No. NC</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_nc" class="form-control" id="no_nc"
                                        value="{{ $nc->no_nc }}" disabled>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Terbit</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_terbitnc" class="form-control" id="tgl_terbitnc"
                                        value="{{ $nc->tgl_terbitnc }}" disabled>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Departemen yang diaudit</label>
                                <div class="col-sm-6">
                                    <select name="objek_audit" id="objek_audit" class="form-control" disabled>
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersAuditee as $data_usersAuditee)
                                            <option value="{{ $data_usersAuditee->id }}"
                                                {{ $nc->objek_audit == $data_usersAuditee->id ? 'selected' : '' }}>
                                                {{ $data_usersAuditee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Bab yang diaudit</label>
                                <div class="col-sm-6">
                                    <input type="text" name="bab_audit" class="form-control" id="bab_audit">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Dokumen Acuan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="dok_acuan" class="form-control" id="dok_acuan">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Ketidaksesuaian</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="uraian_nc" id="uraian_nc" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-6">
                                    <select name="kategori" id="kategori" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option>Mayor</option>
                                        <option>Minor</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Auditor</label>
                                <div class="col-sm-6">
                                    <input type="name" name="nama_auditor" class="form-control" id="nama_auditor">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Deadline</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_deadline" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diakui oleh (M/GM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="diakui_oleh" class="form-control" id="diakui_oleh" {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Disetujui oleh (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="disetujui_oleh" class="form-control" id="disetujui_oleh" {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal disetujui</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_accgm" class="form-control" id="tgl_accgm" {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Rencana Tanggal Penyelesaian</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_planaction" class="form-control"
                                        id="tgl_planaction" {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}>
                                </div>
                            </div>
                            <br>
                            <input type="submit" value="Simpan" class="btn btn-info"></input>
                            <a href="{{ url('data-nc') }}" title="Kembali" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
