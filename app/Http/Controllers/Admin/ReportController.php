<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::query();
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $denuncias = $query->latest()->paginate(15)->withQueryString();

        return view('admin.denuncias.index', compact('denuncias'));
    }

    public function show(Report $report)
    {
        return view('admin.denuncias.show', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $dados = $request->validate([
            'status'     => 'required|in:' . implode(',', array_keys(Report::STATUS)),
            'observacao' => 'nullable|string|max:2000',
        ], $this->mensagens());

        $report->update($dados);

        return back()->with('sucesso', 'Denúncia atualizada.');
    }

    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('admin.denuncias.index')->with('sucesso', 'Denúncia removida.');
    }
}
