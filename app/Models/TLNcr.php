<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TLNcr extends Model
{
    use HasFactory;

    protected $table = "tlncr";

    public $primaryKey = 'id_formncrtl';

    protected $fillable = [
        'id_ncr',
        'akar_masalah',
        'uraian_perbaikan',
        'uraian_pencegahan',
        'tgl_action',
        'disetujui_oleh2',
        'disetujui_oleh2_jabatan',
        'ttd_tl_gm',
        'tgl_accgm2',
        'uraian_verifikasi',
        'hasil_verif',
        'ttd_tl_verif_auditor',
        'verifikator',
        'tgl_verif',
        'rekomendasi',
        'ttd_tl_verif_adm',
        'namasm_verif',
        'uraian_catatan_tkp',
        'tgl_verif_adm2',
    ];

    public function ncr()
    {
        return $this->hasOne(Ncr::class, 'id_ncr', 'id_ncr');
    }
}
