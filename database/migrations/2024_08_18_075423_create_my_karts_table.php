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
        Schema::create('my_karts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('maker_id');
            $table->text('photo1')->nullable();
            $table->text('photo2')->nullable();
            $table->text('my_kart_info')->nullable();
            $table->dateTime('purchase_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_karts');
    }
};
