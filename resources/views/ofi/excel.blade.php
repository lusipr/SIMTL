@php
    header('Content-Type: application/vnd.ms-excel');
    header('Cache-Control: no-cache, must-revalidate');
    header('content-disposition: attachment;filename=Cetak OFI.xls');
@endphp

<table id="dataTable3" class="display" style="width:100%" border="1">
    <thead class="thead-dark">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">No. Ofi</th>
            <th class="text-center">Proses</th>
            <th class="text-center">Tema</th>
            <th class="text-center">Objek</th>
            <th class="text-center">Diselesaikan Oleh</th>
            <th class="text-center">Uraian Permasalahan</th>
            <th class="text-center">Usulan Peningkatan</th>
            <th class="text-center">Tgl Terbit</th>
            <th class="text-center">Tgl Deadline</th>
            <th class="text-center">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ofi as $data_ofi)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td class="text-center">{{ $data_ofi->no_ofi }}<br>

                </td>
                <td class="text-center">{{ $data_ofi->proses_audit }}</td>
                <td class="text-center">{{ $data_ofi->users_tema->name }}</td>
                <td class="text-center">{{ $data_ofi->users->name }}</td>
                <td class="text-center">{{ !empty($data_ofi->user_disposisi_diselesaikan_oleh->name) ? $data_ofi->user_disposisi_diselesaikan_oleh->name : '' }}</td>
                <td class="text-center">{{ $data_ofi->uraian_permasalahan }}</t>
                <td class="text-center">{{ $data_ofi->usulan_peningkatan }}</t>
                <td class="text-center">{{ $data_ofi->tgl_terbitofi }}</t>
                <td class="text-center">{{ $data_ofi->tgl_deadline }}</td>
                <td class="text-center">{{ $data_ofi->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
