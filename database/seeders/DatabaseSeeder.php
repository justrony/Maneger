<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Card::create([
            'name' => 'Itau',
            'last_four' => '1234',
            'maturity' => '22',
            'theme' => '#FFA500'
        ]);
    }
}
