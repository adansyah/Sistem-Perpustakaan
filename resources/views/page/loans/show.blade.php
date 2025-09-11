@extends('layouts.app')

@section('content')
    {{-- <div class="container">
        <h1>Detail Peminjaman</h1>

        <table class="table">
            <tr>
                <th>Anggota</th>
                <td>{{ $loan->anggota->nama }}</td>
            </tr>
            <tr>
                <th>Tanggal Pinjam</th>
                <td>{{ $loan->tanggal_pinjam }}</td>
            </tr>
            <tr>
                <th>Tanggal Kembali</th>
                <td>{{ $loan->tanggal_kembali }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $loan->status }}</td>
            </tr>
            <tr>
                <th>Denda</th>
                <td>Rp {{ number_format($loan->denda, 0, ',', '.') }}</td>
            </tr>
        </table>

        <h3>Detail Buku</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loan->Details as $detail)
                    <tr>
                        <td>{{ $detail->book->judul ?? '-' }}</td>
                        <td>{{ $detail->jumlah }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('loans.index') }}" class="btn btn-secondary">Kembali</a>

    </div> --}}
    <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl border border-gray-700/50 shadow-xl overflow-hidden">
        <div class=" flex p-4 border-b border-gray-700/50">
            <h3 class="text-md font-semibold text-white flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
                Detail Peminjaman
            </h3>


        </div>
        <div class="p-4">
            <div class="flex items-center mb-4">
                Anggota : {{ $loan->anggota->nama }}
            </div>
            <div class="flex items-center mb-4">
                Tanggal Pinjam : {{ $loan->tanggal_pinjam }}
            </div>
            <div class="flex items-center mb-4">
                Tanggal Kembali : {{ $loan->tanggal_kembali }}
            </div>
            <div class="flex items-center mb-4">
                Status : {{ $loan->status }}
            </div>
            <div class="flex items-center mb-4">
                Denda : Rp {{ number_format($loan->denda, 0, ',', '.') }}
            </div>
            <div class="pt-3 border-t border-gray-700/50">
                <a href="{{ route('loans.index') }}" class="text-grey-400 hover:text-grey-300 text-sm flex items-center">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-4 w-4 mr-1" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                    </svg>

                    Kembali
                </a>
            </div>
        </div>

    </div>

    </div>
    </div>
@endsection
