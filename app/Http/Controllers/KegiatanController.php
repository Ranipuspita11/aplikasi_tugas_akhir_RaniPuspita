<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\Parser\Handler\WhitespaceHandler;
use Yajra\DataTables\DataTables;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:kegiatan-list|kegiatan-create|kegiatan-edit|kegiatan-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:kegiatan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kegiatan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kegiatan-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $kegiatan = Kegiatan::latest()->get();
            return DataTables::of($kegiatan)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';

                    if (Auth::user()->can('kegiatan-list')) {
                    $btn = '<a href="'. route('kegiatan.show', $row->id) . '" class="btn btn-warning btn-sm">Show </a>';
                    }
                    if (Auth::user()->can('kegiatan-edit')) {
                    $btn .= '<a href="' . route('kegiatan.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                    }
                    if (Auth::user()->can('kegiatan-delete')) {
                    $btn .= ' <form action="' . route('kegiatan.destroy', $row->id) . '" method="POST" style="display:inline;">
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

        return view('kegiatan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $request->validate([
                'nama_pekerjaan' => 'required',
                


            ]);
            Kegiatan::create($request->all());
            return redirect()->route('kegiatan.index')
                ->with('success', ' kegiatan created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kegiatan = Kegiatan::where('id', '=', $id)->first();
        return view('kegiatan.show', compact('kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kegiatan = Kegiatan::where('id', '=', $id)->first();
        return view('kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pekerjaan' => 'required',
          
        ]);
        $kegiatan = Kegiatan::where('id', '=', $id)->first();

        $kegiatan->update($request->all());
        return redirect()->route('kegiatan.index')
            ->with('success', 'kegiatan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kegiatan = Kegiatan::where('id', '=', $id)->first();
        $kegiatan->delete();
        return redirect()->route('kegiatan.index')
            ->with('success', ' kegiatan deleted successfully');
    }
}
