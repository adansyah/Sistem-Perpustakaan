@extends('layouts.app')

@section('title', 'Input Data anggota')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-900 to-gray-800 text-gray-100">
        <div class="container mx-auto px-4 py-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Input Data Anggota</h1>
                    <p class="text-gray-400">Tambahkan Data Anggota ke dalam sistem</p>
                </div>
                <a href="{{ route('anggota.index') }}"
                    class="mt-4 md:mt-0 bg-gray-700 hover:bg-gray-600 text-white font-medium py-2.5 px-5 rounded-lg flex items-center gap-2 transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Kembali
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

            @if ($errors->any())
                <div class="bg-rose-900/50 border-l-4 border-rose-500 text-rose-200 p-4 mb-6 rounded-r-lg">
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-rose-400 flex-shrink-0"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="font-medium">Please correct the following errors:</span>
                    </div>
                    <ul class="mt-2 ml-9 list-disc text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif (session('error'))
                <div class="bg-rose-900/50 border-l-4 border-rose-500 text-rose-200 p-4 mb-6 rounded-r-lg flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3 text-rose-400 flex-shrink-0" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Form Card -->
            <div
                class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl border border-gray-700/50 shadow-xl overflow-hidden mb-8">
                <div class="p-6 border-b border-gray-700/50">
                    <h2 class="text-xl font-semibold text-white flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Informasi anggota
                    </h2>
                </div>

                <form action="{{ route('anggota.update', $data->id) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="grid  gap-6">
                        <!-- Left Column -->
                        <div class="space-y-6">


                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-300 mb-1">nama
                                    <span class="text-rose-400">*</span></label>
                                <input type="text" id="nama" name="nama" value="{{ $data->nama }}" required
                                    class="w-full px-4 py-2.5 bg-gray-900/70 border border-gray-700/50 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-transparent transition-all duration-200"
                                    placeholder="Masukan nama">
                                @error('nama')
                                    <p class="mt-1 text-sm text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="alamat" class="block text-sm font-medium text-gray-300 mb-1">alamat <span
                                        class="text-rose-400">*</span></label>
                                <input type="text" id="alamat" name="alamat" value="{{ $data->alamat }}" required
                                    class="w-full px-4 py-2.5 bg-gray-900/70 border border-gray-700/50 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-transparent transition-all duration-200"
                                    placeholder="alamat ">
                                @error('alamat')
                                    <p class="mt-1 text-sm text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="no_telp" class="block text-sm font-medium text-gray-300 mb-1">No
                                    Telepon</label> <span class="text-rose-400">*</span></label>
                                <input type="number" id="no_telp" name="no_telp" value="{{ $data->no_telp }}" required
                                    class="w-full px-4 py-2.5 bg-gray-900/70 border border-gray-700/50 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-cyan-500/50 focus:border-transparent transition-all duration-200"
                                    placeholder="no_telp ">
                                @error('no_telp')
                                    <p class="mt-1 text-sm text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-700/50 flex flex-wrap gap-3">
                        <button type="submit"
                            class="bg-cyan-600 hover:bg-cyan-700 text-white font-medium py-2.5 px-6 rounded-lg transition-all duration-200 shadow-lg shadow-cyan-900/20 flex items-center gap-2">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-5 w-5" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>

                            Simpan
                        </button>
                        <a href="{{ route('anggota.index') }}"
                            class="bg-gray-700 hover:bg-gray-600 text-white font-medium py-2.5 px-6 rounded-lg transition-all duration-200 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Batal
                        </a>
                    </div>
                </form>
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

        /* File input styling */
        input[type="file"]::file-selector-button {
            border: none;
            background: #374151;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            color: white;
            cursor: pointer;
            transition: background 0.2s ease-in-out;
        }

        input[type="file"]::file-selector-button:hover {
            background: #4B5563;
        }

        /* Smooth transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
    </style>

    <script>
        // Preview uploaded image
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('file');

            if (imageInput) {
                imageInput.addEventListener('change', function(e) {
                    if (e.target.files && e.target.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            // You could add image preview functionality here
                            console.log('Image loaded:', e.target.result);
                        }
                        reader.readAsDataURL(e.target.files[0]);
                    }
                });
            }
        });
    </script>
@endsection
