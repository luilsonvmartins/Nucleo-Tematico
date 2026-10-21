<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $query = Animal::query()->whereIn('status', ['disponivel', 'em_tratamento']);

        if ($request->filled('especie')) {
            $query->where('especie', $request->especie);
        }
        if ($request->filled('porte')) {
            $query->where('porte', $request->porte);
        }

        $animais = $query->latest()->paginate(9)->withQueryString();

        return view('animais.index', compact('animais'));
    }

    public function show(Animal $animal)
    {
        return view('animais.show', compact('animal'));
    }
}
