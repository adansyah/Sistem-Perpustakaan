<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Anggota;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $buku = Book::count();
        $member = Anggota::count();
        $loan = Loan::where('status', 'dipinjam')->count();
        return view('page.dashboard', compact('buku', 'member', 'loan'));
    }
}
