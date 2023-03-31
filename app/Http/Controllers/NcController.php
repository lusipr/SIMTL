<?php

namespace App\Http\Controllers;

use App\Models\Nc;
use App\Models\TLNc;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NcController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'Auditee') {
            $nc = Nc::where('objek_audit', '=', auth()->user()->id)->get();
        }

        // if (auth()->user()->role == 'Tema')
        // {
        //     $nc = Nc::where('tema_audit', '=', auth()->user()->id)->get();
        // }
        else {
            $nc = Nc::all();
        }

        return view('nc.index', ['nc' => $nc]);
    }

    public function api_status_nc()
    {
        if (auth()->user()->role == 'Auditee') {
            $nc = DB::select(DB::raw("SELECT * FROM (SELECT SUM(CASE WHEN status = 'Sudah Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_sudah, SUM(CASE WHEN status = 'Belum Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_belum, SUM(CASE WHEN status = 'Tindak Lanjut Belum Sesuai' THEN 1 ELSE 0 END) AS jumlah_tidak FROM nc WHERE objek_audit = '" . auth()->user()->id . "') AS aa"));
        } else {
            $nc = DB::select(DB::raw("SELECT * FROM (SELECT SUM(CASE WHEN status = 'Sudah Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_sudah, SUM(CASE WHEN status = 'Belum Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_belum, SUM(CASE WHEN status = 'Tindak Lanjut Belum Sesuai' THEN 1 ELSE 0 END) AS jumlah_tidak FROM nc) AS aa"));
        }
        // $nc = Nc::selectRaw('COUNT(id_nc) AS jumlah, status AS name')
        //     ->where('status', '=', 'Sudah Ditindaklanjuti')
        //     ->orWhere('status', '=', 'Belum Ditindaklanjuti')
        //     ->groupBy('status')
        //     ->get();

        return json_encode($nc);
    }

    public function index_add()
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $usersTema = User::where('role', '=', 'Tema')->get();
        $nc = new Nc;
        $nc->no_nc = Nc::generateCode();

        return view('nc.add', ['usersAuditee' => $usersAuditee, 'usersTema' => $usersTema], compact('nc'));
    }

    public function store_add(Request $request)
    {
        $dataSent = $request->except('_token', 'bukti', 'ttd_auditor_nc');

        $request->validate([
            'opsi_temuan' => 'required',
            'no_nc' => 'required',
            'objek_audit' => 'required',
            'bukti' => 'mimes:pdf',
            'ttd_auditor_nc' => 'mimes:jpeg,jpg,png',
        ]);

        if ($request->file('bukti')) {
            $dataSent['bukti'] = $request->file('bukti')->store('bukti-nc');
        }

        if ($request->file('ttd_auditor_nc')) {
            $dataSent['ttd_auditor_nc'] = $request->file('ttd_auditor_nc')->store('ttd_auditor_nc');
        }

        $create = Nc::create($dataSent);

        return redirect('data-nc/form/' . $create->id);
    }

    public function index_form_nc(Nc $nc)
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $usersTema = User::where('role', '=', 'Tema')->get();

        return view('nc.formnc.edit', ['nc' => $nc, 'usersAuditee' => $usersAuditee, 'usersTema' => $usersTema]);
    }

    public function store_form_nc(Request $request, Nc $nc)
    {
        // $validatedData = $request->validate([
        //     'bab_audit' => ''
        // ]);

        $request->validate([
            'bukti' => 'mimes:pdf',
            'ttd_auditor_nc' => 'mimes:jpeg,jpg,png',
            'ttd_diakui_oleh_nc' => 'mimes:jpeg,jpg,png',
            'ttd_disetujui_oleh_nc' => 'mimes:jpeg,jpg,png',
        ]);

        if ($request->file('bukti')) {
            $dataSent['bukti'] = $request->file('bukti')->store('bukti-nc');
        }

        if ($request->file('ttd_auditor_nc')) {
            $dataSent['ttd_auditor_nc'] = $request->file('ttd_auditor_nc')->store('ttd_auditor_nc');
        }

        if ($request->file('ttd_diakui oleh_nc')) {
            $dataSent['ttd_diakui oleh_nc'] = $request->file('ttd_diakui oleh_nc')->store('ttd_diakui oleh_nc');
        }

        if ($request->file('ttd_disetujui oleh_nc')) {
            $dataSent['ttd_disetujui oleh_nc'] = $request->file('ttd_disetujui oleh_nc')->store('ttd_disetujui oleh_nc');
        }

        Nc::where('id_nc', '=', $nc->id_nc)->update($dataSent);

        return redirect('data-nc');
    }

    public function index_edit(Nc $nc)
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $usersTema = User::where('role', '=', 'Tema')->get();
        $tlnc = TLNc::where('id_nc', '=', $nc->id_nc)->first();

        return view('nc.edit', ['nc' => $nc, 'tlnc' => $tlnc, 'usersAuditee' => $usersAuditee, 'usersTema' => $usersTema]);
    }

    public function store_edit(Request $request, Nc $nc)
    {
        $dataSent = $request->except('_token', 'bukti');

        $request->validate([
            'bukti' => 'mimes:pdf',
            // 'ttd_auditor_nc' => 'mimes:jpeg,jpg,png',
            // 'ttd_diakui_oleh_nc' => 'mimes:jpeg,jpg,png',
            // 'ttd_disetujui_oleh_nc' => 'mimes:jpeg,jpg,png',
        ]);

        if ($request->file('bukti')) {
            $dataSent['bukti'] = $request->file('bukti')->store('bukti-nc');
        }

        // if ($request->file('ttd_auditor_nc')) {
        //     $dataSent['ttd_auditor_nc'] = $request->file('ttd_auditor_nc')->store('ttd_auditor_nc');
        // }

        // if ($request->file('ttd_diakui oleh_nc')) {
        //     $dataSent['ttd_diakui oleh_nc'] = $request->file('ttd_diakui oleh_nc')->store('ttd_diakui oleh_nc');
        // }

        // if ($request->file('ttd_disetujui oleh_nc')) {
        //     $dataSent['ttd_disetujui oleh_nc'] = $request->file('ttd_disetujui oleh_nc')->store('ttd_disetujui oleh_nc');
        // }

        Nc::where('id_nc', '=', $nc->id_nc)->update($dataSent);

        return redirect('data-nc');
    }

    public function delete(Nc $nc, $ref_page = '')
    {
        Nc::where('id_nc', '=', $nc->id_nc)->delete();
        TLNc::where('id_nc', '=', $nc->id_nc)->delete();

        return redirect((!empty($ref_page) ? $ref_page : 'data-nc'))->with('swal_msg', 'Hapus Data Berhasil');
    }

    public function index_tlnc(Nc $nc, $ref_page = '')
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $usersTema = User::where('role', '=', 'Tema')->get();
        $tlnc = TLNc::where('id_nc', '=', $nc->id_nc)->first();

        return view('nc.tlnc.edit', ['nc' => $nc, 'tlnc' => $tlnc, 'usersAuditee' => $usersAuditee, 'usersTema' => $usersTema, 'ref_page' => $ref_page]);
    }

    public function store_tlnc(Request $request, Nc $nc, $ref_page = '')
    {
        if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Auditee') {
            $validatedDataNc = $request->validate([
                'diakui_oleh' => '',
                'disetujui_oleh' => '',
                'tgl_accgm' => '',
                'bukti' => 'mimes:pdf',
            ]);

            if ($request->file('bukti')) {
                $validatedDataNc['bukti'] = $request->file('bukti')->store('bukti-nc');
            }

            if (auth()->user()->role == 'Admin') {
                $validatedDataNc['opsi_temuan'] = $request->opsi_temuan;
                $validatedDataNc['no_nc'] = $request->no_nc;
                $validatedDataNc['proses_audit'] = $request->proses_audit;
                $validatedDataNc['tema_audit'] = $request->tema_audit;
                $validatedDataNc['jenis_temuan'] = $request->jenis_temuan;
                $validatedDataNc['tgl_terbitnc'] = $request->tgl_terbitnc;
                $validatedDataNc['status'] = $request->status;

                $validatedDataNc['bab_audit'] = $request->bab_audit;
                $validatedDataNc['dok_acuan'] = $request->dok_acuan;
                $validatedDataNc['uraian_nc'] = $request->uraian_nc;
                $validatedDataNc['kategori'] = $request->kategori;
                $validatedDataNc['nama_auditor'] = $request->nama_auditor;
                $validatedDataNc['tgl_deadline'] = $request->tgl_deadline;
            }

            $validatedDataTLNc = $request->validate([
                'akar_masalah' => '',
                'uraian_perbaikan' => '',
                'uraian_pencegahan' => '',
                'tgl_action' => '',
                'disetujui_oleh' => '',
                'tgl_accgm' => '',
            ]);

            $validatedDataTLNc['id_nc'] = $nc->id_nc;

            if (auth()->user()->role == 'Admin') {
                $validatedDataTLNc['uraian_verifikasi'] = $request->uraian_verifikasi;
                $validatedDataTLNc['hasil_verif'] = $request->hasil_verif;
                $validatedDataTLNc['verifikator'] = $request->verifikator;
                $validatedDataTLNc['tgl_verif'] = $request->tgl_verif;
                $validatedDataTLNc['rekomendasi'] = $request->rekomendasi;
                $validatedDataTLNc['namasm_verif'] = $request->namasm_verif;
            }

            Nc::where('id_nc', '=', $nc->id_nc)->update($validatedDataNc);
            TLNc::updateOrCreate(['id_nc' => $nc->id_nc], $validatedDataTLNc);
        }

        if (auth()->user()->role == 'Auditor') {
            Nc::where('id_nc', '=', $nc->id_nc)->update([
                'status' => $request->status,
                'tgl_planaction' => $request->tgl_planaction,
            ]);

            TLNc::updateOrCreate(['id_nc' => $nc->id_nc], [
                'uraian_verifikasi' => $request->uraian_verifikasi,
                'hasil_verif' => $request->hasil_verif,
                'verifikator' => $request->verifikator,
                'tgl_verif' => $request->tgl_verif,
                'rekomendasi' => $request->rekomendasi,
                'namasm_verif' => $request->namasm_verif,
            ]);
        }

        return redirect((!empty($ref_page) ? $ref_page : 'data-nc'));
    }

    public function view_tlnc(Nc $nc, $ref_page = '')
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $tlnc = TLNc::where('id_nc', '=', $nc->id_nc)->first();

        return view('nc.tlnc.view', ['nc' => $nc, 'tlnc' => $tlnc, 'usersAuditee' => $usersAuditee, 'ref_page' => $ref_page]);
    }

    public function print(Nc $nc)
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $tlnc = TLNc::where('id_nc', '=', $nc->id_nc)->first();
        $usersTema = User::where('role', '=', 'Tema')->get();
        $dompdf = Pdf::loadView('nc.print', ['nc' => $nc, 'tlnc' => $tlnc, 'usersAuditee' => $usersAuditee, 'usersTema' => $usersTema]);
        $dompdf->add_info('Title', 'Cetak NCR');
        $dompdf->setPaper('A3');
        return $dompdf->stream('Cetak NCR.pdf', array("Attachment" => false));
    }

    public function excel()
    {
        if (auth()->user()->role == 'Auditee') {
            $nc = Nc::where('objek_audit', '=', auth()->user()->id)->get();
        }

        if (auth()->user()->role == 'Tema') {
            $nc = Nc::where('tema_audit', '=', auth()->user()->id)->get();
        } else {
            $nc = Nc::all();
        }

        return view('nc.excel', ['nc' => $nc]);
    }
}