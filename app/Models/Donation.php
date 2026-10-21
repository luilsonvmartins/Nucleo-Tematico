<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = ['nome', 'contato', 'tipo', 'valor', 'descricao', 'status'];

    public const TIPOS = [
        'dinheiro'    => 'Dinheiro (Pix)',
        'racao'       => 'Ração',
        'medicamento' => 'Medicamentos / vacinas',
        'outros'      => 'Outros (cobertores, caixas, etc.)',
    ];
    public const STATUS = ['pendente' => 'Pendente', 'recebida' => 'Recebida'];
}
