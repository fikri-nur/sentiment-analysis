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
        Schema::create('tf_idfs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('preprocessing_id');
            $table->foreign('preprocessing_id')->references('id')->on('preprocessings')->onDelete('cascade');
            $table->string('word');
            $table->double('tf_idf_score', 15, 8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tf_idfs');
    }
};
