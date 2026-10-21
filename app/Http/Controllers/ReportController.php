<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function create()
    {
        return view('denuncias.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'tipo'      => 'required|in:' . implode(',', array_keys(Report::TIPOS)),
            'descricao' => 'required|string|min:15|max:3000',
            'endereco'  => 'required|string|max:200',
            'bairro'    => 'nullable|string|max:100',
            'nome'      => 'nullable|string|max:120',
            'contato'   => 'nullable|string|max:120',
        ], $this->mensagens());

        $dados['protocolo'] = Report::gerarProtocolo();
        $report = Report::create($dados);

        return view('denuncias.sucesso', ['protocolo' => $report->protocolo]);
    }
}
