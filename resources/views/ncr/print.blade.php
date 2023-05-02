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
        <td style="width: 45%; vertical-align: middle; text-align: center;">
            <img src="{{ asset('assets/images/logo-inka.png') }}" style="width: 50%;">
        </td>
        <td style="width: 55%; vertical-align: middle; text-align: center; border-left-width: 1px;">
            <span style="font-size: 20px; font-weight: bold; text-transform: uppercase;">Laporan Ketidak Sesuaian
                Audit</span><br>
            <span style="font-size: 17px; text-transform: uppercase; font-style: italic;">(Non Conformity Report For
                Audit)</span>
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 5px;">
    <tr>
        <td style="width: 20%; vertical-align: middle;">
            NCR No.
        </td>
        <td style="width: 60%; vertical-align: middle;">
            : {{ $ncr->no_ncr }}
        </td>
        <td style="width: 20%; vertical-align: middle; border-left-width: 1px;">
            {{-- Tanggal: {{ $ncr->tgl_terbitncr }} --}}
            Tanggal: {{ $ncr->tgl_terbitncr ? date('d-m-Y', strtotime($ncr->tgl_terbitncr)) : '' }}
        </td>
    </tr>
    <tr>
        <td style="width: 20%; vertical-align: middle;">
            Departemen yang diaudit
        </td>
        <td style="width: 80%; vertical-align: middle;" colspan="2">
            : {{ $ncr->users->name }}
        </td>
    </tr>
    <tr>
        <td style="width: 20%; vertical-align: middle;">
            Bab yang diaudit
        </td>
        <td style="width: 80%; vertical-align: middle;" colspan="2">
            : {{ $ncr->bab_audit }}
        </td>
    </tr>
    <tr>
        <td style="width: 20%; vertical-align: middle;">
            Dokumen Acuan
        </td>
        <td style="width: 80%; vertical-align: middle;" colspan="2">
            : {{ $ncr->dok_acuan }}
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;" colspan="2">
            <div style="text-align: justify; border-bottom: 1px solid #000;">
                <span
                    style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 45px;">
                    Uraian ketidaksesuaian
                </span>
                <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                    : {{ $ncr->uraian_ncr }}
                </span>
            </div>
            @if (strlen($ncr->uraian_ncr) <= 100)
                <div style="text-align: justify; border-bottom: 1px solid #000;">
                    <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                        &nbsp;
                    </span>
                </div>
            @endif
        </td>
    </tr>

    <tr>
        <td style="width: 80%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="border-bottom: 1px solid #000;">&nbsp;</div>
        </td>
        <td style="width: 20%; vertical-align: middle; border-top-width: 0px; border-left-width: 0px;">
            <table style="width: 100%; border: 0px;">
                <tr>
                    <td style="width: 60%; border: 0px; text-align: right;">
                        Kategori:
                    </td>
                    <td style="width: 20%; border: 0px;">
                        <span
                            style="padding: 0px 4px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! $ncr->kategori == 'Mayor' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                    </td>
                    <td style="width: 20%; border: 0px;">
                        Mayor
                    </td>
                </tr>
                <tr>
                    <td style="width: 60%; border: 0px; text-align: right;">

                    </td>
                    <td style="width: 20%; border: 0px;">
                        <span
                            style="padding: 0px 4px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! $ncr->kategori == 'Minor' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                    </td>
                    <td style="width: 20%; border: 0px;">
                        Minor
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td
            style="width: 8%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: right;">
            Auditor:
        </td>
        <td style="width: 40%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
        <td style="width: 7%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
        <td style="width: 45%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; border-left-width: 1px;"
            colspan="3">
            Diakui oleh *:
        </td>
    </tr>
    <tr>
        <td style="width: 8%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
        <td style="width: 40%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            <img width="50" height="60" src="{{ asset('storage/' . $ncr->ttd_auditor) }}" alt=" ">
            <br>
            <div style="border-bottom: 1px dotted #000;">{{ $ncr->nama_auditor }}</div>
        </td>
        <td style="width: 7%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
        <td
            style="width: 8%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; border-left-width: 1px;">
            (M/SM)
        </td>
        <td style="width: 15%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            <img width="50" height="60" src="{{ asset('storage/' . $ncr->ttd_auditee) }}" alt=" ">
            <br>
            <div style="border-bottom: 1px dotted #000;">{{ $ncr->diakui_oleh }}</div>
        </td>
        <td style="width: 2%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td style="width: 35%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            Disetujui General Manager/Senior Manager *
        </td>
        <td style="width: 1%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            :
        </td>
        <td style="width: 23%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            <img width="50" height="60" src="{{ asset('storage/' . $ncr->ttd_auditee_gm_sm) }}" alt=" ">
            <br>
            <div style="border-bottom: 1px dotted #000;">{{ $ncr->disetujui_oleh1 }}</div>
        </td>
        <td style="width: 4%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
        <td
            style="width: 19%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: right;">
            Tanggal Disetujui *
        </td>
        <td style="width: 1%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            :
        </td>
        <td style="width: 15%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="border-bottom: 1px dotted #000;">
                {{-- {{ $ncr->tgl_accgm1 }} --}}
                {{ $ncr->tgl_accgm1 ? date('d-m-Y', strtotime($ncr->tgl_accgm1)) : '' }}
            </div>
        </td>
        <td style="width: 2%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
    </tr>
    <tr>
        <td style="width: 35%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            Rencana tanggal penyelesaian *
        </td>
        <td style="width: 1%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            :
        </td>
        <td style="width: 34%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;" colspan="3">
            <div style="border-bottom: 1px dotted #000;">
                {{-- {{ $ncr->tgl_planaction }} --}}
                {{ $ncr->tgl_planaction ? date('d-m-Y', strtotime($ncr->tgl_planaction)) : '' }}
            </div>
        </td>
        <td style="width: 30%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;" colspan="3">
            &nbsp;
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td style="width: 100%; border: 0px; padding: 0;">
            <table style="width: 100%; border: 0px;">
                <tr>
                    <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;"
                        colspan="2">
                        <div style="text-align: justify; border-bottom: 1px solid #000;">
                            <span
                                style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 20px;">
                                Akar penyebab permasalahan * :
                            </span>
                            <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                {{ !empty($tlncr->akar_masalah) ? $tlncr->akar_masalah : '' }}
                            </span>
                        </div>
                        @if (strlen(!empty($tlncr->akar_masalah) ? $tlncr->akar_masalah : '') <= 100)
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                    &nbsp;
                                </span>
                            </div>
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="width: 100%; border: 0px; padding: 0;">
            <table style="width: 100%; border: 0px;">
                <tr>
                    <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;"
                        colspan="2">
                        <div style="text-align: justify; border-bottom: 1px solid #000;">
                            <span
                                style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 20px;">
                                Uraian Perbaikan * :
                            </span>
                            <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                {{ !empty($tlncr->uraian_perbaikan) ? $tlncr->uraian_perbaikan : '' }}
                            </span>
                        </div>
                        @if (strlen(!empty($tlncr->uraian_perbaikan) ? $tlncr->uraian_perbaikan : '') <= 100)
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                    &nbsp;
                                </span>
                            </div>
                        @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="width: 100%; border: 0px; padding: 0;">
            <table style="width: 100%; border: 0px;">
                <tr>
                    <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;"
                        colspan="2">
                        <div style="text-align: justify; border-bottom: 1px solid #000;">
                            <span
                                style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 20px;">
                                Uraian Pencegahan untuk menjamin tidak terulang * :
                            </span>
                            <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                {{ !empty($tlncr->uraian_pencegahan) ? $tlncr->uraian_pencegahan : '' }}
                            </span>
                        </div>
                        @if (strlen(!empty($tlncr->uraian_pencegahan) ? $tlncr->uraian_pencegahan : '') <= 100)
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
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
        <td style="width: 35%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            Tanggal penyelesaian *
        </td>
        <td style="width: 1%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            :
        </td>
        <td style="width: 34%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
            colspan="3">
            <div style="border-bottom: 1px dotted #000;">
                {{ !empty($tlncr->tgl_action) ? date('d-m-Y', strtotime($tlncr->tgl_action)) : '' }}
            </div>
        </td>
        <td style="width: 30%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
            colspan="3">
            &nbsp;
        </td>
    </tr>
    <tr>
        <td style="width: 35%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            Disetujui General Manager/Senior Manager *
        </td>
        <td style="width: 1%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            :
        </td>
        <td style="width: 23%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            <img width="50" height="60" src="{{ !empty($tlncr->ttd_tl_gm) ? asset('storage/' . $tlncr->ttd_tl_gm) : '' }}" alt="Ttd disetujui oleh">
            <br>
            <div style="border-bottom: 1px dotted #000;">{{ $ncr->disetujui_oleh2 }}</div>
        </td>
        <td style="width: 4%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
        <td
            style="width: 19%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: right;">
            Tanggal Disetujui *
        </td>
        <td style="width: 1%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            :
        </td>
        <td style="width: 15%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="border-bottom: 1px dotted #000;">
                {{-- {{ !empty($tlncr->tgl_accgm) ? $tlncr->tgl_accgm : '' }} --}}
                {{ !empty($tlncr->tgl_accgm2) ? date('d-m-Y', strtotime($tlncr->tgl_accgm2)) : '' }}
            </div>
        </td>
        <td style="width: 2%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td style="width: 80%; border: 0px; padding: 0; vertical-align: top;">
            <table style="width: 100%; border: 0px;">
                <tr>
                    <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;"
                        colspan="2">
                        <div style="text-align: justify; border-bottom: 1px solid #000;">
                            <span style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px;">
                                Verifikasi
                            </span>
                            <span
                                style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px;">
                                :
                            </span>
                            <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                {{ !empty($tlncr->uraian_verifikasi) ? $tlncr->uraian_verifikasi : '' }}
                            </span>
                        </div>
                        @if (strlen(!empty($tlncr->uraian_verifikasi) ? $tlncr->uraian_verifikasi : '') <= 100)
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span
                                    style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                    &nbsp;
                                </span>
                            </div>
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span
                                    style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                    &nbsp;
                                </span>
                            </div>
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span
                                    style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                    &nbsp;
                                </span>
                            </div>
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span
                                    style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                    &nbsp;
                                </span>
                            </div>
                        @elseif (strlen(!empty($tlncr->uraian_verifikasi) ? $tlncr->uraian_verifikasi : '') <= 200)
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span
                                    style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                    &nbsp;
                                </span>
                            </div>
                            <div style="text-align: justify; border-bottom: 1px solid #000;">
                                <span
                                    style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                                    &nbsp;
                                </span>
                            </div>
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
        <td style="width: 20%; padding: 0; border-left-width: 1px; vertical-align: top;">
            <table style="width: 100%; border: 0px;">
                <tr>
                    <td style="width: 100%: text-align: center; border-top-width: 0px;" align="center"
                        colspan="2">Hasil Verifikasi</td>
                </tr>
                <tr>
                    <td style="width: 35%; border: 0px; padding-top: 15px;" align="right">
                        <span
                            style="padding: 0px 6px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! (!empty($tlncr->hasil_verif) ? $tlncr->hasil_verif : '') == 'efektif' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                    </td>
                    <td style="width: 65%; border: 0px; padding-top: 15px;">
                        Efektif
                    </td>
                </tr>
                <tr>
                    <td style="width: 35%; border: 0px;" align="right">
                        <span
                            style="padding: 0px 6px; border: 1px solid #000; font-family: DejaVu Sans, serif;">{!! (!empty($tlncr->hasil_verif) ? $tlncr->hasil_verif : '') == 'tdk_efektif' ? '&check;' : '&nbsp;&nbsp;&nbsp;' !!}</span>
                    </td>
                    <td style="width: 65%; border: 0px;">
                        Tidak efektif
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%: text-align: center; border: 0px; font-size: 13px;" align="center"
                        colspan="2">(Akan dibahas dalam Tinjauan Manajemen)</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td style="width: 14%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            Diverifikasi oleh:
        </td>
        <td
            style="width: 20%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: center;">
            (Auditor)
        </td>
        <td style="width: 46%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
        <td style="width: 20%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
            colspan="2">
            &nbsp;
        </td>
    </tr>
    <tr>
        <td style="width: 14%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
        <td style="width: 20%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            <img width="50" height="60" src="{{ !empty($tlncr->ttd_tl_verif_auditor) ? asset('storage/' . $tlncr->ttd_tl_verif_auditor) : '' }}" alt="Ttd verif auditor">
            <br>
            <div style="border-bottom: 1px dotted #000;">{{ !empty($tlncr->verifikator) ? $tlncr->verifikator : '' }}</div>
        </td>
        <td
            style="width: 46%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: right;">
            Tanggal:
        </td>
        <td style="width: 18%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="border-bottom: 1px dotted #000;">
                {{-- {{ !empty($tlncr->tgl_verif) ? $tlncr->tgl_verif : '' }} --}}
                {{ !empty($tlncr->tgl_verif) ? date('d-m-Y', strtotime($tlncr->tgl_verif)) : '' }}
            </div>
        </td>
        <td style="width: 2%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px;">
    <tr>
        <td style="width: 100%; vertical-align: top; border-top-width: 0px; border-bottom-width: 0px;"
            colspan="2">
            <div style="text-align: justify; border-bottom: 1px solid #000;">
                <span
                    style="padding-bottom: 1.55px; border-bottom: 3px solid #fff; line-height: 27px; padding-right: 20px;">
                    Rekomendasi Tinjauan Manajemen :
                </span>
                <span style="padding-bottom: 2.55px; border-bottom: 1px solid #000; line-height: 27px;">
                    {{ !empty($tlncr->rekomendasi) ? $tlncr->rekomendasi : '' }}
                </span>
            </div>
            @if (strlen(!empty($tlncr->rekomendasi) ? $tlncr->rekomendasi : '') <= 100)
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
        <td style="width: 44%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            Diverifikasi oleh Senior Manager Tata Kelola Perusahaan: 
            <br>
            <img width="50" height="60" src="{{ !empty($tlncr->ttd_tl_verif_adm) ? asset('storage/' . $tlncr->ttd_tl_verif_adm) : '' }}" alt="Ttd verif admin2">
            <br>
            {{ !empty($tlncr->namasm_verif) ? $tlncr->namasm_verif : '' }}
        </td>
        <td
            style="width: 10%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: center;">
            &nbsp;
        </td>
        <td style="width: 26%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
        <td style="width: 20%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;"
            colspan="2">
            &nbsp;
        </td>
    </tr>
    <tr>
        <td style="width: 44%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
        <td style="width: 10%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
        <td
            style="width: 26%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px; text-align: right;">
            Tanggal:
        </td>
        <td style="width: 18%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            <div style="border-bottom: 1px dotted #000;">
                {{-- {{ !empty($tlncr->tgl_verif_adm2) ? $tlncr->tgl_verif_adm2 : '' }} --}}
                {{ !empty($tlncr->tgl_verif_adm2) ? date('d-m-Y', strtotime($tlncr->tgl_verif_adm2)) : '' }}
            </div>
        </td>
        <td style="width: 2%; vertical-align: middle; border-top-width: 0px; border-bottom-width: 0px;">
            &nbsp;
        </td>
    </tr>
</table>

<table style="width: 100%; padding-top: 1px; border: 0px;">
    <tr>
        <td style="width: 100%; font-size: 14px; border: 0px;">* Diisi oleh auditee</td>
    </tr>
</table>
