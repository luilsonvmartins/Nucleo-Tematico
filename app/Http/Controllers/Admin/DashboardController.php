<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Donation;
use App\Models\Report;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'animaisDisponiveis' => Animal::where('status', 'disponivel')->count(),
            'animaisTratamento'  => Animal::where('status', 'em_tratamento')->count(),
            'animaisAdotados'    => Animal::where('status', 'adotado')->count(),
            'doacoesPendentes'   => Donation::where('status', 'pendente')->count(),
            'denunciasNovas'     => Report::where('status', 'nova')->count(),
            'ultimasDenuncias'   => Report::latest()->take(5)->get(),
        ]);
    }
}
