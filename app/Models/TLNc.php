<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TLNc extends Model
{
    use HasFactory;

    protected $table = "tlnc";

    public $primaryKey = 'id_formnctl';

    protected $fillable = [
        'id_nc',
        'akar_masalah',
        'uraian_perbaikan',
        'uraian_pencegahan',
        'tgl_action',
        'tgl_accgm',
        'ttd_disetujui_oleh_tlnc',
        'disetujui_oleh_tl',
        'disetujui_oleh_tl_jabatan',
        'uraian_verifikasi',
        'hasil_verif',
        'ttd_verifikator_tlnc',
        'verifikator',
        'tgl_verif',
        'rekomendasi',
        'ttd_verifsm_tlnc',
        'namasm_verif',
        'tgl_verifsm',
    ];

    public function nc()
    {
        return $this->hasOne(Nc::class, 'id_nc', 'id_nc');
    }
}
