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
                                    <input type="text" name="no_ofi" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="no_ofi" value="{{ $ofi->no_ofi }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Proses Audit</label>
                                <div class="col-sm-6">
                                    <select name="proses_audit" {{ empty($tlofi) ? '' : 'disabled' }} id="proses_audit"
                                        class="form-control">
                                        <option value="Internal" {{ $ofi->proses_audit == 'Internal' ? 'selected' : '' }}>
                                            Internal</option>
                                        <option value="Eksternal" {{ $ofi->proses_audit == 'Eksternal' ? 'selected' : '' }}>
                                            Eksternal</option>
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tema Audit</label>
                                <div class="col-sm-6">
                                    <select name="tema_audit" {{ empty($tlofi) ? '' : 'disabled' }} id="tema_audit"
                                        class="form-control">
                                        <option>- Pilih -</option>
                                        <option {{ $ofi->tema_audit == 'ISO 9001' ? 'selected' : '' }}>ISO 9001</option>
                                        <option {{ $ofi->tema_audit == 'ISO 45001' ? 'selected' : '' }}>ISO 45001</option>
                                        <option {{ $ofi->tema_audit == 'ISO 14001' ? 'selected' : '' }}>ISO 14001</option>
                                        <option {{ $ofi->tema_audit == 'ISO 37001' ? 'selected' : '' }}>ISO 37001</option>
                                    </select>
                                </div>
                            </div> --}}

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tema Audit</label>
                                <div class="col-sm-6">
                                    <select name="tema_audit" {{ empty($tlofi) ? '' : 'disabled' }} id="tema_audit"
                                        class="form-control">
                                        <option value="">- Pilih -</option>
                                        @foreach ($usersTema as $data_usersTema)
                                            <option value="{{ $data_usersTema->id }}"
                                                {{ $ofi->tema_audit == $data_usersTema->id ? 'selected' : '' }}>
                                                {{ $data_usersTema->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Objek Audit</label>
                                <div class="col-sm-6">
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

                            <br>
                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Jenis Temuan</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" value="OFI" id="jenis_temuan"
                                        name="jenis_temuan" {{ empty($tlofi) ? '' : 'disabled' }} readonly>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Terbit OFI</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_terbitofi" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="tgl_terbitofi" value="{{ $ofi->tgl_terbitofi }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Deadline</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_deadline" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="tgl_deadline" value="{{ $ofi->tgl_deadline }}">
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
                                    {{-- <input type="text" name="asal_dept" {{ empty($tlofi) ? '' : 'disabled' }} class="form-control" id="asal_dept"
                                        value="{{ $ofi->asal_dept }}"> --}}
                                    <select name="asal_dept" {{ empty($tlofi) ? '' : 'disabled' }} id="asal_dept"
                                        class="form-control">
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
                                    <input type="text" name="proyek" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="proyek" value="{{ $ofi->proyek }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Usulan Peningkatan
                                    Produk/Proses/Sistem Mutu</label>
                                <div class="col-sm-6">
                                    <input type="text" name="usulan_ofi" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="usulan_ofi" value="{{ $ofi->usulan_ofi }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Departemen yang
                                    mengerjakan</label>
                                <div class="col-sm-6">
                                    {{-- <input type="text" name="dept_ygmngrjkn" {{ empty($tlofi) ? '' : 'disabled' }} class="form-control" id="dept_ygmngrjkn"
                                        value="{{ $ofi->dept_ygmngrjkn }}"> --}}
                                    {{-- <select name="dept_ygmngrjkn" {{ empty($tlofi) ? '' : 'disabled' }}
                                        id="dept_ygmngrjkn" class="form-control">
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
                                    <input type="text" name="uraian_permasalahan"
                                        {{ empty($tlofi) ? '' : 'disabled' }} class="form-control"
                                        id="uraian_permasalahan" value="{{ $ofi->uraian_permasalahan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Peningkatan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="usulan_peningkatan" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="usulan_peningkatan"
                                        value="{{ $ofi->usulan_peningkatan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Diusulkan
                                    oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_dept_pengusul" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="ttd_dept_pengusul"
                                        value="{{ $ofi->ttd_dept_pengusul }}">
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
                                    <input type="text" name="dept_pengusul" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="dept_pengusul" value="{{ $ofi->dept_pengusul }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Diusulkan</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_diusulkan" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="tgl_diusulkan" value="{{ $ofi->tgl_diusulkan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanda Tangan Disetujui
                                    Oleh</label>
                                <div class="col-sm-6">
                                    <input type="file" name="ttd_disetujui_oleh_ofi"
                                        {{ empty($tlofi) ? '' : 'disabled' }} class="form-control"
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
                                    <input type="text" name="disetujui_oleh" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="disetujui_oleh" value="{{ $ofi->disetujui_oleh }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Disetujui</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_disetujui" {{ empty($tlofi) ? '' : 'disabled' }}
                                        class="form-control" id="tgl_disetujui" value="{{ $ofi->tgl_disetujui }}">
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Disposisi Wakil
                                    Manajemen</label>
                                <div class="col-sm-6">
                                    <select name="disposisi" {{ empty($tlofi) ? '' : 'disabled' }} id="disposisi"
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}
                                        class="form-control" onchange="doChangeDisposisi(this)">
                                        <option>- Pilih -</option>
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
                                    <input type="file" name="ttd_disposisi" {{ empty($tlofi) ? '' : 'disabled' }}
                                        {{ auth()->user()->role == 'Admin' ? '' : (auth()->user()->role == 'Admin2' ? '' : 'disabled') }}
                                        class="form-control" id="ttd_disposisi" value="{{ $ofi->ttd_disposisi }}">
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
                                    <input type="text" name="disposisi_diselesaikan_oleh"
                                        {{ empty($tlofi) ? '' : 'disabled' }} class="form-control"
                                        id="disposisi_diselesaikan_oleh" value="{{ $ofi->disposisi_diselesaikan_oleh }}">
                                </div>
                            </div>

                            <br>
                            @if (empty($tlofi))
                                <button type="submit" class="btn btn-info">Simpan</button>
                            @endif
                            <a href="{{ url('data-ofi') }}" title="Kembali" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        @if (empty($tlofi))
            doChangeDisposisi(document.getElementById('disposisi'));

            function doChangeDisposisi(doc_id) {

                if (doc_id.value == 'OFI diterima') {

                    document.getElementById('disposisi_diselesaikan_oleh').disabled = false;

                    // document.getElementById('tgl_deadline').disabled = false;
                } else {

                    document.getElementById('disposisi_diselesaikan_oleh').value = '';
                    document.getElementById('disposisi_diselesaikan_oleh').disabled = true;

                    // document.getElementById('tgl_deadline').value = '';
                    // document.getElementById('tgl_deadline').disabled = true;
                }
            }
        @endif

        document.addEventListener('DOMContentLoaded', function() {
            var tgl_terbitofi = document.getElementById('tgl_terbitofi');
            var tgl_deadline = document.getElementById('tgl_deadline');

            tgl_terbitofi.addEventListener('change', function() {
                if (tgl_terbitofi.value !== '') {
                    var deadline = new Date(tgl_terbitofi.value);
                    deadline.setDate(deadline.getDate() + 90);
                    tgl_deadline.valueAsDate = deadline;
                } else {
                    tgl_deadline.value = '';
                }
            });
        });
    </script>
@endsection
