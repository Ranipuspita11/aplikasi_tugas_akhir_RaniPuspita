<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(Rab_detail::class, 'id_rab')->orderBy('id_kegiatan');;
    }
}
