@extends('layouts.app')
@section('title', 'Laporan Bulanan')
@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-900 to-gray-800 text-gray-100">
        <div class="container mx-auto px-4 py-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Laporan Peminjaman Bulan
                        {{ now()->translatedFormat('F Y') }}</h1>
                    <p class="text-gray-400">Kelola Laporan Perpustakaan</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('laporan.bulanan.excel') }}"
                        class="mt-4 md:mt-0 bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2.5 px-5 rounded-lg flex items-center gap-2 transition-all duration-200 shadow-lg shadow-emerald-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Excel
                    </a>
                    <a href="{{ route('laporan.bulanan.pdf') }}"
                        class="mt-4 md:mt-0 bg-red-600 hover:bg-red-700 text-white font-medium py-2.5 px-5 rounded-lg flex items-center gap-2 transition-all duration-200 shadow-lg shadow-emerald-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        PDF
                    </a>
                </div>

            </div>
            <!-- Search & Filters -->
            <div class="bg-gray-800/50 rounded-xl p-5 border border-gray-700/50 mb-8 shadow-lg">
                <form action="" method="GET">
                    <div class="flex flex-col md:flex-row items-end justify-between gap-4">
                        <div class="flex gap-3">
                            <a href="{{ route('laporan.buku') }}"
                                class="bg-cyan-600 hover:bg-cyan-700 text-white font-medium py-2.5 px-5 rounded-lg transition-all duration-200 shadow-lg shadow-cyan-900/20">
                                Daftar Buku
                            </a>
                            <a href="{{ route('laporan.dipinjam') }}"
                                class="bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 px-5 rounded-lg transition-all duration-200 shadow-lg shadow-cyan-900/20">
                                Daftar Pinjaman
                            </a>
                            <a href="{{ route('laporan.terlambat') }}"
                                class="bg-red-600 hover:bg-red-700 text-white font-medium py-2.5 px-5 rounded-lg transition-all duration-200 shadow-lg shadow-cyan-900/20">
                                Buku Terlambat
                            </a>
                            <a href="{{ route('laporan.bulanan') }}"
                                class="bg-amber-600 hover:bg-amber-700 text-white font-medium py-2.5 px-5 rounded-lg transition-all duration-200 shadow-lg shadow-cyan-900/20">
                                Laporan Pinjaman Bulanan
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!--  Table -->
            <div class="bg-gray-800/50 rounded-xl border border-gray-700/50 overflow-hidden shadow-xl mb-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="">
                            <tr class="bg-gray-900/70 text-gray-400 text-sm text-center font-medium">
                                <th class="py-3 px-4">No</th>
                                <th class="py-3 px-4">Anggota</th>
                                <th class="py-3 px-4">Tanggal Pinjaman</th>
                                <th class="py-3 px-4">Tanggal Pengembalian</th>
                                <th class="py-3 px-4">Status</th>


                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800/50">
                            @forelse ($loans as $loan)
                                <tr class="hover:bg-gray-700/30 transition-colors duration-150 text-center text-sm">
                                    <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                    <td class="py-3 px-4 text-gray-300">{{ $loan->anggota->nama }}</td>
                                    <td class="py-3 px-4 text-gray-200">
                                        {{ $loan->tanggal_pinjam ? \Carbon\Carbon::parse($loan->tanggal_pinjam)->translatedFormat('d F Y') : '-' }}
                                    </td>
                                    <td class="py-3 px-4 text-gray-200">
                                        {{ $loan->tanggal_kembali ? \Carbon\Carbon::parse($loan->tanggal_kembali)->translatedFormat('d F Y') : '-' }}
                                    </td>
                                    <td class="py-3 px-4">
                                        @if ($loan->status === 'dipinjam')
                                            <span
                                                class="px-2.5 py-1 bg-amber-500/50 text-gray-300 rounded-full text-xs font-medium">
                                                {{ $loan->status }}
                                            </span>
                                        @elseif ($loan->status === 'dikembalikan')
                                            <span
                                                class="px-2.5 py-1 bg-green-500/50 text-gray-300 rounded-full text-xs font-medium">
                                                {{ $loan->status }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-600 mb-4"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <p class="text-lg">Belum ada laporan Pinjaman</p>
                                            <p class="text-sm text-gray-600 mt-1">Silakan tambah data atau ubah filter
                                                pencarian.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>



                    </table>
                </div>
            </div>


        </div>
    </div>
    <style>
        /* Custom scrollbar for webkit browsers */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(31, 41, 55, 0.5);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(75, 85, 99, 0.5);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(107, 114, 128, 0.5);
        }

        /* Table styles */
        table {
            border-collapse: separate;
            border-spacing: 0;
        }

        /* Glow effects */
        .bg-cyan-600\/20 {
            box-shadow: 0 0 10px rgba(8, 145, 178, 0.1);
        }

        .bg-rose-600\/20 {
            box-shadow: 0 0 10px rgba(225, 29, 72, 0.1);
        }

        /* Smooth transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
    </style>
@endsection
