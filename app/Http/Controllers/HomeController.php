<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Mengambil data sentimen dari tabel Dataset
        $sentiments = Dataset::select('sentiment', DB::raw('count(*) as total'))
            ->groupBy('sentiment')
            ->get();

        // Mengubah hasil query menjadi format yang sesuai untuk ditampilkan di chart
        $countEverySentiment = [];
        foreach ($sentiments as $sentiment) {
            $countEverySentiment[$sentiment->sentiment] = $sentiment->total;
        }
        
        // Mengirimkan data ke tampilan
        return view('admin.dashboard', compact('countEverySentiment'));
    }
}
