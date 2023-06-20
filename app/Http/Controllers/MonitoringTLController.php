<?php

namespace App\Http\Controllers;

use App\Models\Nc;
use App\Models\Ncr;
use App\Models\Ofi;
use Illuminate\Http\Request;

class MonitoringTLController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'Auditee') {
            // $nc = Nc::selectRaw("'nc' AS type, nc.id_nc AS id, nc.jenis_temuan, nc.no_nc AS no_dokumen, nc.proses_audit, nc.tema_audit, nc.objek_audit, nc.dokumen, nc.tgl_terbitnc AS tgl_terbit, nc.status, nc.bukti, nc.tgl_deadline, tlnc.tgl_action AS tgl_mulai, tlnc.tgl_verif")
            //     ->join('tlnc', 'nc.id_nc', '=', 'tlnc.id_nc')
            //     ->where('nc.objek_audit', '=', auth()->user()->id);
            $ncr = Ncr::selectRaw("'ncr' AS type, ncr.id_ncr AS id, ncr.jenis_temuan, ncr.no_ncr AS no_dokumen, ncr.proses_audit, ncr.tema_audit, ncr.objek_audit, ncr.dokumen, ncr.tgl_terbitncr AS tgl_terbit, ncr.status, ncr.bukti, ncr.tgl_deadline, tlncr.tgl_action AS tgl_mulai, tlncr.tgl_verif")
                ->join('tlncr', 'ncr.id_ncr', '=', 'tlncr.id_ncr')
                ->where('ncr.objek_audit', '=', auth()->user()->id);
            $ofi = Ofi::selectRaw("'ofi' AS type, ofi.id_ofi AS id, ofi.jenis_temuan, ofi.no_ofi AS no_dokumen, ofi.proses_audit, ofi.tema_audit, ofi.objek_audit, ofi.dokumen, ofi.tgl_terbitofi AS tgl_terbit, ofi.status, ofi.bukti, ofi.tgl_deadline, tlofi.tgl_tl AS tgl_mulai, tlofi.tgl_verif")
                ->join('tlofi', 'ofi.id_ofi', '=', 'tlofi.id_ofi')
                ->where('ofi.objek_audit', '=', auth()->user()->id)
                // ->unionAll($nc)
                ->unionAll($ncr)
                ->get();
        } else {
            // $nc = Nc::selectRaw("'nc' AS type, nc.id_nc AS id, nc.jenis_temuan, nc.no_nc AS no_dokumen, nc.proses_audit, nc.tema_audit, nc.objek_audit, nc.dokumen, nc.tgl_terbitnc AS tgl_terbit, nc.status, nc.bukti, nc.tgl_deadline, tlnc.tgl_action AS tgl_mulai, tlnc.tgl_verif")
            //     ->join('tlnc', 'nc.id_nc', '=', 'tlnc.id_nc')
            //     ->whereNotNull('objek_audit');
            $ncr = Ncr::selectRaw("'ncr' AS type, ncr.id_ncr AS id, ncr.jenis_temuan, ncr.no_ncr AS no_dokumen, ncr.proses_audit, ncr.tema_audit, ncr.objek_audit, ncr.dokumen, ncr.tgl_terbitncr AS tgl_terbit, ncr.status, ncr.bukti, ncr.tgl_deadline, tlncr.tgl_action AS tgl_mulai, tlncr.tgl_verif")
                ->join('tlncr', 'ncr.id_ncr', '=', 'tlncr.id_ncr')
                ->whereNotNull('objek_audit');
            $ofi = Ofi::selectRaw("'ofi' AS type, ofi.id_ofi AS id, ofi.jenis_temuan, ofi.no_ofi AS no_dokumen, ofi.proses_audit, ofi.tema_audit, ofi.objek_audit, ofi.dokumen, ofi.tgl_terbitofi AS tgl_terbit, ofi.status, ofi.bukti, ofi.tgl_deadline, tlofi.tgl_tl AS tgl_mulai, tlofi.tgl_verif")
                ->join('tlofi', 'ofi.id_ofi', '=', 'tlofi.id_ofi')
                ->whereNotNull('objek_audit')
                // ->unionAll($nc)
                ->unionAll($ncr)
                ->get();
        }

        return view('monitoring-tl.index', ['monitoringtl' => $ofi]);
    }

    public function excel()
    {
        if (auth()->user()->role == 'Auditee') {
            // $nc = Nc::selectRaw("'nc' AS type, nc.id_nc AS id, nc.jenis_temuan, nc.no_nc AS no_dokumen, nc.proses_audit, nc.tema_audit, nc.objek_audit, nc.dokumen, nc.tgl_terbitnc AS tgl_terbit, nc.status, nc.bukti, nc.tgl_deadline, tlnc.tgl_action AS tgl_mulai, tlnc.tgl_verif")
            //     ->join('tlnc', 'nc.id_nc', '=', 'tlnc.id_nc')
            //     ->where('nc.objek_audit', '=', auth()->user()->id);
            $ncr = Ncr::selectRaw("'ncr' AS type, ncr.id_ncr AS id, ncr.jenis_temuan, ncr.no_ncr AS no_dokumen, ncr.proses_audit, ncr.tema_audit, ncr.objek_audit, ncr.dokumen, ncr.tgl_terbitncr AS tgl_terbit, ncr.status, ncr.bukti, ncr.tgl_deadline, tlncr.tgl_action AS tgl_mulai, tlncr.tgl_verif")
                ->join('tlncr', 'ncr.id_ncr', '=', 'tlncr.id_ncr')
                ->where('ncr.objek_audit', '=', auth()->user()->id);
            $ofi = Ofi::selectRaw("'ofi' AS type, ofi.id_ofi AS id, ofi.jenis_temuan, ofi.no_ofi AS no_dokumen, ofi.proses_audit, ofi.tema_audit, ofi.objek_audit, ofi.dokumen, ofi.tgl_terbitofi AS tgl_terbit, ofi.status, ofi.bukti, ofi.tgl_deadline, tlofi.tgl_tl AS tgl_mulai, tlofi.tgl_verif")
                ->join('tlofi', 'ofi.id_ofi', '=', 'tlofi.id_ofi')
                ->where('ofi.objek_audit', '=', auth()->user()->id)
                // ->unionAll($nc)
                ->unionAll($ncr)
                ->get();
        } else {
            // $nc = Nc::selectRaw("'nc' AS type, nc.id_nc AS id, nc.jenis_temuan, nc.no_nc AS no_dokumen, nc.proses_audit, nc.tema_audit, nc.objek_audit, nc.dokumen, nc.tgl_terbitnc AS tgl_terbit, nc.status, nc.bukti, nc.tgl_deadline, tlnc.tgl_action AS tgl_mulai, tlnc.tgl_verif")
            //     ->join('tlnc', 'nc.id_nc', '=', 'tlnc.id_nc')
            //     ->whereNotNull('objek_audit');
            $ncr = Ncr::selectRaw("'ncr' AS type, ncr.id_ncr AS id, ncr.jenis_temuan, ncr.no_ncr AS no_dokumen, ncr.proses_audit, ncr.tema_audit, ncr.objek_audit, ncr.dokumen, ncr.tgl_terbitncr AS tgl_terbit, ncr.status, ncr.bukti, ncr.tgl_deadline, tlncr.tgl_action AS tgl_mulai, tlncr.tgl_verif")
                ->join('tlncr', 'ncr.id_ncr', '=', 'tlncr.id_ncr')
                ->whereNotNull('objek_audit');
            $ofi = Ofi::selectRaw("'ofi' AS type, ofi.id_ofi AS id, ofi.jenis_temuan, ofi.no_ofi AS no_dokumen, ofi.proses_audit, ofi.tema_audit, ofi.objek_audit, ofi.dokumen, ofi.tgl_terbitofi AS tgl_terbit, ofi.status, ofi.bukti, ofi.tgl_deadline, tlofi.tgl_tl AS tgl_mulai, tlofi.tgl_verif")
                ->join('tlofi', 'ofi.id_ofi', '=', 'tlofi.id_ofi')
                ->whereNotNull('objek_audit')
                // ->unionAll($nc)
                ->unionAll($ncr)
                ->get();
        }

        return view('monitoring-tl.excel', ['monitoringtl' => $ofi]);
    }
}
