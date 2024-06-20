@extends('layouts')

@section('konten')
<div class="container">
        <div class="row">
            <div class="col-md-12">
		<div class="pull-left">
		    <h2>Daftar Barang Keluar</h2>
		</div>
                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('Gagal'))
                            <div class="alert alert-danger mt-3">
                                {{ session('Gagal') }}
                            </div>
                        @endif

                        <a href="{{ route('barangkeluar.create') }}" class="btn btn-primary mb-2">Tambah Barang Keluar</a>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal Keluar</th>
                                    <th>Qty Keluar</th>
                                    <th>Nama Barang</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Barangkeluar as $barangkeluar)
                                    <tr>
                                        <td>{{ $barangkeluar->id }}</td>
                                        <td>{{ $barangkeluar->tgl_keluar }}</td>
                                        <td>{{ $barangkeluar->qty_keluar }}</td>
                                        <td>{{ $barangkeluar->barang->seri }}</td>
                                        <td>
                                            <a href="{{ route('barangkeluar.edit', $barangkeluar->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                            <!-- Form untuk handle delete -->
                                            <form action="{{ route('barangkeluar.destroy', $barangkeluar->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $Barangkeluar->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection