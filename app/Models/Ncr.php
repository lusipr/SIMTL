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
        'nama_auditor',
        'tgl_deadline',
        'diakui_oleh',
        'disetujui_oleh',
        'tgl_accgm',
        'tgl_planaction',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'objek_audit', 'id');
    }

    public function tlncr()
    {
        return $this->hasOne(TLNcr::class, 'id_ncr', 'id_ncr');
    }
}
