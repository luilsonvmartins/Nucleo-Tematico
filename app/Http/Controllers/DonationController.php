<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function create()
    {
        return view('doacoes.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome'      => 'required|string|max:120',
            'contato'   => 'nullable|string|max:120',
            'tipo'      => 'required|in:' . implode(',', array_keys(Donation::TIPOS)),
            'valor'     => 'nullable|numeric|min:0',
            'descricao' => 'nullable|string|max:1000',
        ], $this->mensagens());

        Donation::create($dados);

        return redirect()->route('doacoes.create')
            ->with('sucesso', 'Obrigado pela sua doação! A equipe da APAS entrará em contato para combinar a entrega.');
    }
}
