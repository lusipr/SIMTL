<?php

namespace App\Http\Controllers;

use App\Models\Ofi;
use App\Models\TLOfi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfiController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'Auditee') {
            $ofi = Ofi::where('objek_audit', '=', auth()->user()->id)->get();
        }

        // if (auth()->user()->role == 'Tema') {
        //     $ofi = Ofi::where('tema_audit', '=', auth()->user()->id)->get();
        // } 
        
        else {
            $ofi = Ofi::all();
        }

        return view('ofi.index', ['ofi' => $ofi]);
    }

    public function api_status_ofi()
    {
        if (auth()->user()->role == 'Auditee') {
            $ofi = DB::select(DB::raw("SELECT * FROM (SELECT SUM(CASE WHEN status = 'Sudah Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_sudah, SUM(CASE WHEN status = 'Belum Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_belum, SUM(CASE WHEN status = 'Tindak Lanjut Belum Sesuai' THEN 1 ELSE 0 END) AS jumlah_tidak FROM ofi WHERE objek_audit = '" . auth()->user()->id . "') AS aa"));
        } else {
            $ofi = DB::select(DB::raw("SELECT * FROM (SELECT SUM(CASE WHEN status = 'Sudah Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_sudah, SUM(CASE WHEN status = 'Belum Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_belum, SUM(CASE WHEN status = 'Tindak Lanjut Belum Sesuai' THEN 1 ELSE 0 END) AS jumlah_tidak FROM ofi) AS aa"));
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
        $usersTema = User::where('role', '=', 'Tema')->get();
        $ofi = new Ofi;
        $ofi->no_ofi = Ofi::generateCode();

        return view('ofi.add', ['usersAuditee' => $usersAuditee, 'usersTema' => $usersTema], compact('ofi'));
    }

    public function store_add(Request $request)
    {
        $dataSent = $request->except('_token', 'bukti', 'ttd_dept_pengusul', 'ttd_disetujui_oleh_ofi', 'ttd_disposisi');

        $request->validate([
            'no_ofi' => 'required',
            'objek_audit' => 'required',
            'bukti' => 'mimes:pdf',
            'ttd_dept_pengusul' => 'mimes:jpeg,jpg,png',
            'ttd_disetujui_oleh_ofi' => 'mimes:jpeg,jpg,png',
            'ttd_disposisi' => 'mimes:jpeg,jpg,png',
        ]);

        if ($request->file('bukti')) {
            $dataSent['bukti'] = $request->file('bukti')->store('bukti-ofi');
        }

        if ($request->file('ttd_dept_pengusul')) {
            $dataSent['ttd_dept_pengusul'] = $request->file('ttd_dept_pengusul')->store('ttd_dept_pengusul');
        }

        if ($request->file('ttd_disetujui_oleh_ofi')) {
            $dataSent['ttd_disetujui_oleh_ofi'] = $request->file('ttd_disetujui_oleh_ofi')->store('ttd_disetujui_oleh_ofi');
        }

        if ($request->file('ttd_disposisi')) {
            $dataSent['ttd_disposisi'] = $request->file('ttd_disposisi')->store('ttd_disposisi');
        }

        $create = Ofi::create($dataSent);

        return redirect('data-ofi/form/' . $create->id);
    }

    public function index_form_ofi(Ofi $ofi)
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $usersTema = User::where('role', '=', 'Tema')->get();

        return view('ofi.formofi.edit', ['ofi' => $ofi, 'usersAuditee' => $usersAuditee, 'usersTema' => $usersTema]);
    }

    public function store_form_ofi(Request $request, Ofi $ofi)
    {
        // $validatedData = $request->validate([
        //     'bab_audit' => ''
        // ]);
        $dataSent = $request->except('_token', 'bukti', 'ttd_dept_pengusul', 'ttd_disetujui_oleh_ofi', 'ttd_disposisi');

        $request->validate([
            'bukti' => 'mimes:pdf',
            'ttd_dept_pengusul' => 'mimes:jpeg,jpg,png',
            'ttd_disetujui_oleh_ofi' => 'mimes:jpeg,jpg,png',
            'ttd_auditee_gm_sm' => 'mimes:jpeg,jpg,png',
        ]);

        if ($request->file('bukti')) {
            $dataSent['bukti'] = $request->file('bukti')->store('bukti-ncr');
        }

        if ($request->file('ttd_dept_pengusul')) {
            $dataSent['ttd_dept_pengusul'] = $request->file('ttd_dept_pengusul')->store('ttd_dept_pengusul');
        }

        if ($request->file('ttd_disetujui_oleh_ofi')) {
            $dataSent['ttd_disetujui_oleh_ofi'] = $request->file('ttd_disetujui_oleh_ofi')->store('ttd_disetujui_oleh_ofi');
        }

        if ($request->file('ttd_disposisi')) {
            $dataSent['ttd_disposisi'] = $request->file('ttd_disposisi')->store('ttd_disposisi');
        }

        Ofi::where('id_ofi', '=', $ofi->id_ofi)->update($dataSent);

        return redirect('data-ofi');
    }

    public function index_edit(Ofi $ofi)
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $usersTema = User::where('role', '=', 'Tema')->get();
        $tlofi = TLOfi::where('id_ofi', '=', $ofi->id_ofi)->first();

        return view('ofi.edit', ['ofi' => $ofi, 'tlofi' => $tlofi, 'usersAuditee' => $usersAuditee, 'usersTema' => $usersTema]);
    }

    public function store_edit(Request $request, Ofi $ofi)
    {
        $dataSent = $request->except('_token', 'bukti', 'ttd_dept_pengusul', 'ttd_disetujui_oleh_ofi', 'ttd_disposisi');

        $request->validate([
            'bukti' => 'mimes:pdf',
            'ttd_dept_pengusul' => 'mimes:jpeg,jpg,png',
            'ttd_disetujui_oleh_ofi' => 'mimes:jpeg,jpg,png',
            'ttd_auditee_gm_sm' => 'mimes:jpeg,jpg,png',
        ]);

        if ($request->file('bukti')) {
            $dataSent['bukti'] = $request->file('bukti')->store('bukti-ncr');
        }

        if ($request->file('ttd_dept_pengusul')) {
            $dataSent['ttd_dept_pengusul'] = $request->file('ttd_dept_pengusul')->store('ttd_dept_pengusul');
        }

        if ($request->file('ttd_disetujui_oleh_ofi')) {
            $dataSent['ttd_disetujui_oleh_ofi'] = $request->file('ttd_disetujui_oleh_ofi')->store('ttd_disetujui_oleh_ofi');
        }

        if ($request->file('ttd_disposisi')) {
            $dataSent['ttd_disposisi'] = $request->file('ttd_disposisi')->store('ttd_disposisi');
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
        $usersTema = User::where('role', '=', 'Tema')->get();
        $tlofi = TLOfi::where('id_ofi', '=', $ofi->id_ofi)->first();

        return view('ofi.tlofi.edit', ['ofi' => $ofi, 'tlofi' => $tlofi, 'usersAuditee' => $usersAuditee, 'usersTema' => $usersTema, 'ref_page' => $ref_page]);
    }

    public function store_tlofi(Request $request, Ofi $ofi, $ref_page = '')
    {
        if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Auditee') {
            $validatedDataOfi = $request->validate([
                'bukti' => 'mimes:pdf',
                'lampiran1' => '',
                'lampiran2' => '',
                'lampiran3' => '',
                'lampiran4' => '',
                'lampiran5' => '',
                'lampiran6' => '',
                'ttd_dept_pengusul' => 'mimes:jpeg,jpg,png',
                'ttd_disetujui_oleh_ofi' => 'mimes:jpeg,jpg,png',
                'ttd_disposisi' => 'mimes:jpeg,jpg,png',
            ]);

            if ($request->file('bukti')) {
                $validatedDataOfi['bukti'] = $request->file('bukti')->store('bukti-ofi');
            }

            if ($request->file('ttd_dept_pengusul')) {
                $validatedDataOfi['ttd_dept_pengusul'] = $request->file('ttd_dept_pengusul')->store('ttd_dept_pengusul');
            }

            if ($request->file('ttd_disetujui_oleh_ofi')) {
                $validatedDataOfi['ttd_disetujui_oleh_ofi'] = $request->file('ttd_disetujui_oleh_ofi')->store('ttd_disetujui_oleh_ofi');
            }

            if ($request->file('ttd_disposisi')) {
                $validatedDataOfi['ttd_disposisi'] = $request->file('ttd_disposisi')->store('ttd_disposisi');
            }

            if (auth()->user()->role == 'Admin') {
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
                $validatedDataOfi['disposisi_diselesaikan_oleh'] = $request->disposisi_diselesaikan_oleh;
                $validatedDataOfi['tgl_deadline'] = $request->tgl_deadline;
            }
            $validatedDataTLOfi = $request->validate([
                'tl_usulanofi' => '',
                'nama_pekerjatl' => '',
                'tgl_tl' => '',
                'ttd_tlofi_oleh' => 'mimes:jpeg,jpg,png',
                'ttd_tlofi_verif' => 'mimes:jpeg,jpg,png',
            ]);

            if ($request->file('ttd_tlofi_oleh')) {
                $validatedDataTLOfi['ttd_tlofi_oleh'] = $request->file('ttd_tlofi_oleh')->store('ttd_tlofi_oleh');
            }

            if ($request->file('ttd_tlofi_verif')) {
                $validatedDataTLOfi['ttd_tlofi_verif'] = $request->file('ttd_tlofi_verif')->store('ttd_tlofi_verif');
            }

            $validatedDataTLOfi['id_ofi'] = $ofi->id_ofi;

            if (auth()->user()->role == 'Admin') {
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

        if (auth()->user()->role == 'Auditor') {
            Ofi::where('id_ofi', '=', $ofi->id_ofi)->update([
                'status' => $request->status
            ]);

            TLOfi::updateOrCreate(['id_ofi' => $ofi->id_ofi], [
                'uraian_verif' => $request->uraian_verif,
                'hasil_verif' => $request->hasil_verif,
                'nama_verifikator' => $request->nama_verifikator,
                'tgl_verif' => $request->tgl_verif,
                'eval_saran' => $request->eval_saran,
                'nama_evaluator' => $request->nama_evaluator,
                'skor' => $request->skor,
                'rekom_tinjauan' => $request->rekom_tinjauan,
                'namasm_verifikator' => $request->namasm_verifikator,
            ]);
        }


        if (auth()->user()->role == 'Admin2') {
            $validatedDataOfi = $request->validate([
                'ttd_disposisi' => 'mimes:jpeg,jpg,png',
            ]);

            if ($request->file('ttd_disposisi')) {
                $validatedDataOfi['ttd_disposisi'] = $request->file('ttd_disposisi')->store('ttd_disposisi');
            }

            $validatedDataOfi['status'] = $request->status;
            $validatedDataOfi['disposisi'] = $request->disposisi;
            $validatedDataOfi['disposisi_diselesaikan_oleh'] = $request->disposisi_diselesaikan_oleh;
            $validatedDataOfi['tgl_deadline'] = $request->tgl_deadline;

            $validatedDataTLOfi = $request->validate([
                'ttd_tlofi_verif' => 'mimes:jpeg,jpg,png',
            ]);

            if ($request->file('ttd_tlofi_verif')) {
                $validatedDataTLOfi['ttd_tlofi_verif'] = $request->file('ttd_tlofi_verif')->store('ttd_tlofi_verif');
            }

            $validatedDataTLOfi['uraian_verif'] = $request->uraian_verif;
            $validatedDataTLOfi['hasil_verif'] = $request->hasil_verif;
            $validatedDataTLOfi['nama_verifikator'] = $request->nama_verifikator;
            $validatedDataTLOfi['tgl_verif'] = $request->tgl_verif;

            Ofi::where('id_ofi', '=', $ofi->id_ofi)->update($validatedDataOfi);

            TLOfi::updateOrCreate(['id_ofi' => $ofi->id_ofi], $validatedDataTLOfi);
        }

        return redirect((!empty($ref_page) ? $ref_page : 'data-ofi'));
    }

    public function view_tlofi(Ofi $ofi, $ref_page = '')
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $usersTema = User::where('role', '=', 'Tema')->get();
        $tlofi = TLOfi::where('id_ofi', '=', $ofi->id_ofi)->first();

        return view('ofi.tlofi.view', ['ofi' => $ofi, 'tlofi' => $tlofi, 'usersAuditee' => $usersAuditee, 'usersTema' => $usersTema, 'ref_page' => $ref_page]);
    }

    public function print(Ofi $ofi)
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $usersTema = User::where('role', '=', 'Tema')->get();
        $tlofi = TLOfi::where('id_ofi', '=', $ofi->id_ofi)->first();
        $dompdf = Pdf::loadView('ofi.print', ['ofi' => $ofi, 'tlofi' => $tlofi, 'usersAuditee' => $usersAuditee,  'usersTema' => $usersTema]);
        $dompdf->add_info('Title', 'Cetak NCR');
        $dompdf->setPaper('A3');
        return $dompdf->stream('Cetak NCR.pdf', array("Attachment" => false));
    }

    public function excel()
    {
        if (auth()->user()->role == 'Auditee') {
            $ofi = Ofi::where('objek_audit', '=', auth()->user()->id)->get();
        }
        if (auth()->user()->role == 'Tema') {
            $ofi = Ofi::where('tema_audit', '=', auth()->user()->id)->get();
        } else {
            $ofi = Ofi::all();
        }

        return view('ofi.excel', ['ofi' => $ofi]);
    }
}
