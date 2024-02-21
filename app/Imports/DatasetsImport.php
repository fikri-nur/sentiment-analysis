<?php

namespace App\Imports;

use App\Models\Dataset;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DatasetsImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Dataset([
            'username' => $row[0],
            'full_text' => $row[1],
            'sentiment' => $row[2],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
