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
        'tgl_accgm',
        'uraian_verifikasi',
        'hasil_verif',
        'verifikator',
        'tgl_verif',
        'rekomendasi',
        'namasm_verif',
    ];

    public function ncr()
    {
        return $this->hasOne(Ncr::class, 'id_ncr', 'id_ncr');
    }
}
