<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    protected $table = 'portofolio_1061';
    protected $primaryKey = 'id';
    protected $fillable = [
        'Judul',
        'Deskripsi',
        'Tahun',
        'Link',
        'Foto',
    ];
}
