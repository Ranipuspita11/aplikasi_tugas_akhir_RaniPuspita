<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produk_suplier extends Model
{
    protected $guarded = ['id'];
    public function suplier()
    {
        return $this->hasOne(Suplier::class, 'id', 'id_suplier');
    }
    public function material()
    {
        return $this->hasOne(material::class, 'id', 'id_material');
    }
}
