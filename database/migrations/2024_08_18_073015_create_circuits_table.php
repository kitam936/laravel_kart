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
        Schema::create('circuits', function (Blueprint $table) {
            $table->id();
            $table->string('cir_name');
            $table->integer('area_id');
            $table->string('photo1')->nullable();
            $table->string('photo2')->nullable();
            $table->text('cir_info')->nullable();
            $table->text('url')->nullable();
            $table->integer('length')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('circuits');
    }
};
