@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Laporan Buku Sedang Dipinjam</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                    @foreach ($loan->details as $detail)
                        <tr>
                            <td>{{ $loan->anggota->nama }}</td>
                            <td>{{ $detail->book->judul }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td>{{ $loan->tanggal_pinjam }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
