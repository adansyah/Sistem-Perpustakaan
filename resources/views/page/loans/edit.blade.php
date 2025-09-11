@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-gray-900 text-white p-6 rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Edit Peminjaman</h2>

        <form action="{{ route('loans.update', $loan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Anggota -->
            <div class="mb-4">
                <label for="anggota_id" class="block mb-1">Anggota</label>
                <select name="anggota_id" id="anggota_id" class="w-full text-black p-2 rounded">
                    @foreach ($anggotas as $anggota)
                        <option value="{{ $anggota->id }}" {{ $loan->anggota_id == $anggota->id ? 'selected' : '' }}>
                            {{ $anggota->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal Pinjam -->
            <div class="mb-4">
                <label for="tanggal_pinjam" class="block mb-1">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" value="{{ $loan->tanggal_pinjam }}"
                    class="w-full text-black p-2 rounded">
            </div>

            <!-- Tanggal Kembali -->
            <div class="mb-4">
                <label for="tanggal_kembali" class="block mb-1">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" value="{{ $loan->tanggal_kembali }}"
                    class="w-full text-black p-2 rounded">
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block mb-1">Status</label>
                <select name="status" id="status" class="w-full text-black p-2 rounded">
                    <option value="dipinjam" {{ old('status', $loan->status) == 'dipinjam' ? 'selected' : '' }}>
                        dipinjam</option>
                    <option value="dikembalikan" {{ old('status', $loan->status) == 'dikembalikan' ? 'selected' : '' }}>
                        dikembalikan</option>
                </select>
            </div>

            <!-- Denda -->
            <div class="mb-4">
                <label for="denda" class="block mb-1">Denda</label>
                <input type="number" name="denda" value="{{ $loan->denda }}" class="w-full text-black p-2 rounded">
            </div>

            <!-- Detail Buku -->
            <div class="mb-4">
                <h3 class="font-bold mb-2">Buku yang Dipinjam</h3>
                @foreach ($books as $book)
                    @php
                        $detail = $loan->Details->where('book_id', $book->id)->first();
                    @endphp
                    <div class="flex items-center gap-2 mb-2">
                        <label class="w-1/2">{{ $book->judul }}</label>
                        <input type="number" name="books[{{ $book->id }}]" value="{{ $detail->jumlah ?? 0 }}"
                            class="w-1/2 text-black p-2 rounded">
                    </div>
                @endforeach
            </div>

            <button type="submit" class="bg-blue-600 px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('loans.index') }}" class="bg-gray-600 px-4 py-2 rounded">Batal</a>
        </form>
    </div>
@endsection
