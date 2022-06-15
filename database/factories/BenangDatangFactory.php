<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BenangDatangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'jenis_benang' => "RAYON",
            'warna_benang' => "Hitam",
            'jumlah_benang' => 100,
            'satuan' => "KG",
            'tgl_benang_datang' => now(),
        ];
    }
}
