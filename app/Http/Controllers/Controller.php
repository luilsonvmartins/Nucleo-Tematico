<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /** Mensagens de validação em português. */
    protected function mensagens(): array
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'max'      => 'O campo :attribute deve ter no máximo :max caracteres.',
            'min'      => 'O campo :attribute deve ter no mínimo :min caracteres.',
            'image'    => 'O arquivo enviado deve ser uma imagem.',
            'mimes'    => 'A imagem deve ser JPG, PNG ou WEBP.',
            'numeric'  => 'O campo :attribute deve ser um número.',
            'in'       => 'O valor escolhido em :attribute é inválido.',
            'email'    => 'Informe um e-mail válido.',
        ];
    }
}
