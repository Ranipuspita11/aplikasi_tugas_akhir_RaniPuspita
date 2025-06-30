<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skor_total extends Model
{
    protected $guarded = ['id'];
    public function material()
    {
        return $this->belongsTo(Material::class, 'id_material');
    }
}
