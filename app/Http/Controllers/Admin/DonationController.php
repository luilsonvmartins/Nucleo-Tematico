<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $query = Donation::query();
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $doacoes = $query->latest()->paginate(15)->withQueryString();
        $totalRecebido = Donation::where('status', 'recebida')->sum('valor');

        return view('admin.doacoes.index', compact('doacoes', 'totalRecebido'));
    }

    public function update(Request $request, Donation $donation)
    {
        $dados = $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Donation::STATUS)),
        ], $this->mensagens());

        $donation->update($dados);

        return back()->with('sucesso', 'Doação atualizada.');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();

        return back()->with('sucesso', 'Registro removido.');
    }
}
