<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ChMaint;
use App\Models\EgMaint;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AreaSeeder::class,
            UserSeeder::class,
            MakerSeeder::class,
            EngineSeeder::class,
            CircuitSeeder::class,
            TempSeeder::class,
            RoadtempSeeder::class,
            TiretempSeeder::class,
            HumiditySeeder::class,
            TireSeeder::class,
            MyKartSeeder::class,
            MyTireSeeder::class,
            MyEngineSeeder::class,
            // StintSeeder::class,
            EgMaintCategorySeeder::class,
            ChMaintCategorySeeder::class,
            EgMaintSeeder::class,
            ChMaintSeeder::class,

            // CategorySeeder::class,
            // subCategorySeeder::class,
            // StatusSeeder::class,
            ]);
    }
}
