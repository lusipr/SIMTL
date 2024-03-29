@php
    header('Content-Type: application/vnd.ms-excel');
    header('Cache-Control: no-cache, must-revalidate');
    header('content-disposition: attachment;filename=Cetak NCR.xls');
@endphp

<table id="dataTable3" class="display" style="width:100%" border="1">
    <thead class="thead-dark">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">No. NCR</th>
            <th class="text-center">Periode</th>
            <th class="text-center">Proses</th>
            <th class="text-center">Tema</th>
            <th class="text-center">Objek</th>
            <th class="text-center">Uraian Temuan</th>
            <th class="text-center">Uraian Perbaikan</th>
            {{-- !--<th class="text-center">Dokumen</th>--> --}}
            <th class="text-center">Tgl Terbit</th>
            <th class="text-center">Tgl Deadline</th>
            <th class="text-center">Status</th>
            {{-- <th class="text-center">Bukti</th> --}}
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
                <td class="text-center">{{ $data_ncr->uraian_ncr }}</td>
                {{-- <td class="text-center">{{ $data_ncr->uraian_perbaikan }}</td> --}}
                <td class="text-center">
                    @if ($data_ncr->tlncr)
                        {{ $data_ncr->tlncr->uraian_perbaikan }}
                    @endif
                </td>
                <!--<td class="text-center">{{ $data_ncr->dokumen }}</td>-->
                <td class="text-center">{{ $data_ncr->tgl_terbitncr }}</td>
                <td class="text-center">{{ $data_ncr->tgl_deadline }}</td>
                <td class="text-center">{{ $data_ncr->status }}</td>
                {{-- <td class="text-center">
                    @if (!empty($data_ncr->bukti))
                        <a href="{{ asset('storage/' . $data_ncr->bukti) }}" target="_blank">Lihat Bukti</a>
                    @endif
                </td> --}}
                {{-- <td class="text-center">
                    @foreach ($tlncr as $data_tlncr)
                        @if ($data_ncr->id_ncr == $data_tlncr->id_ncr)
                            {{ $data_tlncr->uraian_perbaikan }}
                        @endif
                    @endforeach
                </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
