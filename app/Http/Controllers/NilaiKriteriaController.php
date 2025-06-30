<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Material;
use App\Models\Nilai_kriteria;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NilaiKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:nilai_kriteria-list|nilai_kriteria-create|nilai_kriteria-edit|nilai_kriteria-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:nilai_kriteria-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:nilai_kriteria-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:nilai_kriteria-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $nilai_kriterias = Nilai_kriteria::latest()->get();
            return DataTables::of($nilai_kriterias)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="'. route('nilai_kriteria.show', $row->id) . '" class="btn btn-warning btn-sm">Show </a>';
                    $btn .= '<a href="' . route('nilai_kriteria.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <form action="' . route('nilai_kriteria.destroy', $row->id) . '" method="POST" style="display:inline;">
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

        return view('nilai_kriteria.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materials = Material::all();
        $kriterias = Kriteria::all();
        return view('nilai_kriteria.create', compact('materials', 'kriterias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $request->validate([
                'id_material' => 'required',
                'id_kriteria' => 'required',
                'nilai' => 'required',

            ]);
            Nilai_kriteria::create($request->all());
            return redirect()->route('nilai_kriteria.index')
                ->with('success', ' created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $nilai_kriteria = Nilai_kriteria::where('id', '=', $id)->first();
        return view('nilai_kriteria.show', compact('nilai_kriteria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $nilai_kriteria = Nilai_kriteria::where('id', '=', $id)->first();
        return view('nilai_kriteria.edit', compact('nilai_kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_material' => 'required',
            'id_kriteria' => 'required',
            'nilai' => 'required',
        ]);
        $nilai_kriteria = Nilai_kriteria::where('id', '=', $id)->first();

        $nilai_kriteria->update($request->all());
        return redirect()->route('nilai_kriteria.index')
            ->with('success', 'nilai kriteria updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $nilai_kriteria = Nilai_kriteria::where('id', '=', $id)->first();
        $nilai_kriteria->delete();
        return redirect()->route('nilai_kriteria.index')
            ->with('success', 'Nilai kriteria deleted successfully');
    }
}
