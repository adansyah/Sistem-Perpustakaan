@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Laporan Peminjaman Bulan {{ now()->translatedFormat('F Y') }}</h1>

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($loans as $loan)
                    <tr>
                        <td>{{ $loan->id }}</td>
                        <td>{{ $loan->anggota->nama }}</td>
                        <td>{{ $loan->tanggal_pinjam }}</td>
                        <td>{{ $loan->tanggal_kembali ?? '-' }}</td>
                        <td>{{ ucfirst($loan->status) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada peminjaman bulan ini</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
