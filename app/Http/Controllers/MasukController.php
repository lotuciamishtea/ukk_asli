<?php

namespace App\Http\Controllers;

use App\Models\barangmasuk;
use App\Models\barangkeluar;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasukController extends Controller
{
    public function index()
    {
        $Barangmasuk = barangmasuk::with('barang')->paginate(10);
        return view('v_barangmasuk.index', compact('Barangmasuk'));
    }

    public function create()
    {
        $barangOptions = Barang::all();
        return view('v_barangmasuk.create', compact('barangOptions'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'tgl_masuk' => 'required',
            'qty_masuk' => 'required',
            'barang_id' => 'required',
        ]);

        // Simpan data barang masuk ke database
        barangmasuk::create([
            'tgl_masuk' => $request->tgl_masuk,
            'qty_masuk' => $request->qty_masuk,
            'barang_id' => $request->barang_id,
        ]);

        return redirect()->route('barangmasuk.index')->with('success', 'Data barang masuk berhasil ditambah');
    }

    public function edit($id)
    {
        // Mengambil data barang masuk berdasarkan ID
        $rsetBarangmasuk = barangmasuk::findOrFail($id);
        $baranggOptions = Barang::all();

        return view('v_barangmasuk.edit', compact('rsetBarangmasuk', 'baranggOptions'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'tgl_masuk' => 'required',
            'qty_masuk' => 'required',
            'barang_id' => 'required',
        ]);

        // Mengupdate data barang masuk berdasarkan ID
        $rsetBarangmasuk = barangmasuk::findOrFail($id);
        $rsetBarangmasuk->update([
            'tgl_masuk' => $request->tgl_masuk,
            'qty_masuk' => $request->qty_masuk,
            'barang_id' => $request->barang_id,
        ]);

        return redirect()->route('barangmasuk.index')->with('success', 'Data barang masuk berhasil diupdate');
    }

    public function destroy($id)
    {
        // Cek apakah ada barang keluar terkait dengan barang masuk yang akan dihapus
        $barangKeluarTerkait = barangkeluar::where('barang_id', function ($query) use ($id) {
            $query->select('barang_id')
                  ->from('barangmasuk')
                  ->where('id', $id);
        })->exists();

        if ($barangKeluarTerkait) {
            return redirect()->route('barangmasuk.index')->with('Gagal', 'Data barang masuk tidak dapat dihapus karena barang sudah dikeluarkan.');
        }

        // Jika tidak ada barang keluar terkait, hapus barang masuk
        barangmasuk::findOrFail($id)->delete();
        return redirect()->route('barangmasuk.index')->with('success', 'Data barang masuk berhasil dihapus!');
    }
}
