@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Laporan Perpustakaan</h1>

        <!-- Tabs -->
        <ul class="nav nav-tabs mt-3" id="laporanTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#daftarBuku">Daftar Buku</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#sedangDipinjam">Buku Dipinjam</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#terlambat">Buku Terlambat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#bulanan">Peminjaman Bulanan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tahunan">Peminjaman Tahunan</a>
            </li>
        </ul>

        <!-- Content -->
        <div class="tab-content mt-3">
            <!-- Daftar Buku -->
            <div class="tab-pane fade show active" id="daftarBuku">
                <h3>Daftar Buku</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Jumlah Eksemplar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarBuku as $buku)
                            <tr>
                                <td>{{ $buku->id }}</td>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->penulis }}</td>
                                <td>{{ $buku->jumlah_eksemplar }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Buku Dipinjam -->
            <div class="tab-pane fade" id="sedangDipinjam">
                <h3>Buku Sedang Dipinjam</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Peminjaman</th>
                            <th>Nama Anggota</th>
                            <th>Tanggal Pinjam</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sedangDipinjam as $loan)
                            <tr>
                                <td>{{ $loan->id }}</td>
                                <td>{{ $loan->anggota->nama }}</td>
                                <td>{{ $loan->tanggal_pinjam }}</td>
                                <td>{{ ucfirst($loan->status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada buku dipinjam</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Buku Terlambat -->
            <div class="tab-pane fade" id="terlambat">
                <h3>Buku Terlambat</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Peminjaman</th>
                            <th>Nama Anggota</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($terlambat as $loan)
                            <tr>
                                <td>{{ $loan->id }}</td>
                                <td>{{ $loan->anggota->nama }}</td>
                                <td>{{ $loan->tanggal_pinjam }}</td>
                                <td>{{ $loan->tanggal_kembali ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada buku terlambat</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Peminjaman Bulanan -->
            <div class="tab-pane fade" id="bulanan">
                <h3>Peminjaman Bulan {{ now()->translatedFormat('F Y') }}</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Anggota</th>
                            <th>Tanggal Pinjam</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bulanan as $loan)
                            <tr>
                                <td>{{ $loan->id }}</td>
                                <td>{{ $loan->anggota->nama }}</td>
                                <td>{{ $loan->tanggal_pinjam }}</td>
                                <td>{{ ucfirst($loan->status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada peminjaman bulan ini</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection
