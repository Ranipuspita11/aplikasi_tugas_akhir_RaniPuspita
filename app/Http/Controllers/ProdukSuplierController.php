<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Produk_suplier;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\Parser\Handler\WhitespaceHandler;
use Yajra\DataTables\DataTables;

class ProdukSuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:produk_suplier-list|produk_suplier-create|produk_suplier-edit|produk_suplier-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:produk_suplier-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:produk_suplier-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:produk_suplier-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $produk_suplier = Produk_suplier::latest()->get();
            return DataTables::of($produk_suplier)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn ='';
                    if (Auth::user()->can('produk_suplier-list')) {
                    $btn = '<a href="' . route('produk_suplier.show', $row->id) . '" class="btn btn-warning btn-sm">Show </a>';
                     }
                    if (Auth::user()->can('produk_suplier-edit')) {
                    $btn .= '<a href="' . route('produk_suplier.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                    }
                    if (Auth::user()->can('produk_suplier-delete')) {
                    $btn .= ' <form action="' . route('produk_suplier.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus?\')">Delete</button>
                              </form>';
                    }
                    return $btn;
                })->addColumn('id_suplier', function ($row) {
                    return $row->suplier->nama;
                })->addColumn('id_material', function ($row) {
                    return $row->material->nama . " - " . $row->material->merk->nama . " - " . $row->material->satuan->nama;
                })
                ->rawColumns(['action']) // Menandai kolom yang berisi HTML
                ->make(true);
        }

        return view('produk_suplier.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supliers = Suplier::all();
        $materials = Material::with('merk')->get();
        return view('produk_suplier.create', compact('supliers', 'materials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $request->validate([
                'id_suplier' => 'required',
                'id_material' => 'required',
                'harga_satuan' => 'required',
                'rating' => 'required',
            ]);
            Produk_suplier::create($request->all());
            return redirect()->route('produk_suplier.index')
                ->with('success', 'Produk Suplier created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produk_suplier = Produk_suplier::where('id', '=', $id)->first();
        return view('produk_suplier.show', compact('produk_suplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produk_suplier = Produk_suplier::with(['suplier', 'material'])->find($id);
        $supliers = Suplier::all();
        $materials = Material::with('merk')->get();
        // dd($produk_suplier->suplier->nama);
        return view('produk_suplier.edit', compact('produk_suplier', 'supliers', 'materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_suplier' => 'required',
            'id_material' => 'required',
            'harga_satuan' => 'required',
            'rating' => 'required',

        ]);
        $produk_suplier = Produk_suplier::where('id', '=', $id)->first();

        $produk_suplier->update($request->all());
        return redirect()->route('produk_suplier.index')
            ->with('success', 'produk suplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk_suplier = Produk_suplier::where('id', '=', $id)->first();
        $produk_suplier->delete();
        return redirect()->route('produk_suplier.index')
            ->with('success', ' produk_suplier deleted successfully');
    }
}
