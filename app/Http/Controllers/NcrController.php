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
        if (auth()->user()->role == 'Auditee') {
            $ncr = Ncr::where('objek_audit', '=', auth()->user()->id)->get();
        }

        // if (auth()->user()->role == 'Tema') {
        //     $ncr = Ncr::where('tema_audit', '=', auth()->user()->id)->get();
        // }

        else {
            $ncr = Ncr::all();
        }

        return view('ncr.index', ['ncr' => $ncr]);
    }

    public function api_status_ncr()
    {
        if (auth()->user()->role == 'Auditee') {
            $ncr = DB::select(DB::raw("SELECT * FROM (SELECT SUM(CASE WHEN status = 'Sudah Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_sudah, SUM(CASE WHEN status = 'Belum Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_belum, SUM(CASE WHEN status = 'Tindak Lanjut Belum Sesuai' THEN 1 ELSE 0 END) AS jumlah_tidak FROM ncr WHERE objek_audit = '" . auth()->user()->id . "') AS aa"));
        } else {
            $ncr = DB::select(DB::raw("SELECT * FROM (SELECT SUM(CASE WHEN status = 'Sudah Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_sudah, SUM(CASE WHEN status = 'Belum Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_belum, SUM(CASE WHEN status = 'Tindak Lanjut Belum Sesuai' THEN 1 ELSE 0 END) AS jumlah_tidak FROM ncr) AS aa"));
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
        $usersTema = User::where('role', '=', 'Tema')->get();

        return view('ncr.add', ['usersAuditee' => $usersAuditee, 'usersTema' => $usersTema]);
    }

    public function store_add(Request $request)
    {
        $dataSent = $request->except('_token', 'bukti',  'ttd_auditee', 'ttd_auditee_gm_sm');

        $request->validate([
            // 'no_ncr' => 'required',
            'objek_audit' => 'required',
            'tema_audit' => 'required',
            'bukti' => 'mimes:pdf',
            'ttd_auditor' => 'mimes:jpeg,jpg,png',
            'ttd_auditee' => 'mimes:jpeg,jpg,png',
            'ttd_auditee_gm_sm' => 'mimes:jpeg,jpg,png',
        ]);

        $dataSent['tema_audit'] = $request->input('tema_audit');

        if ($request->file('bukti')) {
            $dataSent['bukti'] = $request->file('bukti')->store('bukti-ncr');
        }

        if ($request->file('ttd_auditor')) {
            $dataSent['ttd_auditor'] = $request->file('ttd_auditor')->store('ttd_auditor');
        }

        if ($request->file('ttd_auditee')) {
            $dataSent['ttd_auditee'] = $request->file('ttd_auditee')->store('ttd_auditee');
        }

        if ($request->file('ttd_auditee_gm_sm')) {
            $dataSent['ttd_auditee_gm_sm'] = $request->file('ttd_auditee_gm_sm')->store('ttd_auditee_gm_sm');
        }

        $create = Ncr::create($dataSent);

        return redirect('data-ncr/form/' . $create->id);
    }

    public function index_form_ncr(Ncr $ncr)
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $usersTema = User::where('role', '=', 'Tema')->get();

        // $year = date('y');
        // $theme = $ncr->users_tema->name;
        // $process = $ncr->proses_audit;
        // $lastNcr = Ncr::where('tema_audit', $theme)
        //     ->where('proses_audit', $process)
        //     // ->where('year', $year)
        //     ->orderBy('no_ncr', 'desc')
        //     ->first();

        // if ($lastNcr && substr($lastNcr->no_ncr, 0, 2) == $year) {
        //     $noUrut = str_pad((int)substr($lastNcr->no_ncr, -3) + 1, 3, '0', STR_PAD_LEFT);
        // } else {
        //     $noUrut = '001';
        // }


        // $noNcr = $year . '/' . $process . '/' . $theme . '/' . $noUrut;
        // // $noNcr = $noUrut . '/' . substr($process, 0, 3) . '/' . $theme . '/' .'NCR'.' / '. $year;
        // $ncr->no_ncr = $noNcr;

        // $year = date('y');
        // $theme = $ncr->users_tema->name;
        // $process = $ncr->proses_audit;
        // $lastNcr = Ncr::where('tema_audit', $theme)
        //     ->where('proses_audit', $process)
        //     ->orderBy('no_ncr', 'desc')->first();

        // if ($lastNcr && substr($lastNcr->no_ncr, -2) == $year && $lastNcr->tema_audit == $theme && $lastNcr->proses_audit == $process) {
        //     $noUrut = str_pad((int)substr($lastNcr->no_ncr, 0, 3) + 1, 3, '0', STR_PAD_LEFT);
        // } else {
        //     $noUrut = '001';
        // }

        // $noNcr = $noUrut . '/' . substr($process, 0, 3) . '/' . $theme . '/' . 'NCR' . '/' . $year;
        // $ncr->no_ncr = $noNcr;

        // $year = date('y');
        // $theme = $ncr->tema_audit;
        // $process = $ncr->proses_audit;
        // $lastNcr = Ncr::where('tema_audit', $theme)
        //     ->where('proses_audit', $process)
        //     ->whereRaw('YEAR(created_at) = ?', [date('Y')])
        //     ->orderBy('no_ncr', 'desc')
        //     ->first();

        // if ($lastNcr && substr($lastNcr->no_ncr, -2) == $year && $lastNcr->proses_audit == $process && $lastNcr->tema_audit == $theme) {
        //     $noUrut = str_pad((int)substr($lastNcr->no_ncr, 0, 3) + 1, 3, '0', STR_PAD_LEFT);
        // } else {
        //     $noUrut = '001';
        // }

        // $noNcr = $noUrut . '/' . substr($process, 0, 3) . '/' . $theme . '/' . 'NCR' . '/' . $year;
        // $ncr->no_ncr = $noNcr;

        // $year = date('y');
        // $theme = $ncr->tema_audit;
        // $themename = DB::table('users')->where('id', $theme)->value('name');
        // $process = strtoupper($ncr->proses_audit);
        // $lastNcr = Ncr::where('tema_audit', $theme)
        //     ->where('proses_audit', $process)
        //     ->whereRaw('YEAR(created_at) = ?', [date('Y')])
        //     ->orderBy('no_ncr', 'desc')
        //     ->first();

        // if ($lastNcr && substr($lastNcr->no_ncr, -2) == $year && $lastNcr->proses_audit == $process && $lastNcr->tema_audit == $theme) {
        //     $noUrut = str_pad((int)substr($lastNcr->no_ncr, 0, 3) + 1, 3, '0', STR_PAD_LEFT);
        // } else {
        //     $noUrut = '001';
        // }

        // $noNcr = $noUrut . '/' . substr($process, 0, 3) . '/' . $themename . '/' . 'NCR' . '/' . $year;
        // $ncr->no_ncr = $noNcr;

        $year = date('y');
        $themeId = $ncr->tema_audit;
        $theme = DB::table('users')->where('id', $themeId)->value('username');
        $process = $ncr->proses_audit;
        $lastNcr = Ncr::where('tema_audit', $themeId)
            ->where('proses_audit', $process)
            ->whereRaw('YEAR(created_at) = ?', [date('Y')])
            ->orderBy('no_ncr', 'desc')
            ->first();

        if ($lastNcr && substr($lastNcr->no_ncr, -2) == $year && $lastNcr->proses_audit == $process && $lastNcr->tema_audit == $themeId) {
            $noUrut = str_pad((int)substr($lastNcr->no_ncr, 0, 3) + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $noUrut = '001';
        }

        $noNcr = $noUrut . '/' . substr($process, 0, 3) . '/' . $theme . '/' . 'NCR' . '/' . $year;
        $ncr->no_ncr = $noNcr;

        return view('ncr.formncr.edit', ['ncr' => $ncr, 'usersAuditee' => $usersAuditee, 'usersTema' => $usersTema]);
    }

    public function store_form_ncr(Request $request, Ncr $ncr)
    {
        $dataSent = $request->except('_token', 'bukti', 'ttd_auditor', 'ttd_auditee', 'ttd_auditee_gm_sm');

        $request->validate([
            'bukti' => 'mimes:pdf',
            'ttd_auditor' => 'mimes:jpeg,jpg,png',
            'ttd_auditee' => 'mimes:jpeg,jpg,png',
            'ttd_auditee_gm_sm' => 'mimes:jpeg,jpg,png',
        ]);

        if ($request->file('bukti')) {
            $dataSent['bukti'] = $request->file('bukti')->store('bukti-ncr');
        }

        if ($request->file('ttd_auditor')) {
            $dataSent['ttd_auditor'] = $request->file('ttd_auditor')->store('ttd_auditor');
        }

        if ($request->file('ttd_auditee')) {
            $dataSent['ttd_auditee'] = $request->file('ttd_auditee')->store('ttd_auditee');
        }

        if ($request->file('ttd_auditee_gm_sm')) {
            $dataSent['ttd_auditee_gm_sm'] = $request->file('ttd_auditee_gm_sm')->store('ttd_auditee_gm_sm');
        }


        Ncr::where('id_ncr', '=', $ncr->id_ncr)->update($dataSent);

        return redirect('data-ncr');
    }

    public function index_edit(Ncr $ncr)
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $usersTema = User::where('role', '=', 'Tema')->get();
        $tlncr = TLNcr::where('id_ncr', '=', $ncr->id_ncr)->first();

        return view('ncr.edit', ['ncr' => $ncr, 'tlncr' => $tlncr, 'usersAuditee' => $usersAuditee, 'usersTema' => $usersTema]);
    }

    public function store_edit(Request $request, Ncr $ncr)
    {
        $dataSent = $request->except('_token', 'bukti', 'ttd_auditor', 'ttd_auditee', 'ttd_auditee_gm_sm');

        $request->validate([
            'bukti' => 'mimes:pdf',
            'ttd_auditor' => 'mimes:jpeg,jpg,png',
            'ttd_auditee' => 'mimes:jpeg,jpg,png',
            'ttd_auditee_gm_sm' => 'mimes:jpeg,jpg,png',
        ]);

        if ($request->file('bukti')) {
            $dataSent['bukti'] = $request->file('bukti')->store('bukti-ncr');
        }

        if ($request->file('ttd_auditor')) {
            $dataSent['ttd_auditor'] = $request->file('ttd_auditor')->store('ttd_auditor');
        }

        if ($request->file('ttd_auditee')) {
            $dataSent['ttd_auditee'] = $request->file('ttd_auditee')->store('ttd_auditee');
        }

        if ($request->file('ttd_auditee_gm_sm')) {
            $dataSent['ttd_auditee_gm_sm'] = $request->file('ttd_auditee_gm_sm')->store('ttd_auditee_gm_sm');
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
        $usersTema = User::where('role', '=', 'Tema')->get();
        $tlncr = TLNcr::where('id_ncr', '=', $ncr->id_ncr)->first();

        return view('ncr.tlncr.edit', ['ncr' => $ncr, 'tlncr' => $tlncr, 'usersAuditee' => $usersAuditee, 'usersTema' => $usersTema,  'ref_page' => $ref_page]);
    }

    public function store_tlncr(Request $request, Ncr $ncr, $ref_page = '')
    {
        if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Auditee') {
            $validatedDataNcr = $request->validate([
                'diakui_oleh' => '',
                'diakui_oleh_jabatan' => '',
                'disetujui_oleh1' => '',
                'disetujui_oleh1_jabatan' => '',
                'tgl_accgm1' => '',
                'tgl_planaction' => '',
                'status' => '',
                'bukti' => 'mimes:pdf',
                'ttd_auditor' => 'mimes:jpeg,jpg,png',
                'ttd_auditee' => 'mimes:jpeg,jpg,png',
                'ttd_auditee_gm_sm' => 'mimes:jpeg,jpg,png',
            ]);

            if ($request->file('bukti')) {
                $validatedDataNcr['bukti'] = $request->file('bukti')->store('bukti-ncr');
            }

            if ($request->file('ttd_auditor')) {
                $validatedDataNcr['ttd_auditor'] = $request->file('ttd_auditor')->store('ttd_auditor');
            }

            if ($request->file('ttd_auditee')) {
                $validatedDataNcr['ttd_auditee'] = $request->file('ttd_auditee')->store('ttd_auditee');
            }

            if ($request->file('ttd_auditee_gm_sm')) {
                $validatedDataNcr['ttd_auditee_gm_sm'] = $request->file('ttd_auditee_gm_sm')->store('ttd_auditee_gm_sm');
            }

            if (auth()->user()->role == 'Admin') {
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
                'disetujui_oleh2' => '',
                'disetujui_oleh2_jabatan' => '',
                'tgl_accgm2' => '',
                'ttd_tl_gm' => 'mimes:jpeg,jpg,png',
                'ttd_tl_verif_auditor' => 'mimes:jpeg,jpg,png',
                'ttd_tl_verif_adm' => 'mimes:jpeg,jpg,png',
            ]);

            if ($request->file('ttd_tl_gm')) {
                $validatedDataTLNcr['ttd_tl_gm'] = $request->file('ttd_tl_gm')->store('ttd_tl_gm');
            }

            if ($request->file('ttd_tl_verif_auditor')) {
                $validatedDataTLNcr['ttd_tl_verif_auditor'] = $request->file('ttd_tl_verif_auditor')->store('ttd_tl_verif_auditor');
            }

            if ($request->file('ttd_tl_verif_adm')) {
                $validatedDataTLNcr['ttd_tl_verif_adm'] = $request->file('ttd_tl_verif_adm')->store('ttd_tl_verif_adm');
            }

            $validatedDataTLNcr['id_ncr'] = $ncr->id_ncr;

            if (auth()->user()->role == 'Admin') {
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

        if (auth()->user()->role == 'Auditor') {
            $validatedDataTLNcr = $request->validate([
                'ttd_tl_verif_auditor' => 'mimes:jpeg,jpg,png',
            ]);

            if ($request->file('ttd_tl_verif_auditor')) {
                $validatedDataTLNcr['ttd_tl_verif_auditor'] = $request->file('ttd_tl_verif_auditor')->store('ttd_tl_verif_auditor');
            }

            $validatedDataTLNcr['uraian_verifikasi'] = $request->uraian_verifikasi;
            $validatedDataTLNcr['hasil_verif'] = $request->hasil_verif;
            $validatedDataTLNcr['verifikator'] = $request->verifikator;
            $validatedDataTLNcr['tgl_verif'] = $request->tgl_verif;
            $validatedDataTLNcr['id_ncr'] = $ncr->id_ncr;

            Ncr::where('id_ncr', '=', $ncr->id_ncr)->update([
                'status' => $request->status,
            ]);

            TLNcr::updateOrCreate(['id_ncr' => $ncr->id_ncr], $validatedDataTLNcr);
        }

        if (auth()->user()->role == 'Admin2') {
            $validatedDataTLNcr = $request->validate([
                'ttd_tl_verif_adm' => 'mimes:jpeg,jpg,png',
            ]);

            if ($request->file('ttd_tl_verif_adm')) {
                $validatedDataTLNcr['ttd_tl_verif_adm'] = $request->file('ttd_tl_verif_adm')->store('ttd_tl_verif_adm');
            }

            $validatedDataTLNcr['rekomendasi'] = $request->rekomendasi;
            $validatedDataTLNcr['namasm_verif'] = $request->namasm_verif;
            $validatedDataTLNcr['tgl_verif_adm2'] = $request->tgl_verif_adm2;

            $validatedDataTLNcr['id_ncr'] = $ncr->id_ncr;

            Ncr::where('id_ncr', '=', $ncr->id_ncr)->update([
                'status' => $request->status,
            ]);

            TLNcr::updateOrCreate(['id_ncr' => $ncr->id_ncr], $validatedDataTLNcr);
        }

        return redirect((!empty($ref_page) ? $ref_page : 'data-ncr'));
    }

    public function view_tlncr(Ncr $ncr, $ref_page = '')
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $usersTema = User::where('role', '=', 'Tema')->get();
        $tlncr = TLNcr::where('id_ncr', '=', $ncr->id_ncr)->first();

        return view('ncr.tlncr.view', ['ncr' => $ncr, 'tlncr' => $tlncr, 'usersAuditee' => $usersAuditee, 'usersTema' => $usersTema, 'ref_page' => $ref_page]);
    }

    public function print(Ncr $ncr)
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $usersTema = User::where('role', '=', 'Tema')->get();
        $tlncr = TLNcr::where('id_ncr', '=', $ncr->id_ncr)->first();
        $dompdf = Pdf::loadView('ncr.print', ['ncr' => $ncr, 'tlncr' => $tlncr, 'usersAuditee' => $usersAuditee,  'usersTema' => $usersTema]);
        $dompdf->add_info('Title', 'Cetak NCR');
        $dompdf->setPaper('A3');
        return $dompdf->stream('Cetak NCR.pdf', array("Attachment" => false));
    }

    public function excel()
    {
        if (auth()->user()->role == 'Auditee') {
            $ncr = Ncr::where('objek_audit', '=', auth()->user()->id)->get();
        }

        if (auth()->user()->role == 'Tema') {
            $ncr = Ncr::where('tema_audit', '=', auth()->user()->id)->get();
        } else {
            $ncr = Ncr::all();
        }

        return view('ncr.excel', ['ncr' => $ncr]);
    }
}
