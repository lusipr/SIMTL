<?php

namespace App\Http\Controllers;

use App\Models\Ncr;
use App\Models\TLNcr;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NcrController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'Auditee')
        {
            $ncr = Ncr::where('objek_audit', '=', auth()->user()->id)->get();
        }
        else
        {
            $ncr = Ncr::all();
        }

        return view('ncr.index', ['ncr' => $ncr]);
    }

    public function api_status_ncr()
    {
        if (auth()->user()->role == 'Auditee')
        {
            $ncr = DB::select(DB::raw("SELECT * FROM (SELECT COUNT(id_ncr) AS jumlah, status AS name FROM ncr WHERE objek_audit = '" . auth()->user()->id . "' AND (status = 'Sudah Ditindaklanjuti' OR status = 'Belum Ditindaklanjuti') GROUP BY status) AS aa ORDER BY name DESC"));
        }
        else
        {
            $ncr = DB::select(DB::raw("SELECT * FROM (SELECT COUNT(id_ncr) AS jumlah, status AS name FROM ncr WHERE (status = 'Sudah Ditindaklanjuti' OR status = 'Belum Ditindaklanjuti') GROUP BY status) AS aa ORDER BY name DESC"));
        }
        // $ncr = Ncr::selectRaw('COUNT(id_ncr) AS jumlah, status AS name')
        //     ->where('status', '=', 'Sudah Ditindaklanjuti')
        //     ->orWhere('status', '=', 'Belum Ditindaklanjuti')
        //     ->groupBy('status')
        //     ->get();

        return json_encode($ncr);
    }

    public function index_add()
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();

        return view('ncr.add', ['usersAuditee' => $usersAuditee]);
    }

    public function store_add(Request $request)
    {
        $dataSent = $request->except('_token', 'bukti');

        $request->validate([
            'no_ncr' => 'required',
            'objek_audit' => 'required',
            'bukti' => 'mimes:pdf',
        ]);

        if ($request->file('bukti'))
        {
            $dataSent['bukti'] = $request->file('bukti')->store('bukti-ncr');
        }

        $create = Ncr::create($dataSent);

        return redirect('data-ncr/form/' . $create->id);
    }

    public function index_form_ncr(Ncr $ncr)
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();

        return view('ncr.formncr.edit', ['ncr' => $ncr, 'usersAuditee' => $usersAuditee]);
    }

    public function store_form_ncr(Request $request, Ncr $ncr)
    {
        // $validatedData = $request->validate([
        //     'bab_audit' => ''
        // ]);

        Ncr::where('id_ncr', '=', $ncr->id_ncr)->update($request->except('_token'));

        return redirect('data-ncr');
    }

    public function index_edit(Ncr $ncr)
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();

        return view('ncr.edit', ['ncr' => $ncr, 'usersAuditee' => $usersAuditee]);
    }

    public function store_edit(Request $request, Ncr $ncr)
    {
        $dataSent = $request->except('_token', 'bukti');

        $request->validate([
            'bukti' => 'mimes:pdf',
        ]);

        if ($request->file('bukti'))
        {
            $dataSent['bukti'] = $request->file('bukti')->store('bukti-ncr');
        }

        Ncr::where('id_ncr', '=', $ncr->id_ncr)->update($dataSent);

        return redirect('data-ncr');
    }

    public function delete(Ncr $ncr, $ref_page = '')
    {
        Ncr::where('id_ncr', '=', $ncr->id_ncr)->delete();
        TLNcr::where('id_ncr', '=', $ncr->id_ncr)->delete();

        return redirect((!empty($ref_page) ? $ref_page : 'data-ncr'))->with('swal_msg', 'Hapus Data Berhasil');
    }

    public function index_tlncr(Ncr $ncr, $ref_page = '')
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $tlncr = TLNcr::where('id_ncr', '=', $ncr->id_ncr)->first();

        return view('ncr.tlncr.edit', ['ncr' => $ncr, 'tlncr' => $tlncr, 'usersAuditee' => $usersAuditee, 'ref_page' => $ref_page]);
    }

    public function store_tlncr(Request $request, Ncr $ncr, $ref_page = '')
    {
        if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Auditee')
        {
            $validatedDataNcr = $request->validate([
                'diakui_oleh' => '',
                'disetujui_oleh' => '',
                'tgl_accgm' => '',
                'tgl_planaction' => '',
                'bukti' => 'mimes:pdf',
            ]);

            if ($request->file('bukti'))
            {
                $validatedDataNcr['bukti'] = $request->file('bukti')->store('bukti-ncr');
            }

            if (auth()->user()->role == 'Admin')
            {
                $validatedDataNcr['no_ncr'] = $request->no_ncr;
                $validatedDataNcr['proses_audit'] = $request->proses_audit;
                $validatedDataNcr['tema_audit'] = $request->tema_audit;
                $validatedDataNcr['jenis_temuan'] = $request->jenis_temuan;
                $validatedDataNcr['tgl_terbitncr'] = $request->tgl_terbitncr;
                $validatedDataNcr['status'] = $request->status;

                $validatedDataNcr['bab_audit'] = $request->bab_audit;
                $validatedDataNcr['dok_acuan'] = $request->dok_acuan;
                $validatedDataNcr['uraian_ncr'] = $request->uraian_ncr;
                $validatedDataNcr['kategori'] = $request->kategori;
                $validatedDataNcr['nama_auditor'] = $request->nama_auditor;
                $validatedDataNcr['tgl_deadline'] = $request->tgl_deadline;
            }

            $validatedDataTLNcr = $request->validate([
                'akar_masalah' => '',
                'uraian_perbaikan' => '',
                'uraian_pencegahan' => '',
                'tgl_action' => '',
                'tgl_accgm' => '',
            ]);

            $validatedDataTLNcr['id_ncr'] = $ncr->id_ncr;

            if (auth()->user()->role == 'Admin')
            {
                $validatedDataTLNcr['uraian_verifikasi'] = $request->uraian_verifikasi;
                $validatedDataTLNcr['hasil_verif'] = $request->hasil_verif;
                $validatedDataTLNcr['verifikator'] = $request->verifikator;
                $validatedDataTLNcr['tgl_verif'] = $request->tgl_verif;
                $validatedDataTLNcr['rekomendasi'] = $request->rekomendasi;
                $validatedDataTLNcr['namasm_verif'] = $request->namasm_verif;
            }

            Ncr::where('id_ncr', '=', $ncr->id_ncr)->update($validatedDataNcr);
            TLNcr::updateOrCreate(['id_ncr' => $ncr->id_ncr], $validatedDataTLNcr);
        }

        if (auth()->user()->role == 'Auditor')
        {
            Ncr::where('id_ncr', '=', $ncr->id_ncr)->update(['status' => $request->status]);
        }

        return redirect((!empty($ref_page) ? $ref_page : 'data-ncr'));
    }

    public function view_tlncr(Ncr $ncr, $ref_page = '')
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $tlncr = TLNcr::where('id_ncr', '=', $ncr->id_ncr)->first();

        return view('ncr.tlncr.view', ['ncr' => $ncr, 'tlncr' => $tlncr, 'usersAuditee' => $usersAuditee, 'ref_page' => $ref_page]);
    }

    public function print(Ncr $ncr)
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $tlncr = TLNcr::where('id_ncr', '=', $ncr->id_ncr)->first();

        $dompdf = Pdf::loadView('ncr.print', ['ncr' => $ncr, 'tlncr' => $tlncr, 'usersAuditee' => $usersAuditee]);
        $dompdf->add_info('Title', 'Cetak NCR');
        $dompdf->setPaper('A3');
        return $dompdf->stream('Cetak NCR.pdf', array("Attachment" => false));
    }
}
