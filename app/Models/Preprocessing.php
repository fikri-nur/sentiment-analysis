<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preprocessing extends Model
{
    use HasFactory;

    protected $fillable = [
        'dataset_id',
        'original_text',
        'cleaned_text',
        'case_folded_text',
        'tokenized_text',
        'normalized_text',
        'stopwords_removed_text',
        'stemmed_text',
    ];

    public function dataset()
    {
        return $this->belongsTo(Dataset::class);
    }

    public function tfidf()
    {
        return $this->hasOne(TfIdf::class);
    }

    public function trainData()
    {
        return $this->hasOne(TrainData::class);
    }
}
