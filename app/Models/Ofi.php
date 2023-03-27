<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ofi extends Model
{
    use HasFactory;

    protected $table = "ofi";

    protected $fillable = [
        'no_ofi',
        'proses_audit',
        'tema_audit',
        'objek_audit',
        'jenis_temuan',
        'dokumen',
        'tgl_terbitofi',
        'status',
        'bukti',
        'asal_dept',
        'proyek',
        'dept_ygmngrjkn',
        'usulan_ofi',
        'uraian_permasalahan',
        'usulan_peningkatan',
        'ttd_dept_pengusul',
        'dept_pengusul',
        'tgl_diusulkan',
        'ttd_disetujui_oleh',
        'disetujui_oleh',
        'tgl_disetujui',
        'disposisi',
        'ttd_disposisi',
        'disposisi_diselesaikan_oleh',
        'tgl_deadline',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'objek_audit', 'id');
    }

    public function users_tema()
    {
        return $this->belongsTo(User::class, 'tema_audit', 'id');
    }

    public function user_asal_dept()
    {
        return $this->belongsTo(User::class, 'asal_dept', 'id');
    }

    public function user_dept_ygmngrjkn()
    {
        return $this->belongsTo(User::class, 'dept_ygmngrjkn', 'id');
    }

    public function tlofi()
    {
        return $this->hasOne(TLNcr::class, 'id_ofi', 'id_ofi');
    }

    public static function generateCode()
    {
        $tahun = date('y');
        $period = sprintf("%02d", ceil(date('n') / 6));
        $lastCode = self::where('no_ofi', 'like', "{$tahun}/{$period}/%")->orderBy('no_ofi', 'desc')->first();
        if (!$lastCode) {
            $noUrut = 1;
        } else {
            $noUrut = (int) substr($lastCode->no_ofi, -3) + 1;
            if (substr($lastCode->no_ofi, 0, 2) != $tahun) {
                $noUrut = 1;
            }
        }
        $noUrut = str_pad($noUrut, 3, '0', STR_PAD_LEFT);
        return "{$tahun}/{$period}/{$noUrut}";
    }
}
