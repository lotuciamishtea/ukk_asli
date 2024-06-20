<?php

namespace App\Http\Controllers;

use App\Models\barangkeluar;
use App\Models\barangmasuk;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeluarController extends Controller
{
    public function index()
    {
        $Barangkeluar = barangkeluar::with('barang')->paginate(10);
        return view('v_barangkeluar.index', compact('Barangkeluar'));
    }

    public function create()
    {
        $barangOptions = Barang::all();       
        return view('v_barangkeluar.create', compact('barangOptions'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'tgl_keluar' => 'required|date',
            'qty_keluar' => 'required|integer|min:1',
            'barang_id' => 'required|exists:barang,id',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        // Cek apakah stok mencukupi
        if ($barang->stok < $request->qty_keluar) {
            return redirect()->back()->withInput()->withErrors(['qty_keluar' => 'Stok barang tidak mencukupi.']);
        }

        // Cek apakah tanggal keluar lebih awal dari tanggal barang masuk terakhir
        $barangMasukTerakhir = DB::table('barangmasuk')
            ->where('barang_id', $request->barang_id)
            ->orderBy('tgl_masuk', 'desc')
            ->first();

        if ($barangMasukTerakhir && $request->tgl_keluar < $barangMasukTerakhir->tgl_masuk) {
            return redirect()->back()->withInput()->withErrors(['tgl_keluar' => 'Tanggal keluar tidak bisa lebih awal dari tanggal barang masuk terakhir.']);
        }

        // Simpan data barang keluar ke database
        barangkeluar::create([
            'tgl_keluar' => $request->tgl_keluar,
            'qty_keluar' => $request->qty_keluar,
            'barang_id' => $request->barang_id,
        ]);

        return redirect()->route('barangkeluar.index')->with('success', 'Data barang keluar berhasil disimpan');
    }

    public function edit($id)
    {
        $barangkeluar = barangkeluar::findOrFail($id);
        $barangOptions = Barang::all();
        
        return view('v_barangkeluar.edit', compact('barangkeluar', 'barangOptions'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'tgl_keluar' => 'required|date',
            'qty_keluar' => 'required|integer|min:1',
            'barang_id' => 'required|exists:barang,id',
        ]);

        // Temukan data barang keluar berdasarkan ID
        $barangkeluar = barangkeluar::findOrFail($id);

        // Periksa apakah stok barang mencukupi sebelum update
        $barang = Barang::findOrFail($request->barang_id);
        $qty_difference = $request->qty_keluar - $barangkeluar->qty_keluar;
        if ($barang->stok < $qty_difference) {
            return redirect()->back()->withInput()->withErrors(['qty_keluar' => 'Stok barang tidak mencukupi.']);
        }

        // Cek apakah tanggal keluar lebih awal dari tanggal barang masuk terakhir
        $barangMasukTerakhir = DB::table('barangmasuk')
            ->where('barang_id', $request->barang_id)
            ->orderBy('tgl_masuk', 'desc')
            ->first();

        if ($barangMasukTerakhir && $request->tgl_keluar < $barangMasukTerakhir->tgl_masuk) {
            return redirect()->back()->withInput()->withErrors(['tgl_keluar' => 'Tanggal keluar tidak bisa lebih awal dari tanggal barang masuk terakhir.']);
        }

        // Update data barang keluar
        $barangkeluar->update([
            'tgl_keluar' => $request->tgl_keluar,
            'qty_keluar' => $request->qty_keluar,
            'barang_id' => $request->barang_id,
        ]);

        return redirect()->route('barangkeluar.index')->with('success', 'Data barang keluar berhasil diupdate');
    }

    public function destroy($id)
    {
        // Hapus data barang keluar berdasarkan ID
        barangkeluar::findOrFail($id)->delete();
        return redirect()->route('barangkeluar.index')->with('success', 'Data barang keluar berhasil dihapus!');
    }
}
