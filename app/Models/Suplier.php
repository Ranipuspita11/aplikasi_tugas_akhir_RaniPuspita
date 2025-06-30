<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    protected $guarded = ['id'];
     public function rabDetails()
    {
        return $this->hasMany(Rab_detail::class, 'id_suplier_terpilih', 'id');
    }
}
