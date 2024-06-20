@extends('layouts') <!-- Assuming you have a layout named 'app.blade.php' -->

@section('konten')
<div class="container">
        <div class="row">
            <div class="col-md-12">
		<div class="pull-left">
		    <h2>Daftar Kategori</h2>
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

                        <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-2">Tambah Kategori</a>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Deskripsi</th>
                                    <th>Kategori</th>
                                    <th>Kode</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rsetKategori as $kategori)
                                    <tr>
                                        <td>{{ $kategori->id }}</td>
                                        <td>{{ $kategori->deskripsi }}</td>
                                        <td>{{ $kategori->ketKategori }}</td>
                                        <td>{{ $kategori->kategori }}</td>
                                        <td>
                                            <a href="{{ route('kategori.show', $kategori->id) }}" class="btn btn-info btn-sm">Detail</a>
                                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            
                                            <!-- Form untuk handle delete -->
                                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $rsetKategori->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection