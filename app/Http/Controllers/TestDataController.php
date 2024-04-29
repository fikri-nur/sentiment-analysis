<?php

namespace App\Http\Controllers;

use App\Models\TestData;
use App\Http\Requests\StoreTestDataRequest;
use App\Http\Requests\UpdateTestDataRequest;
use App\Models\Preprocessing;

class TestDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testDatas = TestData::all();
        $preprocessings = Preprocessing::all();
        // Periksa apakah stemmed text kosong atau tidak
        $stemmedTextEmpty = true;
        foreach ($preprocessings as $preprocessing) {
            if ($preprocessing->stemmed_text != null) {
                $stemmedTextEmpty = false; 
                break;
            }
        }
        return view('admin.pages.test-data.index', compact('testDatas', 'stemmedTextEmpty'));
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
    public function store(StoreTestDataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TestData $testData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TestData $testData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestDataRequest $request, TestData $testData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestData $testData)
    {
        //
    }
}
