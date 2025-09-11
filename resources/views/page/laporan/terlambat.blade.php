@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Laporan Buku Terlambat Dikembalikan</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Batas Waktu</th>
                    <th>Hari Terlambat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                    @foreach ($loan->Details as $detail)
                        @php
                            $batas = \Carbon\Carbon::parse($loan->tanggal_pinjam)->addDays(7);
                            $hariTerlambat = now()->diffInDays($batas, false) < 0 ? now()->diffInDays($batas) : 0;
                        @endphp
                        <tr>
                            <td>{{ $loan->anggota->nama }}</td>
                            <td>{{ $detail->book->judul }}</td>
                            <td>{{ $loan->tanggal_pinjam }}</td>
                            <td>{{ $batas->toDateString() }}</td>
                            <td>{{ $hariTerlambat }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
