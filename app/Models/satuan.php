<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class satuan extends Model
{
    protected $guarded = ['id'];

    public function materials()
    {
        return $this->hasMany(Material::class, 'id_satuan', 'id');
    }
}
