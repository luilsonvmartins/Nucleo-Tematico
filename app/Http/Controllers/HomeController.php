<?php

namespace App\Http\Controllers;

use App\Models\Animal;

class HomeController extends Controller
{
    public function index()
    {
        $destaques = Animal::where('status', 'disponivel')->latest()->take(3)->get();
        $totalDisponiveis = Animal::where('status', 'disponivel')->count();
        $totalAdotados = Animal::where('status', 'adotado')->count();

        return view('home', compact('destaques', 'totalDisponiveis', 'totalAdotados'));
    }
}
