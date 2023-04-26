<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    protected $table = "tema";

    protected $fillable = [
        'id_tema',
        'nama_tema',
    ];

    public function tema()
    {
        return $this->hasOne(Tema::class, 'id_tema', 'id_tema');
    }
}
