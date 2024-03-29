@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>Input Form NCR</h2>
                        </div><br>
                        <form action="{{ url('data-ncr/form/' . $ncr->id_ncr) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">No. NCR</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_ncr" class="form-control" id="no_ncr"
                                        value="{{ $ncr->no_ncr }}" readonly>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tema audit</label>
                                <div class="col-sm-6">
                                    <select name="tema_audit" {{ empty($tlncr) ? '' : 'disabled' }} id="tema_audit"
                                        class="form-control" readonly>
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersTema as $data_usersTema)
                                            <option value="{{ $data_usersTema->id }}"
                                                {{ $ncr->tema_audit == $data_usersTema->id ? 'selected' : '' }}>
                                                {{ $data_usersTema->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Departemen yang diaudit</label>
                                <div class="col-sm-6">
                                    <select name="objek_audit" id="objek_audit" class="form-control" disabled
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}>
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersAuditee as $data_usersAuditee)
                                            <option value="{{ $data_usersAuditee->id }}"
                                                {{ $ncr->objek_audit == $data_usersAuditee->id ? 'selected' : '' }}>
                                                {{ $data_usersAuditee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal terbit</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_terbitncr" class="form-control" id="tgl_terbitncr"
                                        value="{{ $ncr->tgl_terbitncr }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal deadline</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_deadline" id="tgl_deadline" class="form-control"
                                        value="{{ $ncr->tgl_deadline }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Bab yang diaudit</label>
                                <div class="col-sm-6">
                                    <input type="text" name="bab_audit" class="form-control" id="bab_audit"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Dokumen acuan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="dok_acuan" class="form-control" id="dok_acuan"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian ketidaksesuaian</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="uraian_ncr" id="uraian_ncr" rows="5"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}></textarea>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-6">
                                    <select name="kategori" id="kategori" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}>
                                        <option value="">- Pilih -</option>
                                        <option>Mayor</option>
                                        <option>Minor</option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda tangan auditor</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_auditor" class="form-control" id="ttd_auditor"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}>
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama auditor</label>
                                <div class="col-sm-6">
                                    <input type="name" name="nama_auditor" class="form-control" id="nama_auditor"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled') }}>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda tangan diakui oleh
                                    (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_auditee" class="form-control" id="ttd_auditee"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama diakui oleh (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="diakui_oleh" class="form-control" id="diakui_oleh"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jabatan diakui oleh
                                    (M/SM)</label>
                                <div class="col-sm-6">
                                    {{-- <input type="name" name="diakui_oleh" class="form-control" id="diakui_oleh"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}> --}}
                                    <select name="diakui_oleh_jabatan" id="diakui_oleh_jabatan" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                        <option value="">- Pilih -</option>
                                        <option>Manager</option>
                                        <option>Senior Manager</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama jabatan diakui oleh (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="diakui_oleh_jabatan_nm" class="form-control" id="diakui_oleh_jabatan_nm"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda tangan disetujui oleh
                                    (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_auditee_gm_sm" class="form-control"
                                        id="ttd_auditee_gm_sm"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama disetujui oleh (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="disetujui_oleh1" class="form-control"
                                        id="disetujui_oleh1"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jabatan disetujui Oleh (SM/GM)</label>
                                <div class="col-sm-6">
                                    <select name="disetujui_oleh1_jabatan" id="disetujui_oleh1_jabatan" class="form-control"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                        <option value="">- Pilih -</option>
                                        <option>Senior Manager</option>
                                        <option>General Manager</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama jabatan disetujui Oleh (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="disetujui_oleh1_jabatan_nm" class="form-control"
                                        id="disetujui_oleh1_jabatan_nm"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal disetujui (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_accgm1" class="form-control" id="tgl_accgm1"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Rencana tanggal
                                    penyelesaian</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_planaction" class="form-control" id="tgl_planaction"
                                        {{ auth()->user()->role == 'Admin1' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled') }}>
                                </div>
                            </div>
                            <br>
                            <input type="submit" value="Simpan" class="btn btn-info"></input>
                            <a href="{{ url('data-ncr') }}" title="Kembali" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tgl_terbitncr = document.getElementById('tgl_terbitncr');
            var tgl_deadline = document.getElementById('tgl_deadline');

            tgl_terbitncr.addEventListener('change', function() {
                if (tgl_terbitncr.value !== '') {
                    var deadline = new Date(tgl_terbitncr.value);
                    deadline.setDate(deadline.getDate() + 30);
                    tgl_deadline.valueAsDate = deadline;
                } else {
                    tgl_deadline.value = '';
                }
            });
        });
    </script>
@endsection
