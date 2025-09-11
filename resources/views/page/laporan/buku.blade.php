@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Laporan Daftar Buku</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buku as $item)
                    <tr>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->penulis }}</td>
                        <td>{{ $item->penerbit }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>{{ $item->jumlah_eksemplar }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
