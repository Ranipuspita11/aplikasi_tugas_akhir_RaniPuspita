<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rab_detail extends Model
{
    protected $guarded = ['id'];

    

    public function WSM(){
        return $this->hasMany(Tabel_hasil_wsm::class,'id_rab_detail','id');
    }

    public function Rab()
    {
        return $this->belongsTo(Rab::class, 'id_rab');
    }

    public function Material()
    {
        return $this->hasOne(Material::class, 'id', 'id_material');
    }

    public function Suplier()
    {
        return $this->hasOne(Suplier::class, 'id', 'id_supplier_terpilih');
    }

    public function Kegiatan()
    {
        return $this->hasOne(Kegiatan::class, 'id', 'id_kegiatan');
    }

    public function suplierTerpilih()
    {
        return $this->belongsTo(Suplier::class, 'id_suplier_terpilih');
    }
}
