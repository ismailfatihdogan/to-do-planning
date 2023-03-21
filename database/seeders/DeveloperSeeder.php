<?php

namespace Database\Seeders;

use App\Models\Developer;
use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            Developer::query()->insertOrIgnore([
                'full_name' => 'Developer ' . $i,
                'level' => $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
