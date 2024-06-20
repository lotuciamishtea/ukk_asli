@extends('layouts')

@section('konten')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Barang Keluar</div>
                    <div class="card-body">
                        <!-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif -->

                        <form action="{{ route('barangkeluar.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="tgl_keluar">Tanggal Keluar:</label>
                                <input type="date" name="tgl_keluar" class="form-control" value="{{ old('tgl_keluar') }}" required>
                                @error('tgl_keluar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="qty_keluar">Jumlah Keluar:</label>
                                <input type="number" name="qty_keluar" class="form-control" value="{{ old('qty_keluar') }}" required>
                                @error('qty_keluar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="barang_id">Barang:</label>
                                <select name="barang_id" class="form-control" required>
                                    <option value="" selected disabled>Pilih Barang</option>
                                    @foreach ($barangOptions as $barang)
                                        <option value="{{ $barang->id }}" {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                            {{ $barang->merk }} - {{ $barang->seri }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('barang_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a class="btn btn-secondary" href="{{ route('barangkeluar.index') }}">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
