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
                                    <input type="text" name="no_ofi" disabled class="form-control"
                                        id="no_ofi" value="{{ $ofi->no_ofi }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Proses Audit</label>
                                <div class="col-sm-6">
                                    <select name="proses_audit" disabled id="proses_audit" class="form-control">
                                        <option value="Internal" {{ $ofi->proses_audit == 'Internal' ? 'selected' : '' }}>Internal</option>
                                        <option value="Eksternal" {{ $ofi->proses_audit == 'Eksternal' ? 'selected' : '' }}>Eksternal</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tema Audit</label>
                                <div class="col-sm-6">
                                    <select name="tema_audit" disabled id="tema_audit" class="form-control">
                                        <option value="">- Pilih -</option>
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
                                    <select name="jenis_temuan" disabled id="jenis_temuan" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option {{ $ofi->jenis_temuan == 'Ketidaksesuaian' ? 'selected' : '' }}>Ketidaksesuaian</option>
                                        <option {{ $ofi->jenis_temuan == 'Potensi Peningkatan' ? 'selected' : '' }}>Potensi Peningkatan</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Terbit OFI</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_terbitofi" disabled class="form-control"
                                        id="tgl_terbitofi" placeholder="Masukkan Tanggal Audit"
                                        value="{{ $ofi->tgl_terbitofi }}">
                                </div>
                            </div>

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-6">
                                    <select name="status" disabled id="status" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option {{ $ofi->status == 'Data Belum Lengkap' ? 'selected' : '' }}>>Data Belum Lengkap</option>
                                        <option {{ $ofi->status == 'Belum Ditindaklanjuti' ? 'selected' : '' }}>>Belum Ditindaklanjuti</option>
                                        <option {{ $ofi->status == 'Sudah Ditindaklanjuti' ? 'selected' : '' }}>>Sudah Ditindaklanjuti</option>
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
                                    <input type="text" name="asal_dept" disabled class="form-control"
                                        id="asal_dept" value="{{ $ofi->asal_dept }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Proyek</label>
                                <div class="col-sm-6">
                                    <input type="text" name="proyek" disabled class="form-control"
                                        id="proyek" value="{{ $ofi->proyek }}">
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
                                    <input type="text" name="dept_ygmngrjkn" disabled class="form-control"
                                        id="dept_ygmngrjkn" value="{{ $ofi->dept_ygmngrjkn }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Permasalahan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="uraian_permasalahan" disabled
                                        class="form-control" id="uraian_permasalahan" value="{{ $ofi->uraian_permasalahan }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Uraian Peningkatan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="usulan_peningkatan" disabled
                                        class="form-control" id="usulan_peningkatan" value="{{ $ofi->usulan_peningkatan }}">
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

                            <div class="row-mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Disposisi Wakil
                                    Manajemen</label>
                                <div class="col-sm-6">
                                    <select name="disposisi" disabled id="disposisi" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option {{ $ofi->disposisi == 'OFI ditolak' ? 'selected' : '' }}>OFI ditolak</option>
                                        <option {{ $ofi->disposisi == 'OFI diterima' ? 'selected' : '' }}>OFI diterima</option>
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
                                    <input type="date" name="tgl_tl" disabled
                                        value="{{ $tlofi->tgl_tl }}" class="form-control" id="tgl_tl">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Uraian Verifikasi</label>
                                <div class="col-sm-6">
                                    <textarea type="text" name="uraian_verif" disabled class="form-control" id="uraian_verif"
                                        rows="5" placeholder="Masukkan uraian verifikasi" style="font-style:italic">{{ $tlofi->uraian_verif }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Hasil Verifikasi</label>
                                <div class="col-sm-6">
                                    <textarea type="text" name="hasil_verif" disabled class="form-control" id="hasil_verif"
                                        rows="5" placeholder="Masukkan hasil verifikasi" style="font-style:italic">{{ $tlofi->hasil_verif }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Diverifikasi Oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_verifikator" disabled
                                        value="{{ $tlofi->nama_verifikator }}" class="form-control" id="nama_verifikator"
                                        placeholder="Masukkan disini" style="font-style:italic">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Tanggal Verifikasi</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tgl_verif" disabled
                                        value="{{ $tlofi->tgl_verif }}" class="form-control" id="tgl_verif">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Evaluasi Saran</label>
                                <div class="col-sm-6">
                                    <textarea type="text" name="eval_saran" disabled class="form-control" id="eval_saran" rows="5"
                                        placeholder="Masukkan evaluasi saran" style="font-style:italic">{{ $tlofi->eval_saran }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Evaluasi Oleh</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_evaluator" disabled
                                        value="{{ $tlofi->nama_evaluator }}" class="form-control" id="nama_evaluator"
                                        placeholder="Masukkan disini" style="font-style:italic">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Score</label>
                                <div class="col-sm-6">
                                    <input type="text" name="skor" disabled
                                        value="{{ $tlofi->skor }}" class="form-control" id="skor"
                                        placeholder="Masukkan skor" style="font-style:italic">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Rekomendasi Tinjauan
                                    Manajemen</label>
                                <div class="col-sm-6">
                                    <textarea type="text" name="rekom_tinjauan" disabled class="form-control" id="rekom_tinjauan"
                                        rows="5" placeholder="Masukkan rekomendasi disini" style="font-style:italic">{{ $tlofi->rekom_tinjauan }}</textarea>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="colFormLabel" class="col-sm-6 col-form-label">Diverifikasi oleh SM Departemen
                                    Tata Kelola Perusahaan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="namasm_verifikator" disabled
                                        value="{{ $tlofi->namasm_verifikator }}" class="form-control" id="namasm_verifikator"
                                        placeholder="Masukkan disini" style="font-style:italic">
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
@endsection
