<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SatuanBenangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'satuan' => 'METER',
            'singkatan' => 'M',
            'status' => 'panjang',
        ];
    }
}
