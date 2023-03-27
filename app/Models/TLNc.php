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
        'uraian_verifikasi',
        'hasil_verif',
        'verifikator',
        'tgl_verif',
        'rekomendasi',
        'namasm_verif',
    ];

    public function nc()
    {
        return $this->hasOne(Nc::class, 'id_nc', 'id_nc');
    }
}
