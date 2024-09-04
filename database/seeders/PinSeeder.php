<?php

namespace Database\Seeders;

use Database\Factories\PinFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pin;

class PinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pin::factory(10)->create();
    }
}
