<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['protocolo', 'tipo', 'descricao', 'endereco', 'bairro', 'nome', 'contato', 'status', 'observacao'];

    public const TIPOS = [
        'maus_tratos'   => 'Maus-tratos',
        'abandono'      => 'Abandono',
        'animal_ferido' => 'Animal ferido / doente',
        'outros'        => 'Outros',
    ];
    public const STATUS = ['nova' => 'Nova', 'em_analise' => 'Em análise', 'resolvida' => 'Resolvida'];

    public static function gerarProtocolo(): string
    {
        do {
            $p = 'APAS-' . date('Y') . '-' . strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
        } while (self::where('protocolo', $p)->exists());

        return $p;
    }
}
