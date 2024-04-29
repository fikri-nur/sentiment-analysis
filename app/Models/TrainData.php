<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainData extends Model
{
    use HasFactory;

    protected $table = 'train_datas';

    protected $fillable = [
        'preprocessing_id',
    ];

    public function preprocessing()
    {
        return $this->belongsTo(Preprocessing::class);
    }
}
