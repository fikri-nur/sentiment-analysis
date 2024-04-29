<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dataset extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'full_text',
        'sentiment',
    ];

    public $timestamps = false;

    public function preprocessings(): HasMany
    {
        return $this->hasMany(Preprocessing::class);
    }
}
