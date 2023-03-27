@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <!-- market value area start -->
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>Data Tindak Lanjut</h2>
                            <a href="{{ url('monitoring-tl/excel') }}" target="_blank" style="background-color: #107c41; margin-bottom: 20px;" class="btn btn-success">Excel</a>
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
                                        <th class="text-center">Jenis Temuan</th>
                                        <th class="text-center">No. Dokumen</th>
                                        <th class="text-center">Proses</th>
                                        <th class="text-center">Tema</th>
                                        <th class="text-center">Objek</th>
                                        <th class="text-center">Tgl. Deadline</th>
                                        <th class="text-center">Tgl. Penyelesaian</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Bukti</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($monitoringtl as $data_monitoringtl)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td class="text-center">{{ $data_monitoringtl->jenis_temuan }}</td>
                                            <td class="text-center">{{ $data_monitoringtl->no_dokumen }}<br>
                                                <a
                                                    href="{{ $data_monitoringtl->type == 'ncr' ? url('data-ncr/tlncr/view/' . $data_monitoringtl->id . '/monitoring-tl') : url('data-ofi/tlofi/view/' . $data_monitoringtl->id . '/monitoring-tl') }}">see
                                                    detail</a>
                                            </td>
                                            </td>
                                            <td class="text-center">{{ $data_monitoringtl->proses_audit }}</td>
                                            <td class="text-center">{{ $data_monitoringtl->tema_audit }}</td>
                                            <td class="text-center">{{ $data_monitoringtl->users->name }}</td>
                                            <td class="text-center">
                                                @php
                                                    $tgl_deadline = new DateTime($data_monitoringtl->tgl_deadline);
                                                    $tgl_mulai = new DateTime($data_monitoringtl->tgl_mulai);
                                                    $interval = $tgl_mulai->diff($tgl_deadline);
                                                    $daysDiff = $interval->format('%r%a');
                                                @endphp
                                                @if ($daysDiff < 0)
                                                    <span class="p-2 badge badge-danger">{{ $data_monitoringtl->tgl_deadline }}</span>
                                                @elseif ($daysDiff < 7)
                                                    <span class="p-2 badge badge-warning">{{ $data_monitoringtl->tgl_deadline }}</span>
                                                @else
                                                    <span class="p-2 badge badge-primary">{{ $data_monitoringtl->tgl_deadline }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $data_monitoringtl->tgl_mulai }}</td>
                                            <td class="text-center">{{ $data_monitoringtl->status }}</td>
                                            <td class="text-center">
                                                @if (!empty($data_monitoringtl->bukti))
                                                    <a href="{{ asset('storage/' . $data_monitoringtl->bukti) }}"
                                                        target="_blank">Lihat Bukti</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ $data_monitoringtl->type == 'ncr' ? url('data-ncr/print/' . $data_monitoringtl->id) : url('data-ofi/print/' . $data_monitoringtl->id) }}" target="_blank"
                                                    class="btn btn-secondary"><i class="ti-printer"></i></a>
                                                <!--<a href="{{ $data_monitoringtl->type == 'ncr' ? url('data-ncr/tlncr/view/' . $data_monitoringtl->id . '/monitoring-tl') : url('data-ofi/tlofi/view/' . $data_monitoringtl->id . '/monitoring-tl') }}"
                                                    class="btn btn-warning"><i class="ti-eye"></i></a>
                                                @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Auditor')
                                                    <a href="{{ $data_monitoringtl->type == 'ncr' ? url('data-ncr/tlncr/input/' . $data_monitoringtl->id . '/monitoring-tl') : url('data-ofi/tlofi/input/' . $data_monitoringtl->id . '/monitoring-tl') }}"
                                                        class="btn btn-primary"><i class="ti-pencil-alt"></i></a>
                                                @endif-->
                                                @if (auth()->user()->role == 'Admin')
                                                    <a href="{{ $data_monitoringtl->type == 'ncr' ? url('data-ncr/delete/' . $data_monitoringtl->id . '/monitoring-tl') : url('data-ofi/delete/' . $data_monitoringtl->id . '/monitoring-tl') }}"
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
