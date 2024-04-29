<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use Illuminate\Http\Request;
use App\Imports\DatasetsImport;
use App\Models\Preprocessing;
use App\Models\TestData;
use App\Models\TfIdf;
use App\Models\TrainData;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DatasetController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function import()
    {
        Excel::import(new DatasetsImport, request()->file('file'));
        return redirect()->back()->with('success', 'Import successful');
    }

    public function index()
    {
        $datasets = Dataset::all();
        return view('admin.pages.dataset.index', compact('datasets'));
    }

    public function clearAll()
    {
        // Nonaktifkan pengecekan kunci asing
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Hapus data dari tabel train_data dan test_data terlebih dahulu
        TrainData::truncate();
        TestData::truncate();
        // Hapus data dari tabel tfidf terlebih dahulu
        TfIdf::truncate();
        
        // Hapus data dari tabel preprocessings terlebih dahulu
        Preprocessing::truncate();
        
        // Setelah itu, hapus semua data dari tabel datasets
        Dataset::truncate();

        // Aktifkan kembali pengecekan kunci asing
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Pengecekan table
        if (Dataset::count() == 0 && Preprocessing::count() == 0) {
            return redirect()->route('datasets.index')->with('warning', 'Seluruh data berhasil dihapus.');
        } else {
            return redirect()->route('datasets.index')->with('danger', 'Gagal menghapus seluruh data.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dataset $dataset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dataset $dataset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dataset $dataset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dataset $dataset)
    {
        //
    }
}
