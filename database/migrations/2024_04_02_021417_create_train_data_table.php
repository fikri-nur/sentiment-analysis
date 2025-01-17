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
        Schema::create('train_datas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('preprocessing_id');
            $table->foreign('preprocessing_id')->references('id')->on('preprocessings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('train_data');
    }
};
