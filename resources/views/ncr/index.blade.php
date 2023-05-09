@extends('layouts.main')

@section('content')
    <div class="main-content-inner">

        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>Data NCR</h2>
                            <a href="{{ url('data-ncr/excel') }}" target="_blank"
                                style="background-color: #107c41; margin-bottom: 20px; margin-left: auto; margin-right: 20px;"
                                class="btn btn-success">Excel</a>
                            @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Auditor')
                                <a href="{{ url('data-ncr/add') }}" style="margin-bottom: 20px;"
                                    class="btn btn-success">Tambah
                                    NCR</a>
                            @endif
                        </div><br>
                        <div class="row mb-0 mb-lg-3">
                            <div class="col-12">
                                <label for="minDateFilter" class="form-label">Filter Tanggal</label>
                            </div>
                            <div class="col-lg-auto mb-3 my-lg-auto">
                                <input type="date" id="minDateFilter" class="form-control form-control-sm">
                            </div>
                            <div class="col-lg-auto mb-3 my-lg-auto">
                                s/d
                            </div>
                            <div class="col-lg-auto mb-3 my-lg-auto">
                                <input type="date" id="maxDateFilter" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="data-tables datatable-dark">
                            <table id="dataTable3" class="display" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">No. NCR</th>
                                        <th class="text-center">Periode</th>
                                        <th class="text-center">Proses</th>
                                        <th class="text-center">Tema</th>
                                        <th class="text-center">Objek</th>
                                        <!--<th class="text-center">Dokumen</th>-->
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Tgl. Deadline</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Bukti</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ncr as $data_ncr)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td class="text-center">{{ $data_ncr->no_ncr }}<br>

                                            </td>
                                            <td class="text-center">{{ $data_ncr->periode_audit }}</td>
                                            <td class="text-center">{{ $data_ncr->proses_audit }}</td>
                                            <td class="text-center">{{ $data_ncr->users_tema->name }}</td>
                                            <td class="text-center">{{ $data_ncr->users->name }}</td>
                                            <!--<td class="text-center">{{ $data_ncr->dokumen }}</td>-->
                                            <td class="text-center">{{ $data_ncr->tgl_terbitncr }}</td>
                                            <td class="text-center">{{ $data_ncr->tgl_deadline }}</td>
                                            <td class="text-center">{{ $data_ncr->status }}</td>
                                            <td class="text-center">
                                                @if (!empty($data_ncr->bukti))
                                                    <a href="{{ asset('storage/' . $data_ncr->bukti) }}"
                                                        target="_blank">Lihat Bukti</a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ url('data-ncr/print/' . $data_ncr->id_ncr) }}" target="_blank"
                                                    class="btn btn-secondary"><i class="ti-printer"></i></a>
                                                <a href="{{ url('data-ncr/tlncr/input/' . $data_ncr->id_ncr) }}"
                                                    class="btn btn-warning"><i class="ti-plus"></i></a>
                                                @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Auditor')
                                                    <a href="{{ url('data-ncr/edit/' . $data_ncr->id_ncr) }}"
                                                        class="btn btn-primary"><i class="ti-pencil-alt"></i></a>
                                                @endif
                                                @if (auth()->user()->role == 'Admin')
                                                    <a href="{{ url('data-ncr/delete/' . $data_ncr->id_ncr) }}"
                                                        class="btn btn-danger"><i class="ti-trash"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('swal_msg'))
        <script>
            Swal.fire({
                title: 'Hapus Data Berhasil',
                text: '',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {})
        </script>
    @endif
@endsection
