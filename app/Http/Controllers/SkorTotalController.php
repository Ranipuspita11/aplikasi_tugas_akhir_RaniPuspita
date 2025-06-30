<?php
namespace App\Http\Controllers;
use App\Models\Skor_total;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SkorTotalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:skor_total-list|skor_total-create|skor_total-edit|skor_total-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:skor_total-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:skor_total-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:skor_total-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $skor_total = Skor_total::latest()->get();
            return DataTables::of($skor_total)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'. route('skor_total.show', $row->id) . '" class="btn btn-warning btn-sm">Show </a>';
                    $btn.= '<a href="' . route('skor_total.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <form action="' . route('skor_total.destroy', $row->id) . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus?\')">Delete</button>
                              </form>';
                    return $btn;
                })
                ->rawColumns(['action']) // Menandai kolom yang berisi HTML
                ->make(true);
        }

        return view('skor_total.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('skor_total.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { {
            $request->validate([
                'id_material' => 'required',
                'skor_total' => 'required',

            ]);
            Skor_total::create($request->all());
            return redirect()->route('skor_total.index')
                ->with('success', ' created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $skor_total = Skor_total::where('id', '=', $id)->first();
        return view('skor_total.show', compact('skor_total'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $skor_total = Skor_total::where('id', '=', $id)->first();
        return view('skor_total.edit', compact('skor_total'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_material' => 'required',
            'skor_total' => 'required',3
        ]);
        $skor_total = Skor_total::where('id', '=', $id)->first();

        $skor_total->update($request->all());
        return redirect()->route('skor_total.index')
            ->with('success', 'Skor total updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $skor_total = Skor_total::where('id', '=', $id)->first();
        $skor_total->delete();
        return redirect()->route('skor_total.index')
            ->with('success', 'skor total deleted successfully');
    }
}
