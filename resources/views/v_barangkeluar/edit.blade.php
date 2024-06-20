@extends('layouts')

@section('konten')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Barang Keluar</div>
                    <div class="card-body">
                        <form action="{{ route('barangkeluar.update', $barangkeluar->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="tgl_keluar">Tanggal Keluar:</label>
                                <input type="date" name="tgl_keluar" class="form-control" value="{{ old('tgl_keluar', $barangkeluar->tgl_keluar) }}" required>
                                @error('tgl_keluar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="qty_keluar">Qty Keluar:</label>
                                <input type="number" name="qty_keluar" class="form-control" value="{{ old('qty_keluar', $barangkeluar->qty_keluar) }}" required>
                                @error('qty_keluar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="barang_id">Barang:</label>
                                <select name="barang_id" class="form-control" required>
                                    @foreach ($barangOptions as $barang)
                                        <option value="{{ $barang->id }}" {{ $barangkeluar->barang_id == $barang->id ? 'selected' : '' }}>{{ $barang->seri }}</option>
                                    @endforeach
                                </select>
                                @error('barang_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('barangkeluar.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
