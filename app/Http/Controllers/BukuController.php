<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BukuRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $buku = Book::when($search, function ($query, $search) {
            $query->where('judul', 'like', "%{$search}%")
                ->orWhere('penulis', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();

        return view('page.buku.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BukuRequest $request)
    {
        try {
            $validated = $request->validated();

            if ($request->hasFile('file')) {
                $file      = $request->file('file');
                $fileName  = time() . '-' . $file->getClientOriginalName();
                $filePath  = $file->storeAs('buku', $fileName, 'public');
            }

            $buku = Book::create([
                'judul'     => $validated['judul'],
                'penulis'     => $validated['penulis'],
                'penerbit'    => $validated['penerbit'],
                'tahun'  => $validated['tahun'],
                'kategori'       => $validated['kategori'],
                'rating'       => $validated['rating'],
                'jumlah_eksemplar' => $validated['jumlah_eksemplar'],
                'file'         => $filePath ?? null,

            ]);
            return redirect()->route('buku.index')->with('success', 'Buku berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan Buku: ' . $e->getMessage());

            // return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan Buku.']);
            dd($e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Book::findOrFail($id);
        return view('page.buku.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BukuRequest $request,  $id)
    {
        $buku = Book::findOrFail($id);

        $validated = $request->validated();

        if ($request->hasFile('file')) {
            if ($buku->file && Storage::disk('public')->exists($buku->file)) {
                Storage::disk('public')->delete($buku->file);
            }

            $file = $request->file('file');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $validated['file'] = $file->storeAs('buku', $fileName, 'public');
        }

        $buku->update($validated);

        return redirect()->route('buku.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $buku = Book::FindOrFail($id);

        if ($buku->file && Storage::disk('public')->exists($buku->file)) {
            Storage::disk('public')->delete($buku->file);
        }

        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Data berhasil dihapus.');
    }
}
