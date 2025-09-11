<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\AnggotaRequest;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $anggota = Anggota::when($search, function ($query, $search) {
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('no_telp', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();

        return view('page.anggota.index', compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnggotaRequest $request)
    {
        try {
            $validated = $request->validated();

            $anggota = Anggota::create([
                'nama'     => $validated['nama'],
                'alamat'     => $validated['alamat'],
                'no_telp'    => $validated['no_telp'],


            ]);
            return redirect()->route('anggota.index')->with('success', 'anggota berhasil disimpan.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan anggota: ' . $e->getMessage());

            // return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan anggota.']);
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
    public function edit(string $id)
    {
        $data = Anggota::findOrFail($id);
        return view('page.anggota.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnggotaRequest $request,  $id)
    {
        $anggota = Anggota::findOrFail($id);

        $validated = $request->validated();

        $anggota->update($validated);

        return redirect()->route('anggota.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $anggota = Anggota::FindOrFail($id);

        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Data berhasil dihapus.');
    }
}
