@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <form action="{{ url('data-nc/edit/' . $nc->id_nc) }}" method="post" enctype="multipart/form-data"
            accept-charset="utf-8">
            @csrf
            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h2>Edit NC</h2>
                            </div><br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Opsi Temuan</label>
                                <div class="col-sm-6">
                                    <select name="opsi_temuan" {{ empty($tlnc) ? '' : 'disabled' }} id="opsi_temuan"
                                        class="form-control" readonly>
                                        <option value="NCR" {{ $nc->opsi_temuan == 'NCR' ? 'selected' : '' }}>NCR
                                        </option>
                                        <option value="OFI" {{ $nc->opsi_temuan == 'OFI' ? 'selected' : '' }}>OFI
                                        </option>
                                        <option value="Observasi" {{ $nc->opsi_temuan == 'Observasi' ? 'selected' : '' }}>
                                            Observasi</option>
                                        <option value="CAR" {{ $nc->opsi_temuan == 'CAR' ? 'selected' : '' }}>CAR
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">No. NC</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_nc" {{ empty($tlnc) ? '' : 'disabled' }}
                                        class="form-control" id="no_nc" value="{{ $nc->no_nc }}" readonly>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Proses Audit</label>
                                <div class="col-sm-6">
                                    <select name="proses_audit" {{ empty($tlnc) ? '' : 'disabled' }} id="proses_audit"
                                        class="form-control">
                                        <option value="Internal" {{ $nc->proses_audit == 'Internal' ? 'selected' : '' }}>
                                            Internal</option>
                                        <option value="Eksternal" {{ $nc->proses_audit == 'Eksternal' ? 'selected' : '' }}>
                                            Eksternal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tema Audit</label>
                                <div class="col-sm-6">
                                    <select name="tema_audit" {{ empty($tlnc) ? '' : 'disabled' }} id="tema_audit"
                                        class="form-control">
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersTema as $data_usersTema)
                                            <option value="{{ $data_usersTema->id }}"
                                                {{ $nc->tema_audit == $data_usersTema->id ? 'selected' : '' }}>
                                                {{ $data_usersTema->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Objek Audit</label>
                                <div class="col-sm-6">
                                    <select name="objek_audit" {{ empty($tlnc) ? '' : 'disabled' }} id="objek_audit"
                                        class="form-control">
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersAuditee as $data_usersAuditee)
                                            <option value="{{ $data_usersAuditee->id }}"
                                                {{ $nc->objek_audit == $data_usersAuditee->id ? 'selected' : '' }}>
                                                {{ $data_usersAuditee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jenis Temuan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" value="NC" id="jenis_temuan"
                                        name="jenis_temuan" {{ empty($tlnc) ? '' : 'disabled' }} readonly>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Terbit NC</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_terbitnc" {{ empty($tlnc) ? '' : 'disabled' }}
                                        class="form-control" id="tgl_terbitnc" value="{{ $nc->tgl_terbitnc }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Deadline</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_deadline" {{ empty($tlnc) ? '' : 'disabled' }}
                                        class="form-control" id="tgl_deadline" value="{{ $nc->tgl_deadline }}">
                                </div>
                            </div>

                            <!--<div class="row-mb-3">
                                                                        <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                                                                        <div class="col-sm-6">
                                                                            <select name="status" {{ empty($tlnc) ? '' : 'disabled' }} id="status" class="form-control">
                                                                                <option value="">- Pilih -</option>
                                                                                <option {{ $nc->status == 'Data Belum Lengkap' ? 'selected' : '' }}>Data Belum Lengkap</option>
                                                                                <option {{ $nc->status == 'Belum Ditindaklanjuti' ? 'selected' : '' }}>Belum Ditindaklanjuti</option>
                                                                                <option {{ $nc->status == 'Sudah Ditindaklanjuti' ? 'selected' : '' }}>Sudah Ditindaklanjuti</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <br>

                                                                    <div class="row-mb-3">
                                                                        <label for="colFormLabel" class="col-sm-2 col-form-label">Bukti</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="file" name="bukti" {{ empty($tlnc) ? '' : 'disabled' }} id="bukti" class="form-control"
                                                                                accept="application/pdf">
                                                                            <p class="help-block">
                                                                                <font color="red">"Format file .pdf"</font>
                                                                            </p>
                                                                        </div>
                                                                    </div>-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <h2>Form NC</h2>
                            </div><br>
                            <!--<input type='hidden' class="form-control" name="id_nc" {{ empty($tlnc) ? '' : 'disabled' }} value=""readonly>-->

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Bab yang diaudit</label>
                                <div class="col-sm-6">
                                    <input type="text" name="bab_audit" {{ empty($tlnc) ? '' : 'disabled' }}
                                        class="form-control" id="bab_audit" value="{{ $nc->bab_audit }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Dokumen Acuan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="dok_acuan" {{ empty($tlnc) ? '' : 'disabled' }}
                                        class="form-control" id="dok_acuan" value="{{ $nc->dok_acuan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Ketidaksesuaian</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" name="uraian_nc" {{ empty($tlnc) ? '' : 'disabled' }} id="uraian_nc" rows="5">{{ $nc->uraian_nc }}</textarea>
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-6">
                                    <select name="kategori" {{ empty($tlnc) ? '' : 'disabled' }} id="kategori"
                                        class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option {{ $nc->kategori == 'Mayor' ? 'selected' : '' }}>Mayor</option>
                                        <option {{ $nc->kategori == 'Minor' ? 'selected' : '' }}>Minor</option>
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Auditor</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_auditor_nc" {{ empty($tlnc) ? '' : 'disabled' }}
                                        class="form-control" id="ttd_auditor_nc" value="{{ $nc->ttd_auditor_nc }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="name" {{ empty($tlnc) ? '' : 'disabled' }} class="form-control"
                                        value="{{ $nc->ttd_auditor_nc }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Nama Auditor</label>
                                <div class="col-sm-6">
                                    <input type="name" name="nama_auditor" {{ empty($tlnc) ? '' : 'disabled' }}
                                        class="form-control" id="nama_auditor" value="{{ $nc->nama_auditor }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Diakui oleh
                                    (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_diakui_oleh_nc"
                                        {{ empty($tlnc) ? (auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled')) : 'disabled' }}
                                        class="form-control" id="ttd_diakui_oleh_nc"
                                        value="{{ $nc->ttd_diakui_oleh_nc }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text" class="form-control" value="{{ $nc->ttd_diakui_oleh_nc }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diakui oleh (M/SM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="diakui_oleh"
                                        {{ empty($tlnc) ? (auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled')) : 'disabled' }}
                                        class="form-control" id="diakui_oleh" value="{{ $nc->diakui_oleh }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Disetujui oleh
                                    (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_disetujui_oleh_nc"
                                        {{ empty($tlnc) ? (auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled')) : 'disabled' }}
                                        class="form-control" id="ttd_disetujui_oleh_nc"
                                        value="{{ $nc->ttd_disetujui_oleh_nc }}">
                                    <p class="help-block">
                                        <font color="red">"Format file .jpeg,jpg,png"</font>
                                    </p>
                                    <input type="text"
                                        {{ empty($tlnc) ? (auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled')) : 'disabled' }}
                                        class="form-control" value="{{ $nc->ttd_disetujui_oleh_nc }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Disetujui oleh (SM/GM)</label>
                                <div class="col-sm-6">
                                    <input type="name" name="disetujui_oleh"
                                        {{ empty($tlnc) ? (auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled')) : 'disabled' }}
                                        class="form-control" id="disetujui_oleh" value="{{ $nc->disetujui_oleh }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal disetujui GM</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_accgm"
                                        {{ empty($tlnc) ? (auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditee' ? '' : 'disabled')) : 'disabled' }}
                                        class="form-control" id="tgl_accgm" value="{{ $nc->tgl_accgm }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Rencana Tanggal
                                    Penyelesaian</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_planaction"
                                        {{ empty($tlnc) ? (auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Auditor' ? '' : 'disabled')) : 'disabled' }}
                                        class="form-control" id="tgl_planaction" value="{{ $nc->tgl_planaction }}">
                                </div>
                            </div>
                            <br>
                            @if (empty($tlnc))
                                <button type="submit" class="btn btn-info">Simpan</button>
                            @endif
                            <a href="{{ url('data-nc') }}" title="Kembali" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tgl_terbitnc = document.getElementById('tgl_terbitnc');
            var tgl_deadline = document.getElementById('tgl_deadline');

            tgl_terbitnc.addEventListener('change', function() {
                if (tgl_terbitnc.value !== '') {
                    var deadline = new Date(tgl_terbitnc.value);
                    deadline.setDate(deadline.getDate() + 45);
                    tgl_deadline.valueAsDate = deadline;
                } else {
                    tgl_deadline.value = '';
                }
            });
        });
    </script>
@endsection
