<?php

namespace App\Http\Controllers;

use App\Models\satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\Parser\Handler\WhitespaceHandler;
use Yajra\DataTables\DataTables;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:satuan-list|satuane-create|satuan-edit|satuan-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:satuan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:satuan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:satuan-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $satuan = Satuan::latest()->get();
            return DataTables::of($satuan)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn='';
                    if (Auth::user()->can('satuan-list')) {
                    $btn = '<a href="'. route('satuan.show', $row->id) . '" class="btn btn-warning btn-sm">Show </a>';
                    }
                    if (Auth::user()->can('satuan-edit')) {
                    $btn .= '<a href="' . route('satuan.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                    }
                    if (Auth::user()->can('satuan-delete')) {
                    $btn .= ' <form action="' . route('satuan.destroy', $row->id) . '" method="POST" style="display:inline;">
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

        return view('satuan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('satuan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $request->validate([
                'nama' => 'required',
                


            ]);
            Satuan::create($request->all());
            return redirect()->route('satuan.index')
                ->with('success', ' created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $satuan = Satuan::where('id', '=', $id)->first();
        return view('satuan.show', compact('satuan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $satuan = Satuan::where('id', '=', $id)->first();
        return view('satuan.edit', compact('satuan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
          
        ]);
        $satuan = Satuan::where('id', '=', $id)->first();

        $satuan->update($request->all());
        return redirect()->route('satuan.index')
            ->with('success', 'satuan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $satuan = Satuan::where('id', '=', $id)->first();
        $satuan->delete();
        return redirect()->route('satuan.index')
            ->with('success', ' satuan deleted successfully');
    }
}
