<?php

namespace App\Helpers;

use App\Models\Kriteria;
use App\Models\Material;
use App\Models\Nilai_kriteria;
use App\Models\Normalisasi;
use App\Models\Skor_total;

class WSMHelper
{
    public static function hitung()
    {
        // Mendapatkan semua data kriteria dan material
        $kriterias = Kriteria::all();
        $materials = Material::all();

        // Step 1: Normalisasi
        foreach ($kriterias as $kriteria) {
            $nilaiList = Nilai_kriteria::where('id_kriteria', $kriteria->id)->pluck('nilai');
            $max = $nilaiList->max();
            $min = $nilaiList->min();

            foreach ($materials as $material) {
                $nilai = Nilai_kriteria::where('id_material', $material->id)
                    ->where('id_kriteria', $kriteria->id)
                    ->first();

                if ($nilai) {
                    // Normalisasi berdasarkan tipe kriteria
                    $normalisasi = $kriteria->tipe === 'benefit'
                        ? $nilai->nilai / $max
                        : $min / $nilai->nilai;

                    // Menyimpan atau memperbarui nilai normalisasi
                    Normalisasi::updateOrCreate(
                        [
                            'id_material' => $material->id,
                            'id_kriteria' => $kriteria->id
                        ],
                        [
                            'nilai_normalisasi' => $normalisasi
                        ]
                    );
                }
            }
        }

        // Step 2: Hitung Skor Total
        foreach ($materials as $material) {
            $normalisasiList = Normalisasi::where('id_material', $material->id)->get();
            $skorTotal = 0;

            foreach ($normalisasiList as $n) {
                // Mendapatkan bobot kriteria berdasarkan id dan pastikan nilainya numerik
                $bobot = $kriterias->firstWhere('id', $n->id_kriteria)->bobot;

                // Pastikan bobot dan nilai_normalisasi adalah numerik
                $bobot = is_numeric($bobot) ? (float)$bobot : 0;
                $nilai_normalisasi = is_numeric($n->nilai_normalisasi) ? (float)$n->nilai_normalisasi : 0;

                // Menghitung skor total
                $skorTotal += $nilai_normalisasi * $bobot;
            }


            // Menyimpan atau memperbarui skor total
            Skor_total::updateOrCreate(
                ['id_material' => $material->id],
                ['skor_total' => $skorTotal]
            );
        }

        // Mengembalikan hasil ranking berdasarkan skor total
        return Skor_total::with('material')->orderByDesc('skor_total')->get();
    }
}
