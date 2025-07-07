<?php

namespace App\Http\Controllers;

use App\Models\Kategori_produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\Parser\Handler\WhitespaceHandler;
use Yajra\DataTables\DataTables;

class KategoriProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:kategori_produk-list|kategori_produk-create|kategori_produk-edit|kategori_produk-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:kategori_produk-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:kategori_produk-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:kategori_produk-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    
    {
        

        if ($request->ajax()) {
            $kategori_produk = Kategori_produk::latest()->get();
            return DataTables::of($kategori_produk)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '';
                    if (Auth::user()->can('kategori_produk-list')) {
                    $btn = '<a href="'. route('kategori_produk.show' , $row->id ).'" class="btn btn-warning btn-sm">Show </a>';
                    }
                    if (Auth::user()->can('material-edit')) {
                    $btn .= '<a href="' . route('kategori_produk.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                    }
                    if (Auth::user()->can('material-delete')) {
                    $btn .= ' <form action="' . route('kategori_produk.destroy', $row->id) . '" method="POST" style="display:inline;">
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

        return view('kategori_produk.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori_produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $request->validate([
                'nama' => 'required',
                


            ]);
            Kategori_produk::create($request->all());
            return redirect()->route('kategori_produk.index')
                ->with('success', ' created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kategori_produk = Kategori_produk::where('id', '=', $id)->first();
        return view('kategori_produk.show', compact('kategori_produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori_produk = Kategori_produk::where('id', '=', $id)->first();
        return view('kategori_produk.edit', compact('kategori_produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
          
        ]);
        $kategori_produk = Kategori_produk::where('id', '=', $id)->first();

        $kategori_produk->update($request->all());
        return redirect()->route('kategori_produk.index')
            ->with('success', 'kategori produk updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori_produk = Kategori_produk::where('id', '=', $id)->first();
        $kategori_produk->delete();
        return redirect()->route('kategori_produk.index')
            ->with('success', ' kategori produk deleted successfully');
    }
}
