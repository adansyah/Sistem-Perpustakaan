@extends('layouts.app')
@section('title', 'Detail Peminjaman')
@section('content')
    <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl border border-gray-700/50 shadow-xl overflow-hidden">
        <div class=" flex p-4 border-b border-gray-700/50">
            <h3 class="text-md font-semibold text-white flex items-center gap-2">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-5 w-5 text-cyan-400" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9" />
                </svg>

                Detail Peminjaman
            </h3>
        </div>
        <div class="p-4">
            <div class="flex items-center mb-4">
                Anggota : {{ $loan->anggota->nama }}
            </div>
            <div class="flex items-center mb-4">
                Tanggal Pinjam :
                {{ $loan->tanggal_pinjam ? \Carbon\Carbon::parse($loan->tanggal_pinjam)->translatedFormat('d F Y') : '-' }}
            </div>
            <div class="flex items-center mb-4">
                Tanggal Kembali :
                {{ $loan->tanggal_kembali ? \Carbon\Carbon::parse($loan->tanggal_kembali)->translatedFormat('d F Y') : '-' }}
            </div>
            <div class="flex items-center mb-4 gap-2">
                Status : @if ($loan->status === 'dipinjam')
                    <span class=" px-2.5 py-1 bg-amber-500/50 text-gray-300 rounded-full text-xs font-medium">
                        {{ $loan->status }}
                    </span>
                @elseif ($loan->status === 'dikembalikan')
                    <span class="px-2.5 py-1 bg-green-500/50 text-gray-300 rounded-full text-xs font-medium">
                        {{ $loan->status }}
                    </span>
                @endif
            </div>
            <div class="flex items-center mb-4">
                Denda : Rp {{ number_format(abs($loan->denda), 0, ',', '.') }}
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
