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
        'dept_pengusul',
        'tgl_diusulkan',
        'disetujui_oleh',
        'tgl_disetujui',
        'disposisi',
        'disposisi_diselesaikan_oleh',
        'tgl_deadline',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'objek_audit', 'id');
    }

    public function tlofi()
    {
        return $this->hasOne(TLNcr::class, 'id_ofi', 'id_ofi');
    }
}
