<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        $query = Animal::query();
        if ($request->filled('busca')) {
            $query->where('nome', 'like', '%' . $request->busca . '%');
        }
        $animais = $query->latest()->paginate(15)->withQueryString();

        return view('admin.animais.index', compact('animais'));
    }

    public function create()
    {
        return view('admin.animais.form', ['animal' => new Animal()]);
    }

    public function store(Request $request)
    {
        $dados = $this->validar($request);

        if ($request->hasFile('foto')) {
            $dados['foto'] = $request->file('foto')->store('animais', 'public');
        }

        Animal::create($dados);

        return redirect()->route('admin.animais.index')->with('sucesso', 'Animal cadastrado com sucesso!');
    }

    public function edit(Animal $animal)
    {
        return view('admin.animais.form', compact('animal'));
    }

    public function update(Request $request, Animal $animal)
    {
        $dados = $this->validar($request);

        if ($request->hasFile('foto')) {
            if ($animal->foto) {
                Storage::disk('public')->delete($animal->foto);
            }
            $dados['foto'] = $request->file('foto')->store('animais', 'public');
        }

        $animal->update($dados);

        return redirect()->route('admin.animais.index')->with('sucesso', 'Animal atualizado!');
    }

    public function destroy(Animal $animal)
    {
        if ($animal->foto) {
            Storage::disk('public')->delete($animal->foto);
        }
        $animal->delete();

        return redirect()->route('admin.animais.index')->with('sucesso', 'Animal removido.');
    }

    private function validar(Request $request): array
    {
        return $request->validate([
            'nome'      => 'required|string|max:80',
            'especie'   => 'required|in:' . implode(',', array_keys(Animal::ESPECIES)),
            'sexo'      => 'required|in:' . implode(',', array_keys(Animal::SEXOS)),
            'porte'     => 'required|in:' . implode(',', array_keys(Animal::PORTES)),
            'idade'     => 'nullable|string|max:40',
            'descricao' => 'nullable|string|max:2000',
            'status'    => 'required|in:' . implode(',', array_keys(Animal::STATUS)),
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ], $this->mensagens());
    }
}
