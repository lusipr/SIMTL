@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <form action="{{ url('data-ncr/edit/' . $ncr->id_ncr) }}" method="post" enctype="multipart/form-data"
            accept-charset="utf-8">
            @csrf
            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h2>Edit NCR</h2>
                            </div><br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">No. NCR</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_ncr" {{ empty($tlncr) ? '' : 'disabled' }}
                                        class="form-control" id="no_ncr" value="{{ $ncr->no_ncr }}" readonly>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jenis Temuan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" value="NCR" id="jenis_temuan"
                                        name="jenis_temuan" {{ empty($tlncr) ? '' : 'disabled' }} readonly>
                                </div>
                            </div>
                            <br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Proses Audit</label>
                                <div class="col-sm-6">
                                    <select name="proses_audit" {{ empty($tlncr) ? '' : 'disabled' }} id="proses_audit"
                                        class="form-control" readonly>
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

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Objek Audit</label>
                                <div class="col-sm-6">
                                    <select name="objek_audit" {{ empty($tlncr) ? '' : 'disabled' }} id="objek_audit"
                                        class="form-control">
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
                                    <input type="date" name="tgl_terbitncr" {{ empty($tlncr) ? '' : 'disabled' }}
                                        class="form-control" id="tgl_terbitncr" value="{{ $ncr->tgl_terbitncr }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Deadline</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_deadline" {{ empty($tlncr) ? '' : 'disabled' }}
                                        class="form-control" id="tgl_deadline" value="{{ $ncr->tgl_deadline }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h2>Form NCR</h2>
                            </div>
                            <br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Bab yang diaudit</label>
                                <div class="col-sm-6">
                                    <input type="text" name="bab_audit" {{ empty($tlncr) ? '' : 'disabled' }}
                                        class="form-control" id="bab_audit" value="{{ $ncr->bab_audit }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Dokumen Acuan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="dok_acuan" {{ empty($tlncr) ? '' : 'disabled' }}
                                        class="form-control" id="dok_acuan" value="{{ $ncr->dok_acuan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Ketidaksesuaian</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="uraian_ncr" {{ empty($tlncr) ? '' : 'disabled' }} id="uraian_ncr"
                                        rows="5">{{ $ncr->uraian_ncr }}</textarea>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-6">
                                    <select name="kategori" {{ empty($tlncr) ? '' : 'disabled' }} id="kategori"
                                        class="form-control">
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
                                    <input type="file" name="ttd_auditor" {{ empty($tlncr) ? '' : 'disabled' }}
                                        class="form-control" id="ttd_auditor" value="{{ $ncr->ttd_auditor }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control" value="{{ $ncr->ttd_auditor }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Auditor</label>
                                <div class="col-sm-6">
                                    <input type="name" name="nama_auditor" {{ empty($tlncr) ? '' : 'disabled' }}
                                        class="form-control" id="nama_auditor" value="{{ $ncr->nama_auditor }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Diakui Oleh
                                    (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_auditee"
                                        {{ empty($tlncr) ? (auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled')) : 'disabled' }}
                                        class="form-control" id="ttd_auditee" value="{{ $ncr->ttd_auditee }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control" value="{{ $ncr->ttd_auditee }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama diakui oleh (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="diakui_oleh"
                                        {{ empty($tlncr) ? (auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled')) : 'disabled' }}
                                        class="form-control" id="diakui_oleh" value="{{ $ncr->diakui_oleh }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jabatan diakui oleh
                                    (M/SM)</label>
                                <div class="col-sm-6">
                                    <select name="diakui_oleh_jabatan"
                                        {{ empty($tlncr) ? (auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled')) : 'disabled' }}
                                        id="diakui_oleh_jabatan" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option {{ $ncr->diakui_oleh_jabatan == 'Manager' ? 'selected' : '' }}>Manager
                                        </option>
                                        <option {{ $ncr->diakui_oleh_jabatan == 'Senior manager' ? 'selected' : '' }}>Senior
                                            manager</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Disetujui Oleh
                                    (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_auditee_gm_sm"
                                        {{ empty($tlncr) ? (auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled')) : 'disabled' }}
                                        class="form-control" id="ttd_auditee_gm_sm"
                                        value="{{ $ncr->ttd_auditee_gm_sm }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control" value="{{ $ncr->ttd_auditee_gm_sm }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama disetujui oleh
                                    (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="disetujui_oleh1"
                                        {{ empty($tlncr) ? (auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled')) : 'disabled' }}
                                        class="form-control" id="disetujui_oleh1" value="{{ $ncr->disetujui_oleh1 }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jabatan disetujui oleh
                                    (SM/GM)</label>
                                <div class="col-sm-6">
                                    <select name="disetujui_oleh1_jabatan"
                                        {{ empty($tlncr) ? (auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled')) : 'disabled' }}
                                        id="disetujui_oleh1_jabatan" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option {{ $ncr->disetujui_oleh1_jabatan == 'Senior Manager' ? 'selected' : '' }}>
                                            Senior Manager</option>
                                        <option {{ $ncr->disetujui_oleh1_jabatan == 'General Manager' ? 'selected' : '' }}>
                                            General Manager</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal disetujui GM</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_accgm1"
                                        {{ empty($tlncr) ? (auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled')) : 'disabled' }}
                                        class="form-control" id="tgl_accgm1" value="{{ $ncr->tgl_accgm1 }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Rencana Tanggal
                                    Penyelesaian</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_planaction"
                                        {{ empty($tlncr) ? (auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled')) : 'disabled' }}
                                        class="form-control" id="tgl_planaction" value="{{ $ncr->tgl_planaction }}">
                                </div>
                            </div>
                            <br>
                            @if (empty($tlncr))
                                <button type="submit" class="btn btn-info">Simpan</button>
                            @endif
                            <a href="{{ url('data-ncr') }}" title="Kembali" class="btn btn-secondary">Batal</a>
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
                    deadline.setDate(deadline.getDate() + 30);
                    tgl_deadline.valueAsDate = deadline;
                } else {
                    tgl_deadline.value = '';
                }
            });
        });
    </script>
@endsection
