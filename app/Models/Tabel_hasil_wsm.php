<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tabel_hasil_wsm extends Model
{
   
    protected $guarded = ['id'];
    public function rab_detail()
    {
        return $this->hasOne(Rab_detail::class, 'id' , 'id_rab_detail',);
    }
    public function suplier()
    {
        return $this->hasOne(Suplier::class, 'id','id_suplier',);
    }
    public function material()
    {
        return $this->hasOne(Material::class, 'id' , 'id_material',);
    }

}
