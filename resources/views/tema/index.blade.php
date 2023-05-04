@extends('layouts.main')

@section('content')
    <div class="main-content-inner">
        <div class="row mt-5 mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h2>Daftar {{ $title }}</h2>
                            <a href="{{ url('data-tema/add') }}" style="margin-bottom:20px"
                                class="btn btn-success col-md-2">Tambah
                            </a>

                        </div><br>
                        <div class="data-tables datatable-dark">
                            <table id="dataTable3" class="display" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 4%;" class="text-center">No</th>
                                        <th class="text-center">Nama Tema</th>
                                        <th class="text-center">Username</th>
                                        {{-- <th class="text-center">Password</th> --}}
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            {{-- <td class="text-center">{{ $user->nip }}</td> --}}
                                            <td class="text-center">{{ $user->name }}</td>
                                            {{-- <td class="text-center">{{ $user->role }}</td> --}}
                                            <td class="text-center">{{ $user->username }}</td>
                                            {{-- <td class="text-center">{{ $user->password }}</td> --}}
                                            <td class="text-center">
                                                <a href="{{ url('data-tema/edit/' . $user->id) }}"
                                                    class="btn btn-primary"><i class="ti-pencil-alt"></i></a>
                                                <a href="{{ url('data-tema/delete/' . $user->id) }}"
                                                    class="btn btn-danger"><i class="ti-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{-- <tbody>
                                    @foreach ($tema as $tema)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + 1 }}</td> --}}
                                            {{-- <td class="text-center">{{ $user->nip }}</td> --}}
                                            {{-- <td class="text-center">{{ $tema->nama_tema }}</td> --}}
                                            {{-- <td class="text-center">{{ $user->role }}</td> --}}
                                            {{-- <td class="text-center">{{ $tema->username }}</td> --}}
                                            {{-- <td class="text-center">{{ $user->password }}</td> --}}
                                            {{-- <td class="text-center">
                                                <a href="{{ url('data-tema/edit/' . $tema->id_tema) }}"
                                                    class="btn btn-primary"><i class="ti-pencil-alt"></i></a>
                                                <a href="{{ url('data-tema/delete/' . $tema->id_tema) }}"
                                                    class="btn btn-danger"><i class="ti-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody> --}}
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
