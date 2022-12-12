<?php

namespace App\Http\Controllers;

use App\Models\Ofi;
use App\Models\TLOfi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfiController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'Auditee')
        {
            $ofi = Ofi::where('objek_audit', '=', auth()->user()->id)->get();
        }
        else
        {
            $ofi = Ofi::all();
        }

        return view('ofi.index', ['ofi' => $ofi]);
    }

    public function api_status_ofi()
    {
        if (auth()->user()->role == 'Auditee')
        {
            $ofi = DB::select(DB::raw("SELECT * FROM (SELECT COUNT(id_ofi) AS jumlah, status AS name FROM ofi WHERE objek_audit = '" . auth()->user()->id . "' AND (status = 'Sudah Ditindaklanjuti' OR status = 'Belum Ditindaklanjuti') GROUP BY status) AS aa ORDER BY name DESC"));
        }
        else
        {
            $ofi = DB::select(DB::raw("SELECT * FROM (SELECT COUNT(id_ofi) AS jumlah, status AS name FROM ofi WHERE (status = 'Sudah Ditindaklanjuti' OR status = 'Belum Ditindaklanjuti') GROUP BY status) AS aa ORDER BY name DESC"));
        }
        // $ofi = Ofi::selectRaw('COUNT(id_ofi) AS jumlah, status AS name')
        //     ->where('status', '=', 'Sudah Ditindaklanjuti')
        //     ->orWhere('status', '=', 'Belum Ditindaklanjuti')
        //     ->groupBy('status')
        //     ->get();

        return json_encode($ofi);
    }

    public function index_add()
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();

        return view('ofi.add', ['usersAuditee' => $usersAuditee]);
    }

    public function store_add(Request $request)
    {
        $dataSent = $request->except('_token', 'bukti');

        $request->validate([
            'no_ofi' => 'required',
            'objek_audit' => 'required',
            'bukti' => 'mimes:pdf',
        ]);

        if ($request->file('bukti'))
        {
            $dataSent['bukti'] = $request->file('bukti')->store('bukti-ofi');
        }

        $create = Ofi::create($dataSent);

        return redirect('data-ofi/form/' . $create->id);
    }

    public function index_form_ofi(Ofi $ofi)
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();

        return view('ofi.formofi.edit', ['ofi' => $ofi, 'usersAuditee' => $usersAuditee]);
    }

    public function store_form_ofi(Request $request, Ofi $ofi)
    {
        // $validatedData = $request->validate([
        //     'bab_audit' => ''
        // ]);

        Ofi::where('id_ofi', '=', $ofi->id_ofi)->update($request->except('_token'));

        return redirect('data-ofi');
    }

    public function index_edit(Ofi $ofi)
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();

        return view('ofi.edit', ['ofi' => $ofi, 'usersAuditee' => $usersAuditee]);
    }

    public function store_edit(Request $request, Ofi $ofi)
    {
        $dataSent = $request->except('_token', 'bukti');

        $request->validate([
            'bukti' => 'mimes:pdf',
        ]);

        if ($request->file('bukti'))
        {
            $dataSent['bukti'] = $request->file('bukti')->store('bukti-ofi');
        }

        Ofi::where('id_ofi', '=', $ofi->id_ofi)->update($dataSent);

        return redirect('data-ofi');
    }

    public function delete(Ofi $ofi, $ref_page = '')
    {
        Ofi::where('id_ofi', '=', $ofi->id_ofi)->delete();
        TLOfi::where('id_ofi', '=', $ofi->id_ofi)->delete();

        return redirect((!empty($ref_page) ? $ref_page : 'data-ofi'))->with('swal_msg', 'Hapus Data Berhasil');
    }

    public function index_tlofi(Ofi $ofi, $ref_page = '')
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $tlofi = TLOfi::where('id_ofi', '=', $ofi->id_ofi)->first();

        return view('ofi.tlofi.edit', ['ofi' => $ofi, 'tlofi' => $tlofi, 'usersAuditee' => $usersAuditee, 'ref_page' => $ref_page]);
    }

    public function store_tlofi(Request $request, Ofi $ofi, $ref_page = '')
    {
        if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Auditee')
        {
            $validatedDataOfi = $request->validate([
                'bukti' => 'mimes:pdf',
            ]);

            if ($request->file('bukti'))
            {
                $validatedDataOfi['bukti'] = $request->file('bukti')->store('bukti-ofi');
            }

            if (auth()->user()->role == 'Admin')
            {
                $validatedDataOfi['no_ofi'] = $request->no_ofi;
                $validatedDataOfi['proses_audit'] = $request->proses_audit;
                $validatedDataOfi['tema_audit'] = $request->tema_audit;
                $validatedDataOfi['jenis_temuan'] = $request->jenis_temuan;
                $validatedDataOfi['tgl_terbitofi'] = $request->tgl_terbitofi;
                $validatedDataOfi['status'] = $request->status;

                $validatedDataOfi['asal_dept'] = $request->asal_dept;
                $validatedDataOfi['proyek'] = $request->proyek;
                $validatedDataOfi['usulan_ofi'] = $request->usulan_ofi;
                $validatedDataOfi['dept_ygmngrjkn'] = $request->dept_ygmngrjkn;
                $validatedDataOfi['uraian_permasalahan'] = $request->uraian_permasalahan;
                $validatedDataOfi['usulan_peningkatan'] = $request->usulan_peningkatan;
                $validatedDataOfi['dept_pengusul'] = $request->dept_pengusul;
                $validatedDataOfi['tgl_diusulkan'] = $request->tgl_diusulkan;
                $validatedDataOfi['disetujui_oleh'] = $request->disetujui_oleh;
                $validatedDataOfi['tgl_disetujui'] = $request->tgl_disetujui;
                $validatedDataOfi['disposisi'] = $request->disposisi;
                $validatedDataOfi['tgl_deadline'] = $request->tgl_deadline;
            }
            $validatedDataTLOfi = $request->validate([
                'tl_usulanofi' => '',
                'nama_pekerjatl' => '',
                'tgl_tl' => '',
            ]);

            $validatedDataTLOfi['id_ofi'] = $ofi->id_ofi;

            if (auth()->user()->role == 'Admin')
            {
                $validatedDataTLOfi['uraian_verif'] = $request->uraian_verif;
                $validatedDataTLOfi['hasil_verif'] = $request->hasil_verif;
                $validatedDataTLOfi['nama_verifikator'] = $request->nama_verifikator;
                $validatedDataTLOfi['tgl_verif'] = $request->tgl_verif;
                $validatedDataTLOfi['eval_saran'] = $request->eval_saran;
                $validatedDataTLOfi['nama_evaluator'] = $request->nama_evaluator;
                $validatedDataTLOfi['skor'] = $request->skor;
                $validatedDataTLOfi['rekom_tinjauan'] = $request->rekom_tinjauan;
                $validatedDataTLOfi['namasm_verifikator'] = $request->namasm_verifikator;
            }

            Ofi::where('id_ofi', '=', $ofi->id_ofi)->update($validatedDataOfi);
            TLOfi::updateOrCreate(['id_ofi' => $ofi->id_ofi], $validatedDataTLOfi);
        }

        if (auth()->user()->role == 'Auditor')
        {
            Ofi::where('id_ofi', '=', $ofi->id_ofi)->update(['status' => $request->status]);
        }

        return redirect((!empty($ref_page) ? $ref_page : 'data-ofi'));
    }

    public function view_tlofi(Ofi $ofi, $ref_page = '')
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $tlofi = TLOfi::where('id_ofi', '=', $ofi->id_ofi)->first();

        return view('ofi.tlofi.view', ['ofi' => $ofi, 'tlofi' => $tlofi, 'usersAuditee' => $usersAuditee, 'ref_page' => $ref_page]);
    }
}
