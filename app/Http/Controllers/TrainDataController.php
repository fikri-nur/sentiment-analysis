<?php

namespace App\Http\Controllers;

use App\Models\TrainData;
use App\Http\Requests\StoreTrainDataRequest;
use App\Http\Requests\UpdateTrainDataRequest;
use App\Models\Preprocessing;

class TrainDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index70()
    {
        $trainDatas = TrainData::all();
        $preprocessings = Preprocessing::all();
        // Periksa apakah stemmed text kosong atau tidak
        $stemmedTextEmpty = true;
        foreach ($preprocessings as $preprocessing) {
            if ($preprocessing->stemmed_text != null) {
                $stemmedTextEmpty = false; 
                break;
            }
        }
        return view('admin.pages.train-data.index', compact('trainDatas', 'stemmedTextEmpty'));
    }

    public function index80(){
        return ('Train data 80 persen');
    }

    public function index90(){
        return ('Train data 90 persen');
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
    public function store(StoreTrainDataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainData $trainData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainData $trainData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainDataRequest $request, TrainData $trainData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainData $trainData)
    {
        //
    }
}
