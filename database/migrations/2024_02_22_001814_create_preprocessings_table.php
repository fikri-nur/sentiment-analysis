<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('preprocessings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dataset_id')->constrained('datasets');
            $table->text('cleaned_text')->nullable();
            $table->text('case_folded_text')->nullable();
            $table->text('tokenized_text')->nullable();
            $table->text('normalized_text')->nullable();
            $table->text('stopwords_removed_text')->nullable();
            $table->text('stemmed_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preprocessings');
    }
};
