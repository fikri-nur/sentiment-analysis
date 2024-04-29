<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TfIdf extends Model
{
    use HasFactory;

    protected $table = 'tf_idfs';

    protected $fillable = [
        'preprocessing_id',
        'word',
        'tf_idf_score',
    ];

    public function preprocessing()
    {
        return $this->belongsTo(Preprocessing::class);
    }
}
