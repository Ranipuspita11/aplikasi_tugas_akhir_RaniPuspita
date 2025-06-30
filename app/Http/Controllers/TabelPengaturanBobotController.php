<?php

namespace App\Http\Controllers;

use App\Models\Tabel_pengaturan_bobot;
use Illuminate\Http\Request;
use Laravel\Prompts\Table;
use Yajra\DataTables\DataTables;

class TabelPengaturanBobotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
{
    $this->middleware('permission:tabel_pengaturan_bobot-list|tabel_pengaturan_bobot-create|tabel_pengaturan_bobot-edit|tabel_pengaturan_bobot-delete', ['only' => ['index', 'store']]);
    $this->middleware('permission:tabel_pengaturan_bobot-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:tabel_pengaturan_bobot-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:tabel_pengaturan_bobot-delete', ['only' => ['destroy']]);
}


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tabel_pengaturan_bobot= Tabel_pengaturan_bobot::latest()->get();
            return DataTables::of($tabel_pengaturan_bobot)
                ->addIndexColumn()
                // ->addColumn('action', function ($row) {
                //     // $btn = '<a href="' . route('tabel_pengaturan_bobot.show', $row->id) . '" class="btn btn-warning btn-sm">Show</a>';
                //     // $btn .= '<a href="' . route('tabel_pengaturan_bobot.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                //     // $btn .= '<form action="' . route('tabel_pengaturan_bobot.destroy', $row->id) . '" method="POST" style="display:inline;">
                //     //             ' . csrf_field() . '
                //     //             ' . method_field('DELETE') . '
                //     //             <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus?\')">Delete</button>
                //     //          </form>';
                //     return $btn;
                // })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('tabel_pengaturan_bobot.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tabel_pengaturan_bobot.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bobot_harga' => 'required',
            'bobot_jarak' => 'required',
            'bobot_rating' => 'required',
        ]);

        Tabel_pengaturan_bobot::create($request->all());
        return redirect()->route('tabel_pengaturan_bobot.index')
            ->with('success', 'Pengaturan bobot berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tabel_pengaturan_bobot = Tabel_pengaturan_bobot::findOrFail($id);
        return view('tabel_pengaturan_bobot.show', compact('tabel_pengaturan_bobot'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tabel_pengaturan_bobot = Tabel_pengaturan_bobot::findOrFail($id);
        return view('tabel_pengaturan_bobot.edit', compact('tabel_pengaturan_bobot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'bobot_harga' => 'required',
            'bobot_jarak' => 'required',
            'bobot_rating' => 'required',
        ]);

        $tabel_pengaturan_bobot = Tabel_pengaturan_bobot::findOrFail($id);
        $tabel_pengaturan_bobot->update($request->all());

        return redirect()->route('tabel_pengaturan_bobot.index')
            ->with('success', 'Pengaturan bobot berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tabel_pengaturan_bobot = Tabel_pengaturan_bobot::findOrFail($id);
        $tabel_pengaturan_bobot->delete();

        return redirect()->route('tabel_pengaturan_bobot.index')
            ->with('success', 'Pengaturan bobot berhasil dihapus.');
    }
}
