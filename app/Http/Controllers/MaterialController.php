<?php

namespace App\Http\Controllers;

use App\Helpers\WSMHelper;
use App\Models\Kategori_produk;
use App\Models\Material;
use App\Models\Merk;
use App\Models\satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:material-list|material-create|material-edit|material-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:material-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:material-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:material-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $materials = Material::latest()->get();
            return DataTables::of($materials)
                ->addIndexColumn()
                ->addColumn('foto', function ($row) {
                    $url = asset('storage/material/' . $row->foto);
                    return '<img src="' . $url . '" width="50px" height="50px" alt="Material Image">';
                })
                ->addColumn('action', function ($row) {
                $btn = '';

                if (Auth::user()->can('material-list')) {
                    $btn = '<a href="' . route('material.show', $row->id) . '" class="btn btn-warning btn-sm">Show </a>';
                }

                if (Auth::user()->can('material-edit')) {
                    $btn .= '<a href="' . route('material.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                }

                if (Auth::user()->can('material-delete')) {
                    $btn .= ' <form action="' . route('material.destroy', $row->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus?\')">Delete</button>
                          </form>';
                }

                    return $btn;
                    // })->addColumn('suplier', function ($row) {
                    // return $row->supplier;
                })->addColumn('merk', function ($row) {
                    return $row->merk->nama;
                })->addColumn('id_kategori_produk', function ($row) {
                    return $row->kategori_produk->nama;
                })->addColumn('id_satuan', function ($row) {
                    return $row->satuan->nama;
                })

                ->rawColumns(['foto', 'action']) // Menandai kolom yang berisi HTML
                ->make(true);
        }

        return view('material.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori_produks = Kategori_produk::all();
        $merks = Merk::all();
        $satuans = satuan::all();
        return view('material.create', compact('kategori_produks', 'merks', 'satuans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'id_merk' => 'required',
            'id_kategori_produk' => 'required',
            'id_satuan' => 'required',
            'foto' => 'required|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $input = $request->all();
        $image = $request->file('foto');
        $filename = time() . '_' . $request->nama . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('material', $filename);
        $input['foto'] = $filename;
        $material = Material::create($input);
        // dd($material);
        return redirect()->route('material.index')
            ->with('success', 'Material created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $material = Material::where('id', '=', $id)->first();
        return view('material.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        $kategori_produks = Kategori_produk::all();
        $merks = Merk::all();
        $satuans = satuan::all();
        return view('material.edit', compact('kategori_produks', 'merks', 'satuans', 'material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {

        // Validasi Input
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_merk' => 'required|string',
            'id_kategori_produk' => 'required|string',
            'id_satuan' => 'required|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Foto boleh kosong
        ]);

        // Ambil hanya input yang dibutuhkan
        // $input = $request->only(['nama', 'merk', 'harga', 'volume', 'satuan', 'harga_satuan']);
        $input = $request->all();

        // Proses Upload Gambar jika ada
        if ($request->hasFile('foto')) {
            // Hapus gambar lama jika ada
            if ($material->foto) {
                Storage::delete('material/' . $material->foto);
            }

            // Ambil file gambar baru
            $image = $request->file('foto');
            $filename = time() . '_' . Str::slug($request->nama) . '.' . $image->getClientOriginalExtension();

            // Simpan gambar baru ke storage
            $image->storeAs('material', $filename);

            // Simpan nama file di database
            $input['foto'] = $filename;
        }

        // Update Data Material
        $material->update($input);

        return redirect()->route('material.index')
            ->with('success', 'Material berhasil diperbarui.');
    }

    public function hitungWsmTotal()
    {
        $hasil = WSMHelper::hitung();
        return view('wsm.index', compact('hasil'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        // Cek apakah ada gambar yang tersimpan
        if ($material->foto) {
            // Hapus file gambar dari storage
            Storage::delete('material/' . $material->foto);
        }

        // Hapus data material dari database
        $material->delete();

        return redirect()->route('material.index')
            ->with('success', 'Material deleted successfully.');
    }
}
