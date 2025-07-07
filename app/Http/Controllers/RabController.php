<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Rab;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\CssSelector\Parser\Handler\WhitespaceHandler;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon; // Pastikan ini ada

class RabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:rab-list|rab-create|rab-edit|rab-delete|rab-verifikasi', ['only' => ['index', 'store']]);
        $this->middleware('permission:rab-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:rab-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:rab-delete', ['only' => ['destroy']]);
        $this->middleware('permission:rab-verifikasi', ['only' => ['verifikasiBerkas']]);
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $rab = Rab::latest()->get();
            return DataTables::of($rab)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "";
                    $user = auth()->user();

                    // Aksi khusus Admin
                    if ($user->hasRole('Admin') && $row->status != 'verified' && $row->status != 'not_verified') {
                        // Tombol verifikasi (Setujui dan Tolak)
                        $btn .= '<div class="btn-group mb-1" role="group">';
                        $btn .= '<button type="button" class="btn btn-success btn-sm btn-verifikasi" data-bs-toggle="modal" data-bs-target="#verifikasiModal" data-id="' . $row->id . '" data-role="Admin" data-action="verified">
                        <i class="fas fa-check"></i> Setujui </button>';
                        $btn .= '<button type="button" class="btn btn-danger btn-sm btn-verifikasi" data-bs-toggle="modal" data-bs-target="#verifikasiModal" data-id="' . $row->id . '" data-action="not_verified">
                        <i class="fas fa-times"></i> Tolak </button>';
                        $btn .= '</div>';
                    }

                    // Status Badge
                    if ($row->status == 'verified') {
                        $btn .= '<span class="badge bg-success mb-1">Terverifikasi</span><br>';
                    } elseif ($row->status == 'not_verified') {
                        $btn .= '<span class="badge bg-danger mb-1">Ditolak</span><br>';
                    } elseif ($row->verifikasi_by != null) {
                        $btn .= '<span class="badge bg-warning mb-1">Menunggu Admin</span><br>';
                    } else {
                        $btn .= '<span class="badge bg-secondary mb-1">Menunggu admin</span><br>';
                    }

                    // Action Buttons (Show, Edit, Delete)
                    $btn .= '<div class="btn-group" role="group">';

                    // Tombol Show
                    $btn .= '<a href="' . route('rab.show', $row->id) . '" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> Show
                    </a>';

                    // Tombol Edit (Admin bisa edit kapanpun)
                    $btn .= '<a href="' . route('rab.edit', $row->id) . '" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>';

                   // Tombol Cetak - Hanya bisa diakses oleh Pimpinan
                    if ($user->hasRole('Pimpinan')) { // <--- Penambahan kondisi ini
                        $btn .= '<a href="' . route('cetak_rab', $row->id) . '" class="btn btn-success btn-sm">
                            <i class="fas fa-print"></i> Cetak
                        </a>';
                    }

                    // Tombol Delete (Admin bisa hapus kapanpun)
                    $btn .= '<form action="' . route('rab.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus?\')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>';
                    $btn .= '</div>';

                    return $btn;
    })
                ->rawColumns(['action']) // Menandai kolom yang berisi HTML
                ->make(true);
        }

        return view('rab.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rab.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'nama' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',

        ]);

        Rab::create($request->all());
        return redirect()->route('rab.index')
            ->with('success', 'rab created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rab = Rab::where('id', '=', $id)->first();
        return view('rab.show', compact('rab'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rab = Rab::where('id', '=', $id)->first();
        return view('rab.edit', compact('rab'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'nama' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',

        ]);
        $rab = Rab::where('id', '=', $id)->first();

        $rab->update($request->all());
        return redirect()->route('rab.index')
            ->with('success', 'Rab updated successfully');
    }

    public function verifikasi_berkas_verified(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tanggal_verifikasi' => 'required|date',
            'keterangan' => 'nullable|string|max:500'
        ]);

        $rab = Rab::where('id', '=', $id)->first();
        $user = Auth::user();
        $roles = $user->getRoleNames(); // return Collection

        if (Auth::user()->hasRole('Admin')) {
            $rab->update([
                'status' => 'verified',
                'verifikasi_at' => $request->tanggal_verifikasi, // Gunakan tanggal dari form
                'verifikasi_by' => Auth::user()->id,
                'keterangan_verifikasi' => $request->keterangan // Simpan keterangan
            ]);
        } elseif (Auth::user()->hasRole('Admin')) {
            $rab->update([
                'status' => 'verified',
                'verifikasi_at' => $request->tanggal_verifikasi,
                'verifikasi_by' => Auth::user()->id,
                'keterangan_verifikasi' => $request->keterangan
            ]);
        }

        return redirect()->route('rab.index')
            ->with('success', 'RAB berhasil diverifikasi pada tanggal ' . date('d/m/Y', strtotime($request->tanggal_verifikasi)));
    }

    public function verifikasi_berkas_notverified(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tanggal_verifikasi' => 'required|date',
            'keterangan' => 'nullable|string|max:500'
        ]);

        $rab = Rab::where('id', '=', $id)->first();
        $user = Auth::user();
        $roles = $user->getRoleNames(); // return Collection

        // Hanya Admin yang bisa melakukan not_verified
        $rab->update([
            'status' => 'not_verified',
            'verifikasi_at' => $request->tanggal_verifikasi, // Gunakan tanggal dari form
            'verifikasi_by' => Auth::user()->id,
            'keterangan_verifikasi' => $request->keterangan // Simpan keterangan
        ]);

        return redirect()->route('rab.index')
            ->with('success', 'RAB ditolak verifikasi pada tanggal ' . date('d/m/Y', strtotime($request->tanggal_verifikasi)));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rab = Rab::where('id', '=', $id)->first();
        $rab->delete();
        return redirect()->route('rab.index')
            ->with('success', ' rab deleted successfully');
    }

    public function getDetails($id)
    {
        try {
            // Ambil data RAB
            $rab = DB::table('rabs')->where('id', $id)->first();

            if (!$rab) {
                return response()->json([
                    'success' => false,
                    'message' => 'RAB tidak ditemukan'
                ], 404);
            }

            // Ambil detail RAB dengan join ke tabel material, satuan, dan supplier
            $details = DB::table('rab_details')
                ->leftJoin('materials', 'rab_details.id_material', '=', 'materials.id')
                ->leftJoin('satuans', 'materials.id_satuan', '=', 'satuans.id')
                ->leftJoin('supliers', 'rab_details.id_supplier_terpilih', '=', 'supliers.id')
                ->select(
                    
                    'rab_details.*',
                    'materials.nama as material_nama',
                    
                    'satuans.nama as satuan_nama',
                    'supliers.nama as supplier_nama'

                )
                ->where('rab_details.id_rab', $id)
                ->get();

            return response()->json([
                'success' => true,
                'rab' => $rab,
                'details' => $details
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data: ' . $e->getMessage()
            ], 500);
        }
    }

    // Fungsi untuk mengekspor SEMUA RAB
  public function exportPdf()
    {
        // Memuat relasi dengan benar
        $rabs = Rab::with([
            'details.material.satuan',
            'details.material.merk',
            'details.kegiatan',
            'details.suplier'
        ])->get();

        $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        $pdf = Pdf::loadView('rab.export-pdf', compact('rabs', 'tanggalCetak'));

        return $pdf->download('daftar_rab_' . Carbon::now()->format('YmdHis') . '.pdf');
    }

    public function cetak($id)
    {
        // Memuat relasi dengan benar
        $rab = Rab::with([
            'details.material.satuan',
            'details.material.merk',
            'details.kegiatan',
            'details.suplier'
        ])->findOrFail($id);
// dd($rab->toArray());
        // Jika kolom 'total_harga' di tabel 'rabs' kosong/nol,
        // dan Anda ingin menghitung ulang dari details, lakukan ini:
        // Ini akan menimpa $rab->total_harga yang mungkin nol dari DB.
        $rab->total_harga = 0; // Reset atau pastikan properti ini ada
        foreach ($rab->details as $detail) {
            // Pastikan casting ke float untuk perhitungan yang akurat
            $qty = (float) $detail->qty;
            $harga = (float) $detail->harga_terpilih;
            $subtotal_detail = $qty * $harga; // Hitung subtotal untuk detail ini
            $detail->subtotal = $subtotal_detail; // Tambahkan/timpa properti subtotal di objek detail sementara
            $rab->total_harga += $subtotal_detail; // Akumulasikan ke total harga RAB
        }

        $tanggalCetak = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        // Bungkus $rab tunggal ke dalam koleksi untuk konsistensi dengan view export-pdf
        // $rab ini sekarang sudah memiliki $rab->total_harga dan $detail->subtotal yang terhitung
        $rabs = collect([$rab]);

        $pdf = Pdf::loadView('rab.export-pdf', compact('rabs', 'tanggalCetak'));

        return $pdf->download('rab_' . $rab->nama . '_' . Carbon::now()->format('YmdHis') . '.pdf');
    }
}
