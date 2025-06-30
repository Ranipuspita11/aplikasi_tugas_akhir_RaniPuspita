<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai_kriteria extends Model
{
    protected $guarded = ['id'];
    public function material()
    {
        return $this->belongsTo(Material::class, 'id_material');
    }
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }
}
