<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class barangDatangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'jenis_benang_id' => 1,
            'warna_benang_id' => 1,
            'jumlah_benang' => 100,
            'satuan_id' => 1,
        ];
    }
}
