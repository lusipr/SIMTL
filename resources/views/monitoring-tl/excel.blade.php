@php
    header('Content-Type: application/vnd.ms-excel');
    header('Cache-Control: no-cache, must-revalidate');
    header('content-disposition: attachment;filename=Cetak Monitoring TL.xls');
@endphp

<table id="dataTable3" class="display" style="width:100%" border="1">
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
        </tr>
    </thead>
    <tbody>
        @foreach ($monitoringtl as $data_monitoringtl)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td class="text-center">{{ $data_monitoringtl->jenis_temuan }}</td>
                <td class="text-center">{{ $data_monitoringtl->no_dokumen }}<br>
                    {{-- <a
                        href="{{ $data_monitoringtl->type == 'ncr' ? url('data-ncr/tlncr/view/' . $data_monitoringtl->id . '/monitoring-tl') : url('data-ofi/tlofi/view/' . $data_monitoringtl->id . '/monitoring-tl') }}">see
                        detail</a> --}}
                </td>
                </td>
                <td class="text-center">{{ $data_monitoringtl->proses_audit }}</td>
                <td class="text-center">{{ $data_monitoringtl->users_tema->name }}</td>
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
                        <a href="{{ asset('storage/' . $data_monitoringtl->bukti) }}" target="_blank">Lihat Bukti</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
