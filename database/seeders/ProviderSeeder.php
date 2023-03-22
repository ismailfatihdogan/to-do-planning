<?php

namespace Database\Seeders;

use App\Models\Provider;
use App\Services\FirstProviderService;
use App\Services\SecondProviderService;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First Provider
        Provider::query()->insertOrIgnore([
            'title' => 'First Provider',
            'url' => 'http://www.mocky.io/v2/5d47f24c330000623fa3ebfa',
            'class_path' => FirstProviderService::class,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Second Provider
        Provider::query()->insertOrIgnore([
            'title' => 'Second Provider',
            'url' => 'http://www.mocky.io/v2/5d47f235330000623fa3ebf7',
            'class_path' => SecondProviderService::class,
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
