@extends('layouts') <!-- Gantilah 'layouts.app' dengan layout yang sesuai -->

@section('konten')
<div class="container">
        <div class="row">
            <div class="col-md-12">
		<div class="pull-left">
		    <h2>Daftar Barang Masuk</h2>
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

                        <a href="{{ route('barangmasuk.create') }}" class="btn btn-primary mb-2">Tambah Barang Masuk</a>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Quantity Masuk</th>
                                    <th>Barang</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Barangmasuk as $barangmasuk)
                                    <tr>
                                        <td>{{ $barangmasuk->id }}</td>
                                        <td>{{ $barangmasuk->tgl_masuk }}</td>
                                        <td>{{ $barangmasuk->qty_masuk }}</td>
                                        <td>{{ $barangmasuk->barang->seri }}</td>
                                        <td>
                                            <a href="{{ route('barangmasuk.edit', $barangmasuk->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                            <!-- Form untuk handle delete -->
                                            <form action="{{ route('barangmasuk.destroy', $barangmasuk->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $Barangmasuk->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
