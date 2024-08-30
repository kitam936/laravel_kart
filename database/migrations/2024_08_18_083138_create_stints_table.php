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
        Schema::create('stints', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('my_kart_id');
            $table->integer('my_tire_id');
            $table->integer('my_engine_id');
            $table->integer('cir_id');
            $table->dateTime('start_date');
            $table->integer('laps');
            $table->double('best_time',4,2);
            $table->integer('max_rev')->nullable();
            $table->integer('min_rev')->nullable();
            $table->integer('fr_tread')->nullable();
            $table->integer('re_tread')->nullable();
            $table->integer('fr_sprocket')->nullable();
            $table->integer('re_sprocket')->nullable();
            $table->string('stabilizer')->nullable();
            $table->integer('tire_pres')->nullable();
            $table->integer('tire_temp')->nullable();
            $table->integer('tire_age')->nullable();
            $table->integer('cab_hi')->nullable();
            $table->integer('cab_lo')->nullable();
            $table->string('dry_wet')->nullable();
            $table->integer('temp')->nullable();
            $table->integer('humidity')->nullable();
            $table->integer('atm_pressure')->nullable();
            $table->integer('road_temp')->nullable();
            $table->text('stint_info')->nullable();
            $table->string('photo1')->nullable();
            $table->string('photo2')->nullable();
            $table->string('photo3')->nullable();
            $table->string('filename')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stints');
    }
};
