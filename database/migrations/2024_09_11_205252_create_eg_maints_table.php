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
        Schema::create('eg_maints', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('my_engine_id');
            $table->integer('eg_maint_category_id');
            $table->text( 'maint_info')->nullable();
            $table->dateTime('maint_date');
            $table->integer('maint_fee')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eg_maints');
    }
};
