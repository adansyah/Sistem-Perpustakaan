@extends('layouts.app')
@section('title', 'Data Pinjaman')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-900 to-gray-800 text-gray-100">
        <div class="container mx-auto px-4 py-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Data Peminjaman</h1>
                    <p class="text-gray-400">Kelola Data Pinjaman</p>
                </div>
                <a href="{{ route('loans.create') }}"
                    class="mt-4 md:mt-0 bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2.5 px-5 rounded-lg flex items-center gap-2 transition-all duration-200 shadow-lg shadow-emerald-900/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Pinjaman
                </a>
            </div>



            <!-- Notifications -->
            @if (session('success'))
                <div
                    class="bg-emerald-900/50 border-l-4 border-emerald-500 text-emerald-200 p-4 mb-6 rounded-r-lg flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-emerald-400 flex-shrink-0"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-rose-900/50 border-l-4 border-rose-500 text-rose-200 p-4 mb-6 rounded-r-lg flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-rose-400 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Table -->
            <div class="bg-gray-800/50 rounded-xl border border-gray-700/50 overflow-hidden shadow-xl mb-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="">
                            <tr class="bg-gray-900/70 text-gray-400 text-sm text-center font-medium">
                                <th class="py-3 px-4">No</th>
                                <th class="py-3 px-4">Anggota</th>
                                <th class="py-3 px-4">Buku</th>
                                <th class="py-3 px-4">Tanggal Pinjam</th>
                                <th class="py-3 px-4">Tanggal Kembali</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4">Action</th>

                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800/50">
                            @forelse ($loans as $item)
                                <tr class="hover:bg-gray-700/30 transition-colors duration-150 text-center text-sm">
                                    <td class="py-3 px-4">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="py-3 px-4 text-gray-300">{{ $item->anggota->nama }}</td>
                                    <td class="py-3 px-4 text-gray-300">
                                        {{ $item->details->pluck('book.judul')->implode(', ') }}</td>
                                    <td class="py-3 px-4 text-gray-200 font-medium">
                                        {{ $item->tanggal_pinjam ? \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d F Y') : '-' }}
                                    </td>
                                    <td class="py-3 px-4">
                                        {{ $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d F Y') : '-' }}
                                    </td>
                                    <td class="py-3 px-4">
                                        @if (ucfirst($item->status === 'dipinjam'))
                                            <span
                                                class="px-2.5 py-1 bg-amber-500/50 text-gray-300 rounded-full text-xs font-medium">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        @elseif (ucfirst($item->status === 'dikembalikan'))
                                            <span
                                                class="px-2.5 py-1 bg-green-500/50 text-gray-300 rounded-full text-xs font-medium">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-2 flex gap-2">
                                        <a href="{{ route('loans.show', $item->id) }}"
                                            class="p-2 bg-cyan-600/20 hover:bg-cyan-600/40 text-cyan-400 hover:text-cyan-300 rounded-lg transition-colors"
                                            title="Edit">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>

                                        </a>
                                        @if ($item->status == 'dipinjam')
                                            <form action="{{ route('loans.update', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Anda ingin kembalikan buku ini?');"
                                                class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="p-2 bg-amber-600/20 hover:bg-amber-600/40 text-amber-400 hover:text-amber-300 rounded-lg transition-colors"
                                                    title="Delete">

                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-5 w-5"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                                                    </svg>

                                                </button>
                                            </form>
                                        @endif


                                        <form action="{{ route('loans.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Apa Anda Yakin Ingin Menghapus Data Ini?');"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 bg-rose-600/20 hover:bg-rose-600/40 text-rose-400 hover:text-rose-300 rounded-lg transition-colors"
                                                title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="py-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                class="h-12 w-12 text-gray-600 mb-4" stroke-width="1.5"
                                                stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                            </svg>

                                            <p class="text-lg">Belum ada Transaksi</p>
                                            <p class="text-sm text-gray-600 mt-1">Try adjusting your search criteria or add
                                                a new transaction</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex flex-wrap items-center justify-between px-4 py-2 text-sm text-gray-300">
                <div>
                    Menampilkan {{ $loans->firstItem() }} - {{ $loans->lastItem() }} dari
                    {{ $loans->total() }} data
                </div>

                <div class="flex gap-10">
                    {{ $loans->links('vendor.pagination.tailwind') }}
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
