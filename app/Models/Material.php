<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = ['id'];
    public function kategori_produk()
    {
        return $this->hasOne(Kategori_produk::class, 'id', 'id_kategori_produk',);
        
    }
    public function merk()
    {
        return $this->hasOne(Merk::class, 'id', 'id_merk',);
       
    }
    public function satuan()
    {
        return $this->hasOne(satuan::class, 'id', 'id_satuan',);
    }

    public function rabDetails()
    {
        return $this->hasMany(Rab_detail::class, 'id_material', 'id');
    }
}
