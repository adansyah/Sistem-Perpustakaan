<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Anggota;
use App\Models\LoanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['anggota', 'Details.book'])->latest()->paginate(10);
        return view('page.loans.index', compact('loans'));
    }

    public function create()
    {
        $anggota = Anggota::all();
        $books   = Book::all();
        return view('page.loans.create', compact('anggota', 'books'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'anggota_id'       => 'required|exists:anggotas,id',
            'tanggal_pinjam'   => 'required|date',
            'tanggal_kembali'  => 'nullable|date|after_or_equal:tanggal_pinjam',
            'book_id'          => 'required|array',
            'book_id.*'        => 'exists:books,id',
            'jumlah'           => 'required|array',
            'jumlah.*'         => 'integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            // Buat loan
            $loan = Loan::create([
                'anggota_id'      => $validated['anggota_id'],
                'tanggal_pinjam'  => $validated['tanggal_pinjam'],
                'tanggal_kembali' => $validated['tanggal_kembali'],
                'status'          => 'dipinjam',
            ]);

            foreach ($validated['book_id'] as $index => $bookId) {
                $jumlah = $validated['jumlah'][$index];
                $book   = Book::findOrFail($bookId);

                if ($book->jumlah_eksemplar < $jumlah) {
                    // Batalkan semua proses
                    DB::rollBack();
                    return redirect()->route('loans.index')
                        ->with('error', "Stok buku '{$book->judul}' tidak mencukupi.");
                }

                // Kurangi stok
                $book->decrement('jumlah_eksemplar', $jumlah);

                LoanDetail::create([
                    'loan_id' => $loan->id,
                    'book_id' => $bookId,
                    'jumlah'  => $jumlah,
                ]);
            }

            DB::commit();
            return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('loans.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }




    public function show($id)
    {
        $loan = Loan::with(['anggota', 'Details.book'])->findOrFail($id);
        return view('page.loans.show', compact('loan'));
    }

    public function edit($id)
    {
        $loan = Loan::with('Details.book')->findOrFail($id);
        $anggotas = Anggota::all();
        $books = Book::all();

        return view('page.loans.edit', compact('loan', 'anggotas', 'books'));
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        if (strtolower($loan->status) === 'dikembalikan') {
            return back()->with('error', 'Buku sudah dikembalikan.');
        }

        $tanggalKembali = now();

        $batasWaktu = \Carbon\Carbon::parse($loan->tanggal_pinjam)->addDays(7);

        $terlambat = $tanggalKembali->gt($batasWaktu)
            ? $tanggalKembali->diffInDays($batasWaktu)
            : 0;

        $dendaPerHari = 5000;
        $denda = $terlambat * $dendaPerHari;

        $loan->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => $tanggalKembali,
            'denda' => $denda,
        ]);

        foreach ($loan->Details as $detail) {
            $detail->book->jumlah_eksemplar += $detail->jumlah;
            $detail->book->save();
        }

        return redirect()->route('loans.index')
            ->with('success', 'Buku berhasil dikembalikan. Denda: Rp ' . number_format($denda, 0, ',', '.'));
    }




    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Transaksi peminjaman berhasil dihapus.');
    }
}
