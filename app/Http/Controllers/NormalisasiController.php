<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Material;
use App\Models\Normalisasi;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NormalisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:normalisasi-list|normalisasi-create|normalisasi-edit|normalisasi-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:normalisasi-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:normalisasi-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:normalisasi-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $normalisasi = Normalisasi::latest()->get();
            return DataTables::of($normalisasi)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'. route('normalisasi.show', $row->id) . '" class="btn btn-warning btn-sm">Show </a>';
                    $btn .= '<a href="' . route('normalisasi.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                    
                    $btn .= ' <form action="' . route('normalisasi.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus?\')">Delete</button>
                              </form>';
                    return $btn;
                })->addColumn('material', function ($row) {
                    return $row->material->nama;
                })
                ->addColumn('kriteria', function ($row) {
                    return $row->kriteria->nama;
                })
                ->rawColumns(['action']) // Menandai kolom yang berisi HTML
                ->make(true);
        }

        return view('normalisasi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materials = Material::all();
        $kriterias = Kriteria::all();
        return view('normalisasi.create', compact('materials', 'kriterias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $request->validate([
                'id_material' => 'required',
                'id_kriteria' => 'required',
                'nilai_normalisasi' => 'required',

            ]);
            Normalisasi::create($request->all());
            return redirect()->route('normalisasi.index')
                ->with('success', ' created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $normalisasi = Normalisasi::where('id', '=', $id)->first();
        return view('normalisasi.show', compact('normalisasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $normalisasi = Normalisasi::where('id', '=', $id)->first();
        return view('normalisasi.edit', compact('normalisasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_material' => 'required',
            'id_kriteria' => 'required',
            'nilai_normalisasi' => 'required',
        ]);
        $normalisasi = Normalisasi::where('id', '=', $id)->first();

        $normalisasi->update($request->all());
        return redirect()->route('normalisasi.index')
            ->with('success', 'normalisasi updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $normalisasi = Normalisasi::where('id', '=', $id)->first();
        $normalisasi->delete();
        return redirect()->route('normalisasi.index')
            ->with('success', 'Normalisasi deleted successfully');
    }
}
