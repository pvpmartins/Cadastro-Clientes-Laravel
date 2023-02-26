<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Estados;
use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{
    public function run()
    {
        $estados = Estados::all();

        foreach ($estados as $estado) {
            Cliente::factory(1)->create([
                'estado_id' => $estado->id,
            ]);
        }
    }
}
