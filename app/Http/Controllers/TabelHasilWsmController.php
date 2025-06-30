<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Rab_detail;
use App\Models\Suplier;
use App\Models\Tabel_hasil_wsm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\Parser\Handler\WhitespaceHandler;
use Yajra\DataTables\DataTables;

class TabelHasilWsmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:tabel_hasil_wsm-list|tabel_hasil_wsm-create|tabel_hasil_wsm-edit|tabel_hasil_wsm-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:tabel_hasil_wsm-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:tabel_hasil_wsm-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:tabel_hasil_wsm-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tabel_hasil_wsm = Tabel_hasil_wsm::with(['rab_detail', 'suplier', 'material'])->latest()->get();

            return DataTables::of($tabel_hasil_wsm)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (Auth::user()->can('tabel_hasil_wsm-list')) {
                    $btn = '<a href="' . route('tabel_hasil_wsm.show', $row->id) . '" class="btn btn-warning btn-sm">Show </a>';
                    }
                    // $btn .= '<a href="' . route('tabel_hasil_wsm.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                    if (Auth::user()->can('tabel_hasil_wsm-delete')) {
                    $btn .= ' <form action="' . route('tabel_hasil_wsm.destroy', $row->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus?\')">Delete</button>
                          </form>';
                    }
                    return $btn;
                })
                ->addColumn('id_suplier', function ($row) {
                    return $row->suplier->nama;
                })
                ->addColumn('id_material', function ($row) {
                    return $row->material->nama;
                })
                ->rawColumns(['action']) // Menandai kolom yang berisi HTML
                ->make(true);
        }

        return view('tabel_hasil_wsm.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rab_details = Rab_detail::all();
        $supliers = Suplier::all();
        $materials = Material::all();
        return view('tabel_hasil_wsm.create', compact('rab_details', 'supliers', 'materials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $request->validate([
                'id_rab_detail' => 'required',
                'id_suplier' => 'required',
                'id_material' => 'required',
                'jarak' => 'required',
                'rating' => 'required',
                'score' => 'required',


            ]);
            Tabel_hasil_wsm::create($request->all());
            return redirect()->route('tabel_hasil_wsm.index')
                ->with('success', ' created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tabel_hasil_wsm = Tabel_hasil_wsm::where('id', '=', $id)->first();
        return view('tabel_hasil_wsm.show', compact('tabel_hasil_wsm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rab_details = Rab_detail::all();
        $supliers = Suplier::all();
        $materials = Material::all();
        return view('tabel_hasil_wsm.edit', compact('rab_details', 'supliers', 'materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_rab_detail' => 'required',
            'id_suplier' => 'required',
            'id_material' => 'required',
            'jarak' => 'required',
            'rating' => 'required',
            'score' => 'required',
        ]);
        $tabel_hasil_wsm = Tabel_hasil_wsm::where('id', '=', $id)->first();

        $tabel_hasil_wsm->update($request->all());
        return redirect()->route('tabel_hasil_wsm.index')
            ->with('success', 'Suplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tabel_hasil_wsm = Tabel_hasil_wsm::where('id', '=', $id)->first();
        $tabel_hasil_wsm->delete();
        return redirect()->route('tabel_hasil_wsm.index')
            ->with('success', ' deleted successfully');
    }
}
