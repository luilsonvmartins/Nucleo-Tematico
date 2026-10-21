<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = ['nome', 'especie', 'sexo', 'porte', 'idade', 'descricao', 'foto', 'status'];

    public const ESPECIES = ['cachorro' => 'Cachorro', 'gato' => 'Gato', 'outro' => 'Outro'];
    public const SEXOS    = ['macho' => 'Macho', 'femea' => 'Fêmea'];
    public const PORTES   = ['pequeno' => 'Pequeno', 'medio' => 'Médio', 'grande' => 'Grande'];
    public const STATUS   = [
        'disponivel'    => 'Disponível para adoção',
        'em_tratamento' => 'Em tratamento',
        'adotado'       => 'Adotado',
    ];

    public function getFotoUrlAttribute(): ?string
    {
        return $this->foto ? asset('storage/' . $this->foto) : null;
    }
}
