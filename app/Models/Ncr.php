<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ncr extends Model
{
    use HasFactory;

    protected $table = "ncr";

    protected $fillable = [
        'id_ncr',
        'no_ncr',
        'proses_audit',
        'tema_audit',
        'objek_audit',
        'jenis_temuan',
        'dokumen',
        'tgl_terbitncr',
        'status',
        'bukti',
        'bab_audit',
        'dok_acuan',
        'uraian_ncr',
        'kategori',
        'ttd_auditor',
        'nama_auditor',
        'tgl_deadline',
        'ttd_auditee',
        'diakui_oleh',
        'diakui_oleh_jabatan',
        'ttd_auditee_gm_sm',
        'disetujui_oleh1',
        'disetujui_oleh1_jabatan',
        'tgl_accgm1',
        'tgl_planaction',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'objek_audit', 'id');
    }

    public function users_tema()
    {
        return $this->belongsTo(User::class, 'tema_audit', 'id');
    }

    public function tlncr()
    {
        return $this->hasOne(TLNcr::class, 'id_ncr', 'id_ncr');
    }

    public static function generateCode()
    {
        $tahun = date('y');
        $period = sprintf("%02d", ceil(date('n') / 6));
        $lastCode = self::where('no_ncr', 'like', "{$tahun}/{$period}/%")->orderBy('no_ncr', 'desc')->first();
        if (!$lastCode) {
            $noUrut = 1;
        } else {
            $noUrut = (int) substr($lastCode->no_ncr, -3) + 1;
            if (substr($lastCode->no_ncr, 0, 2) != $tahun) {
                $noUrut = 1;
            }
        }
        $noUrut = str_pad($noUrut, 3, '0', STR_PAD_LEFT);
        return "{$tahun}/{$period}/{$noUrut}";
    }

    // public function getNomorNCR()
    // {
    //     $lastNCR = self::orderBy('created_at', 'desc')->first();
    //     if ($lastNCR) {
    //         $lastTemaAudit = $lastNCR->tema_audit;
    //         $lastYear = substr($lastNCR->created_at, 2, 2);
    //         $currentYear = date('y');
    //         if ($lastYear == $currentYear && $lastTemaAudit == $this->tema_audit) {
    //             $lastNoNCR = substr($lastNCR->no_ncr, -3);
    //             $newNoNCR = str_pad($lastNoNCR + 1, 3, '0', STR_PAD_LEFT);
    //         } else {
    //             $newNoNCR = '001';
    //         }
    //     } else {
    //         $newNoNCR = '001';
    //     }
    //     return $currentYear . '/' . $this->tema_audit . '/' . $newNoNCR;
    // }
}
