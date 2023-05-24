<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nc extends Model
{
    use HasFactory;

    protected $table = "nc";

    protected $fillable = [
        'id_nc',
        'opsi_temuan',
        'no_nc',
        'periode_audit',
        'proses_audit',
        'tema_audit',
        'objek_audit',
        'jenis_temuan',
        'dokumen',
        'tgl_terbitnc',
        'status',
        'bukti',
        'bab_audit',
        'dok_acuan',
        'uraian_nc',
        'kategori',
        'ttd_auditor_nc',
        'nama_auditor',
        'tgl_deadline',
        'ttd_diakui_oleh_nc',
        'diakui_oleh',
        'diakui_oleh_jabatan',
        'diakui_oleh_jabatan_nm',
        'ttd_disetujui_oleh',
        'disetujui_oleh',
        'disetujui_oleh1_jabatan',
        'disetujui_oleh1_jabatan_nm',
        'tgl_accgm',
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

    public function tlnc()
    {
        return $this->hasOne(TLNc::class, 'id_nc', 'id_nc');
    }

    public static function generateCode()
    {
        $tahun = date('y');
        $period = sprintf("%02d",ceil(date('n') / 6));
        $lastCode = self::where('no_nc', 'like', "{$tahun}/{$period}/%")->orderBy('no_nc', 'desc')->first();
        if (!$lastCode) {
            $noUrut = 1;
        } else {
            $noUrut = (int) substr($lastCode->no_nc, -3) + 1;
            if (substr($lastCode->no_nc, 0, 2) != $tahun) {
                $noUrut = 1;
            }
        }
        $noUrut = str_pad($noUrut, 3, '0', STR_PAD_LEFT);
        return "{$tahun}/{$period}/{$noUrut}";
    }
}
