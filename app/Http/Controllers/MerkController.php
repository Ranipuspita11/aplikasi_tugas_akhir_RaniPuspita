<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\Parser\Handler\WhitespaceHandler;
use Yajra\DataTables\DataTables;

class MerkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:merk-list|merk-create|merk-edit|merk-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:merk-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:merk-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:merk-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $merk = Merk::latest()->get();
            return DataTables::of($merk)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (Auth::user()->can('merk-list')) {
                    $btn = '<a href="'. route('merk.show' , $row->id). '" class="btn btn-warning btn-sm">Show </a>';
                    }
                    if (Auth::user()->can('merk-edit')) {
                    $btn .= '<a href="' . route('merk.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                    }
                     if (Auth::user()->can('merk-delete')) {
                    $btn .= ' <form action="' . route('merk.destroy', $row->id) . '" method="POST" style="display:inline;">
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

        return view('merk.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('merk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $request->validate([
                'nama' => 'required',
                


            ]);
            Merk::create($request->all());
            return redirect()->route('merk.index')
                ->with('success', ' created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $merk = Merk::where('id', '=', $id)->first();
        return view('merk.show', compact('merk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $merk = Merk::where('id', '=', $id)->first();
        return view('merk.edit', compact('merk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
          
        ]);
        $merk = Merk::where('id', '=', $id)->first();

        $merk->update($request->all());
        return redirect()->route('merk.index')
            ->with('success', 'Merk updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $merk = Merk::where('id', '=', $id)->first();
        $merk->delete();
        return redirect()->route('merk.index')
            ->with('success', ' merk deleted successfully');
    }
}
