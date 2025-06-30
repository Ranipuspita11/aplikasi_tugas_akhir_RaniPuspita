<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\Parser\Handler\WhitespaceHandler;
use Yajra\DataTables\DataTables;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
{
    $this->middleware('permission:suplier-list|suplier-create|suplier-edit|suplier-delete', ['only' => ['index', 'store']]);
    $this->middleware('permission:suplier-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:suplier-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:suplier-delete', ['only' => ['destroy']]);
}

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $suplier = Suplier::latest()->get();
            return DataTables::of($suplier)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn='';
                    if (Auth::user()->can('suplier-list')) {
                    $btn = '<a href="'. route('suplier.show', $row->id) . '" class="btn btn-warning btn-sm">Show </a>';
                    }
                    
                     if (Auth::user()->can('suplier-edit')) {
                    $btn .= '<a href="' . route('suplier.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                    }
                     if (Auth::user()->can('suplier-delete')) {
                    $btn .= ' <form action="' . route('suplier.destroy', $row->id) . '" method="POST" style="display:inline;">
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

        return view('suplier.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $request->validate([
                'nama' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'keterangan' => 'required',


            ]);
            Suplier::create($request->all());
            return redirect()->route('suplier.index')
                ->with('success', ' created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $suplier = Suplier::where('id', '=', $id)->first();
        return view('suplier.show', compact('suplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $suplier = Suplier::where('id', '=', $id)->first();
        return view('suplier.edit', compact('suplier'));
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
            'keterangan' => 'required',
        ]);
        $suplier = Suplier::where('id', '=', $id)->first();

        $suplier->update($request->all());
        return redirect()->route('suplier.index')
            ->with('success', 'Suplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $suplier = Suplier::where('id', '=', $id)->first();
        $suplier->delete();
        return redirect()->route('suplier.index')
            ->with('success', ' deleted successfully');
    }
}
