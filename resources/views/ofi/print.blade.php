<style>
    @page {
        margin: 10px;
    }

    table {
        border-collapse: collapse;
        border-width: 1px;
        border-style: solid;
        border-color: #000;
    }

    th,
    td {}

    th,
    td {
        padding: 5px;
        font-family: 'Open Sans', sans-serif;
        border-width: 1px 0px 1px 0px;
        border-style: solid;
        border-color: #000;
        line-height: 17px;
        font-size: 15px;
    }
</style>

<table style="width: 100%;">
    <tr>
        <td style="width: 35%; vertical-align: middle; text-align: center;">
            <img src="{{ asset('assets/images/logo-inka-grayscale.png') }}" style="width: 50%;">
        </td>
        <td style="width: 35%; vertical-align: middle; text-align: center; border-left-width: 1px;">
            <span style="font-size: 26px; line-height: 1; font-weight: bold; text-transform: uppercase;">Usulan Untuk
                Peningkatan</span><br>
            <span style="font-size: 17px; text-transform: uppercase; font-style: italic;">Opportunity For Improvement
                (OFI)</span>
        </td>
        <td style="width: 30%; vertical-align: middle; text-align: center; border-left-width: 1px;">
            <table style="width: 100%; border: 0px;">
                <tr>
                    <td style="width: 35%; border: 0px;">
                        No. OFI****
                    </td>
                    <td style="width: 5%; border: 0px;">
                        :
                    </td>
                    <td style="width: 60%; border: 0px;">
                        {{ $ofi->no_ofi }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 35%; border: 0px;">
                        Tgl. Terbit*
                    </td>
                    <td style="width: 5%; border: 0px;">
                        :
                    </td>
                    <td style="width: 60%; border: 0px;">
                        {{ $ofi->tgl_terbitofi }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 5px;">
    <tr>
        <th style="width: 25%; vertical-align: middle; text-align: left;" colspan="3">
            Dari (Bagian / Departemen)*: {{ $ofi->asal_dept }}
        </th>
        <td style="width: 45%; vertical-align: middle; border-left-width: 1px;">
            Kepada:
        </td>
    </tr>
    <tr>
        <td style="width: 25%; vertical-align: middle;">
            Proyek*
        </td>
        <td style="width: 2%; vertical-align: middle;">
            :
        </td>
        <td style="width: 28%; vertical-align: middle;">
            {{ $ofi->proyek }}
        </td>
        <td style="width: 45%; vertical-align: top; border-left-width: 1px;" rowspan="2">
            <div>Usulan peningkatan untuk Produk / Proses / Sistem Mutu Identitas (No. Part / No. Tack / No. Dokumen)*:
            </div>
            {{ $ofi->usulan_ofi }}
        </td>
    </tr>
    <tr>
        <td style="width: 25%; vertical-align: middle;">
            Departemen yang mengerjakan*
        </td>
        <td style="width: 2%; vertical-align: middle;">
            :
        </td>
        <td style="width: 28%; vertical-align: middle;">
            {{ $ofi->dept_ygmngrjkn }}
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="text-align: justify; border-bottom: 1px solid #000;">
                <span
                    style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 25px;">
                    Uraian Permasalahan*:
                </span>
                <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                    {{ $ofi->uraian_permasalahan }}
                </span>
            </div>
            @if (strlen($ofi->uraian_permasalahan) <= 100)
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
            @elseif (strlen($ofi->uraian_permasalahan) <= 200)
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="text-align: justify; border-bottom: 1px solid #000;">
                <span
                    style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 25px;">
                    Usulan Peningkatan*:
                </span>
                <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                    {{ $ofi->usulan_peningkatan }}
                </span>
            </div>
            @if (strlen($ofi->usulan_peningkatan) <= 100)
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
            @elseif (strlen($ofi->usulan_peningkatan) <= 200)
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
            @endif
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <th
            style="width: 100%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: center;">
            Departemen yang mengusulkan*
        </th>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td style="width: 50%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            <table style="width: 100%; border: 0px;">
                <tr>
                    <td style="width: 35%; border: 0px;">
                        Tanggal
                    </td>
                    <td style="width: 5%; border: 0px;">
                        :
                    </td>
                    <td style="width: 60%; border: 0px;">
                        {{ $ofi->tgl_diusulkan }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 35%; border: 0px;">
                        Diusulkan oleh
                    </td>
                    <td style="width: 5%; border: 0px;">
                        :
                    </td>
                    <td style="width: 60%; border: 0px;">
                        {{ $ofi->dept_pengusul }}
                    </td>
                </tr>
            </table>
        </td>
        <td
            style="width: 50%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px; border-left-width: 1px;">
            <table style="width: 100%; border: 0px;">
                <tr>
                    <td style="width: 35%; border: 0px;">
                        Tanggal
                    </td>
                    <td style="width: 5%; border: 0px;">
                        :
                    </td>
                    <td style="width: 60%; border: 0px;">
                        {{ $ofi->tgl_disetujui }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 35%; border: 0px;">
                        Disetujui oleh (M / SM)
                    </td>
                    <td style="width: 5%; border: 0px;">
                        :
                    </td>
                    <td style="width: 60%; border: 0px;">
                        {{ $ofi->disetujui_oleh }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <th
            style="width: 100%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: center;">
            Disposisi Wakil Manajemen
        </th>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td style="width: 25%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            <table style="width: 100%; border: 0px;">
                <tr>
                    <td style="width: 10%; border: 0px;">
                        <span
                            style="padding: 0px 4px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! $ofi->disposisi == 'OFI ditolak' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                    </td>
                    <td style="width: 90%; border: 0px;">
                        OFI Ditolak
                    </td>
                </tr>
            </table>
        </td>
        <td
            style="width: 75%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px; border-left-width: 1px;">
            <table style="width: 100%; border: 0px;">
                <tr>
                    <td style="width: 5%; border: 0px; vertical-align: top;">
                        <span
                            style="padding: 0px 4px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! $ofi->disposisi == 'OFI diterima' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                    </td>
                    <td style="width: 95%; border: 0px; vertical-align: top;">
                        <div style="text-align: justify; border-bottom: 1px solid #000;">
                            <span
                                style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 25px;">
                                OFI Diterima, diselesaikan oleh:
                            </span>
                            <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                {{ $ofi->disposisi_diselesaikan_oleh }}
                            </span>
                        </div>
                        @if (strlen($ofi->disposisi_diselesaikan_oleh) <= 100)
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span
                                    style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                    &nbsp;
                                </span>
                            </div>
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;" colspan="2">
            <div style="text-align: justify; border-bottom: 1px solid #000;">
                <span
                    style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 25px;">
                    Tindak Lanjut Usulan Peningkatan**:
                </span>
                <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                    : {{ $tlofi->tl_usulanofi }}
                </span>
            </div>
            @if (strlen($tlofi->tl_usulanofi) <= 100)
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
            @elseif (strlen($tlofi->tl_usulanofi) <= 200)
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
            @endif
        </td>
    </tr>
    <tr>
        <td style="width: 70%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="border-bottom: 1px solid #000;">&nbsp;</div>
        </td>
        <td style="width: 30%; vertical-align: top; border-top-width: 1px; border-left-width: 1px;" rowspan="3">
            <table style="width: 100%; border: 0px;">
                <tr>
                    <td style="width: 45%; border: 0px;">
                        Tanggal**
                    </td>
                    <td style="width: 5%; border: 0px;">
                        :
                    </td>
                    <td style="width: 50%; border: 0px;">
                        {{ $tlofi->tgl_tl }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 45%; border: 0px;">
                        Tindak lanjut oleh**
                    </td>
                    <td style="width: 5%; border: 0px;">
                        :
                    </td>
                    <td style="width: 50%; border: 0px;">
                        {{ $tlofi->nama_pekerjatl }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="width: 70%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="border-bottom: 1px solid #000;">&nbsp;</div>
        </td>
    </tr>
    <tr>
        <td style="width: 70%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="border-bottom: 1px solid #000;">&nbsp;</div>
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <th
            style="width: 100%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: center;">
            Verifikasi oleh Wakil Manajemen***
        </th>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="text-align: justify; border-bottom: 1px solid #000;">
                <span
                    style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 25px;">
                    Uraian Verifikasi***:
                </span>
                <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                    {{ $tlofi->uraian_verif }}
                </span>
            </div>
            @if (strlen($tlofi->uraian_verif) <= 100)
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
            @endif
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td style="width: 35%; vertical-align: top; text-align: center;">
            <table style="width: 100%; border: 0px;">
                <tr>
                    <td style="width: 35%; border: 0px;">
                        Tanggal
                    </td>
                    <td style="width: 5%; border: 0px;">
                        :
                    </td>
                    <td style="width: 60%; border: 0px;">
                        {{ $tlofi->tgl_verif }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 35%; border: 0px;">
                        Verifikator
                    </td>
                    <td style="width: 5%; border: 0px;">
                        :
                    </td>
                    <td style="width: 60%; border: 0px;">
                        {{ $tlofi->nama_verifikator }}
                    </td>
                </tr>
            </table>
        </td>
        <td style="width: 35%; vertical-align: top; text-align: center; border-left-width: 1px;">
            <table style="width: 100%; border: 0px;">
                <tr>
                    <td style="width: 20%; border: 0px;">
                        Hasil:
                    </td>
                    <td style="width: 10%; border: 0px;">
                        <span
                            style="padding: 0px 4px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! $tlofi->hasil_verif == 'efektif' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                    </td>
                    <td style="width: 70%; border: 0px;">
                        Efektif
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%; border: 0px;">

                    </td>
                    <td style="width: 10%; border: 0px;">
                        <span
                            style="padding: 0px 4px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! $tlofi->hasil_verif == 'tdk_efektif' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                    </td>
                    <td style="width: 70%; border: 0px;">
                        Tidak Efektif
                    </td>
                </tr>
            </table>
        </td>
        <td style="width: 30%; vertical-align: top; text-align: center; border-left-width: 1px;">
            <table style="width: 100%; border: 0px;">
                <tr>
                    <td style="width: 100%: text-align: center; border-top-width: 0px;" align="center"
                        colspan="3">Evaluasi Saran****</td>
                </tr>
                <tr>
                    <td style="width: 35%; border: 0px;">
                        Tanggal Evaluasi oleh
                    </td>
                    <td style="width: 5%; border: 0px;">
                        :
                    </td>
                    <td style="width: 60%; border: 0px;">
                        {{ $tlofi->nama_evaluator }}
                    </td>
                </tr>
                <tr>
                    <td style="width: 35%; border: 0px;">
                        Score
                    </td>
                    <td style="width: 5%; border: 0px;">
                        :
                    </td>
                    <td style="width: 60%; border: 0px;">
                        {{ $tlofi->skor }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td style="width: 10%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            Lampiran
        </td>
        <td style="width: 10%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="border-bottom: 1px solid #000;">1.</div>
        </td>
        <td style="width: 10%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="border-bottom: 1px solid #000;">2.</div>
        </td>
        <td style="width: 10%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="border-bottom: 1px solid #000;">3.</div>
        </td>
    </tr>
    <tr>
        <td style="width: 10%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            
        </td>
        <td style="width: 10%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="border-bottom: 1px solid #000;">4.</div>
        </td>
        <td style="width: 10%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="border-bottom: 1px solid #000;">5.</div>
        </td>
        <td style="width: 10%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="border-bottom: 1px solid #000;">6.</div>
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px; border: 0px;">
    <tr>
        <td style="width: 30%; font-size: 14px; border: 0px;">* Diisi oleh yang mengusulkan OFI.</td>
        <td style="width: 70%; font-size: 14px; border: 0px;">** Diisi oleh departemen yang menindaklanjuti OFI.</td>
    </tr>
    <tr>
        <td style="width: 30%; font-size: 14px; border: 0px;">*** Diisi oleh Wakil Manajemen.</td>
        <td style="width: 70%; font-size: 14px; border: 0px;">**** Diisi Manajemen Mutu & LH (jika diperlukan).</td>
    </tr>
</table>
