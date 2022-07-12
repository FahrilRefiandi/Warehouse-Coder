<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(3)->create();
        // \App\Models\JenisBenang::factory(1)->create();
        // \App\Models\SatuanBenang::factory(1)->create();
        // \App\Models\WarnaBenang::factory(1)->create();
        // \App\Models\BenangDatang::factory(1)->create();
    }
}
