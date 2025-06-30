<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Material;
use App\Models\produk_suplier;
use App\Models\Rab;
use App\Models\Rab_detail;
use App\Models\Suplier;
use App\Models\Tabel_hasil_wsm;
use App\Models\Tabel_pengaturan_bobot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\Parser\Handler\WhitespaceHandler;
use Yajra\DataTables\DataTables;

class RabDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:rab_detail-list|rab_detail-create|rab_detail-edit|rab_detail-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:rab_detail-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:rab_detail-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:rab_detail-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $rab_detail = Rab_detail::with(['rab', 'material', 'suplier', 'kegiatan'])->latest()->get();
            return DataTables::of($rab_detail)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn='';
                    if (Auth::user()->can('rab_detail-list')) {
                    $btn = '<a href="' . route('rab_detail.show', $row->id) . '" class="btn btn-warning btn-sm">Show </a>';
                    }
                    if (Auth::user()->can('rab_detail-edit')) {
                    $btn .= '<a href="' . route('rab_detail.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                    }
                    if (Auth::user()->can('rab_detail-delete')) {
                    $btn .= ' <form action="' . route('rab_detail.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus?\')">Delete</button>
                              </form>';
                    }
                    return $btn;
                })
                ->addColumn('id_rab', function ($row) {
                    return $row->rab->nama ?? "-";
                })->addColumn('id_kegiatan', function ($row) {
                    return $row->kegiatan->nama_pekerjaan;
                })->addColumn('id_material', function ($row) {
                    return $row->material->nama;
                })->addColumn('id_supplier_terpilih', function ($row) {
                    return $row->suplier->nama;
                })
                ->rawColumns(['action']) // Menandai kolom yang berisi HTML
                ->make(true);
        }

        return view('rab_detail.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rabs = Rab::all();
        $materials = Material::all();
        $supliers = Suplier::all();
        $kegiatans = Kegiatan::all();
        return view('rab_detail.create', compact('rabs', 'materials', 'supliers', 'kegiatans'));
    }

    private function hitungJarak($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // dalam KM

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $request->validate([
                'id_rab' => 'required',
                'id_kegiatan' => 'required',
                'id_material' => 'required',
                'qty' => 'required',
                // 'id_supplier_terpilih' => 'required',
                // 'harga_terpilih' => 'required',
            ]);

            $rab = Rab::find($request->id_rab);
            $latitude_lokasi_proyek = $rab->latitude;
            $longitude_lokasi_proyek = $rab->longitude;

            $material = Material::find($request->id_material);

            $material_supplier = produk_suplier::with('suplier')->where('id_material', '=', $material->id)->get();

            $konfigurasi_bobot = Tabel_pengaturan_bobot::first();
            $bobot_harga = $konfigurasi_bobot->bobot_harga;
            $bobot_jarak = $konfigurasi_bobot->bobot_jarak;
            $bobot_rating = $konfigurasi_bobot->bobot_rating;

            // dd($bobot_harga);

            // Ambil nilai mentah
            $data = [];
            foreach ($material_supplier as $item) {
                $harga = $item->harga_satuan;
                $suplier = $item->suplier;
                $jarak = $this->hitungJarak(
                    $latitude_lokasi_proyek,
                    $longitude_lokasi_proyek,
                    $suplier->latitude,
                    $suplier->longitude
                );
                $rating = $item->rating ?? 0;

                $data[] = [
                    'suplier_id' => $suplier->id,
                    'nama_suplier' => $suplier->nama,
                    'harga' => $harga,
                    'jarak' => $jarak,
                    'rating' => $rating,
                ];
            }

            // Cari nilai min/max untuk normalisasi
            $min_harga = collect($data)->min('harga');
            $min_jarak = collect($data)->min('jarak');
            $max_rating = collect($data)->max('rating');

            // Hitung skor WSM
            $hasil = [];
            foreach ($data as $row) {
                $r_harga = $min_harga / $row['harga']; // cost
                $r_jarak = $min_jarak / $row['jarak']; // cost
                $r_rating = $row['rating'] / $max_rating; // benefit

                $skor = ($r_harga * $bobot_harga) +
                    ($r_jarak * $bobot_jarak) +
                    ($r_rating * $bobot_rating);

                $hasil[] = [
                    'suplier_id' => $row['suplier_id'],
                    'nama_suplier' => $row['nama_suplier'],
                    'skor_wsm' => round($skor, 4),
                    'harga_terpilih' => $row['harga'],
                    'r_harga' => round($r_harga, 4),
                    'r_jarak' => round($r_jarak, 4),
                    'r_rating' => round($r_rating, 4),
                ];
            }

            // Urutkan dari skor tertinggi ke terendah
            $sorted = collect($hasil)->sortByDesc('skor_wsm')->values();


            $data_detail = [
                "id_rab" => $request->id_rab,
                "id_kegiatan" => $request->id_kegiatan,
                "id_material" => $request->id_material,
                "qty" => $request->qty,
                "id_supplier_terpilih" => $sorted[0]['suplier_id'],
                "harga_terpilih" =>  $sorted[0]['harga_terpilih'],
            ];
            $detail = Rab_detail::create($data_detail);
            foreach ($sorted as $item) {
                # code...
                Tabel_hasil_wsm::create([
                    "id_rab_detail" => $detail->id,
                    "id_suplier" => $item['suplier_id'],
                    "id_material" => $request->id_material,
                    "harga" => $item['harga_terpilih'],
                    "score" => $item['skor_wsm'],
                ]);
            }

            return redirect()->route('rab_detail.index')
                ->with('success', 'rab detail created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rab_detail = Rab_detail::where('id', '=', $id)->first();
        return view('rab_detail.show', compact('rab_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rab_detail = Rab_Detail::where('id', '=', $id)->first();
        $rabs = Rab::all();
        $materials = Material::all();
        $supliers = Suplier::all();
        $kegiatans = Kegiatan::all();
        // dd($kegiatans);
        return view('rab_detail.edit', compact('rabs', 'materials', 'supliers', 'kegiatans','rab_detail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_rab' => 'required',
            'id_kegiatan' => 'required',
            'id_material' => 'required',
            'qty' => 'required',
            'id_supplier_terpilih' => 'required',
            'harga_terpilih' => 'required',
            'id_kegiatan' => 'required' ,

        ]);
        $rab_detail = Rab_detail::where('id', '=', $id)->first();

        $rab_detail->update($request->all());
        return redirect()->route('rab_detail.index')
            ->with('success', 'Rab detail updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rab_detail = Rab_detail::where('id', '=', $id)->first();
        $rab_detail->delete();
        return redirect()->route('rab_detail.index')
            ->with('success', ' rab deleted successfully');
    }
}
