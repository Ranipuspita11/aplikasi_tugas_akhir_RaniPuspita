<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:kriteria-list|kriteria-create|kriteria-edit|kriteria-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:kriteria_produk-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kriteria-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kriteria-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        // $kriterias = Kriteria::latest()->paginate(5);
        // return view('kriteria.index', compact('kriterias'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);

        if ($request->ajax()) {
            $kriterias = Kriteria::latest()->get();
            return DataTables::of($kriterias)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';

                    if (Auth ::user()->can('kriteria-list')) {
                    $btn = '<a href="'. route('kriteria.show', $row->id) . '" class="btn btn-warning btn-sm">Show </a>';
                    }

                    if (Auth::user()->can('kriteria-edit')) {
                    $btn .= '<a href="' . route('kriteria.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                    }
                    if (Auth::user()->can('kriteria-delete')) {
                    $btn .= ' <form action="' . route('kriteria.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus?\')">Delete</button>
                              </form>';
                    }
                    return $btn;
                })
                ->rawColumns(['action']) // Menandai kolom yang berisi HTML
                ->make(true);
        }

        return view('kriteria.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $request->validate([
                'nama' => 'required',
                'bobot' => 'required',
                'tipe' => 'required',

            ]);
            Kriteria::create($request->all());
            return redirect()->route('kriteria.index')
                ->with('success', ' created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kriteria = Kriteria::where('id', '=', $id)->first();
        return view('kriteria.show', compact('kriteria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kriteria = Kriteria::where('id', '=', $id)->first();
        return view('kriteria.edit', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'bobot' => 'required',
            'tipe' => 'required',
        ]);
        $kriteria = Kriteria::where('id', '=', $id)->first();

        $kriteria->update($request->all());
        return redirect()->route('kriteria.index')
            ->with('success', 'kriteria updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kriteria = Kriteria::where('id', '=', $id)->first();
        $kriteria->delete();
        return redirect()->route('kriteria.index')
            ->with('success', 'kriteria deleted successfully');
    }
}
