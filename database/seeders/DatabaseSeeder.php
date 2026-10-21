<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Administrador padrão — TROQUE A SENHA depois do primeiro acesso.
        User::updateOrCreate(
            ['email' => 'admin@apas.local'],
            ['name' => 'Administrador APAS', 'password' => Hash::make('apas1234')]
        );

        if (Animal::count() === 0) {
            Animal::create(['nome' => 'Thor', 'especie' => 'cachorro', 'sexo' => 'macho', 'porte' => 'grande', 'idade' => '2 anos', 'descricao' => 'Dócil, brincalhão e já vacinado.', 'status' => 'disponivel']);
            Animal::create(['nome' => 'Mel', 'especie' => 'cachorro', 'sexo' => 'femea', 'porte' => 'pequeno', 'idade' => '8 meses', 'descricao' => 'Filhote carinhosa, castração agendada.', 'status' => 'disponivel']);
            Animal::create(['nome' => 'Bidu', 'especie' => 'cachorro', 'sexo' => 'macho', 'porte' => 'medio', 'idade' => '5 anos', 'descricao' => 'Resgatado, em recuperação.', 'status' => 'em_tratamento']);
        }
    }
}
