<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'kriteria-list',
            'kriteria-create',
            'kriteria-edit',
            'kriteria-delete',
            'kategori_produk-list',
            'kategori_produk-create',
            'kategori_produk-edit',
            'kategori_produk-delete',
            'kegiatan-list',
            'kegiatan-create',
            'kegiatan-edit',
            'kegiatan-delete',
            'material-list',
            'material-create',
            'material-edit',
            'material-delete',
            'merk-list',
            'merk-create',
            'merk-edit',
            'merk-delete',
            'nilai_kriteria-list',
            'nilai_kriteria-create',
            'nilai_kriteria-edit',
            'nilai_kriteria-delete',
            'normalisasi-list',
            'normalisasi-create',
            'normalisasi-edit',
            'normalisasi-delete',
            'produk_suplier-list',
            'produk_suplier-create',
            'produk_suplier-edit',
            'produk_suplier-delete',
            'rab_detail-list',
            'rab_detail-create',
            'rab_detail-edit',
            'rab_detail-delete',
            'rab-list',
            'rab-create',
            'rab-edit',
            'rab-delete',
            'satuan-list',
            'satuan-create',
            'satuan-edit',
            'satuan-delete',
            'skor_total-list',
            'skor_total-create',
            'skor_total-edit',
            'skor_total-delete',
            'suplier-list',
            'suplier-create',
            'suplier-edit',
            'suplier-delete',
            'tabel_hasil_wsm-list',
            'tabel_hasil_wsm-create',
            'tabel_hasil_wsm-edit',
            'tabel_hasil_wsm-delete',
            'tabel_pengaturan_bobot-list',
            'tabel_pengaturan_bobot-create',
            'tabel_pengaturan_bobot-edit',
            'tabel_pengaturan_bobot-delete',

        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
