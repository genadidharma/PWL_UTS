<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $list_barang = Barang::where([
            ['kode_barang', '!=', null, 'OR', 'nama_barang', '!=', null, 'OR', 'kategori_barang', '!=', null],
            [function ($query) use ($request) {
                if (($keyword = $request->keyword)) {
                    $query->orWhere('kode_barang', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('nama_barang', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('kategori_barang', 'LIKE', '%' . $keyword . '%')->get();
                }
            }]
        ])
            ->orderBy('id_barang', 'desc')
            ->paginate(5);

        return view('barang.index', compact('list_barang'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi request
        $request->validate([
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'harga' => 'required|numeric',
            'qty' => 'required|numeric',
        ]);

        Barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_barang)
    {
        $barang = Barang::find($id_barang);
        $next = Barang::where('id_barang', '<', $id_barang)->orderBy('id_barang', 'desc')->first();
        $prev = Barang::where('id_barang', '>', $id_barang)->orderBy('id_barang')->first();
        return view('barang.show', compact('barang', 'next', 'prev'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_barang)
    {
        $barang = Barang::find($id_barang);
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
            'harga' => 'required|numeric',
            'qty' => 'required|numeric',
        ]);

        Barang::find($id_barang)->update($request->all());
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_barang)
    {
        Barang::find($id_barang)->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
