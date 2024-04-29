<?php

namespace App\Http\Controllers;

use App\Models\Preprocessing;
use App\Models\TestData;
use App\Models\TrainData;
use Illuminate\Http\Request;

class RandomSamplingController extends Controller
{
    public function randomSampling()
    {
        // Ambil semua data yang sudah melalui proses preprocessing
        $preprocessings = Preprocessing::all();

        // Hitung jumlah data
        $totalData = count($preprocessings);

        // Tentukan jumlah data latih dan data uji
        $trainSize = (int) (0.7 * $totalData);
        $testSize = $totalData - $trainSize;

        $trainData = $this->randomSamplingWithReplacement($preprocessings, $trainSize);

        $testData = $this->randomSamplingWithReplacement($preprocessings, $testSize);

        foreach ($trainData as $data) {
            TrainData::create([
                'preprocessing_id' => $data->id
            ]);
        }

        foreach ($testData as $data) {
            TestData::create([
                'preprocessing_id' => $data->id
            ]);
        }
        return redirect()->back()->with('success', 'Data splitting process completed successfully.');
    }

    // Fungsi untuk melakukan random sampling with replacement
    private function randomSamplingWithReplacement($data, $size)
    {
        $sample = [];

        for ($i = 0; $i < $size; $i++) {
            // Ambil data secara acak dari $data dan tambahkan ke $sample
            $randomIndex = rand(0, count($data) - 1);
            $sample[] = $data[$randomIndex];
        }

        return $sample;
    }
}
