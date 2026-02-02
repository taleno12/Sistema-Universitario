<?php

namespace App\Http\Controllers;

use App\Models\Facultade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\FacultadeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf; // 👈 Importar DomPDF

class FacultadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->get('search');

        $facultades = Facultade::where('nombre', 'LIKE', '%' . $search . '%')
            ->paginate(10)
            ->withQueryString(); 

        return view('facultade.index', compact('facultades', 'search'))
            ->with('i', ($request->input('page', 1) - 1) * $facultades->perPage());
    }

    public function create(): View
    {
        $facultade = new Facultade();

        return view('facultade.create', compact('facultade'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FacultadeRequest $request): RedirectResponse
    {
        Facultade::create($request->validated());

        return Redirect::route('facultades.index')
            ->with('success', 'Facultad creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $facultade = Facultade::find($id);

        return view('facultade.show', compact('facultade'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $facultade = Facultade::find($id);

        return view('facultade.edit', compact('facultade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FacultadeRequest $request, Facultade $facultade): RedirectResponse
    {
        $facultade->update($request->validated());

        return Redirect::route('facultades.index')
            ->with('success', 'Facultad actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        Facultade::find($id)->delete();

        return Redirect::route('facultades.index')
            ->with('success', 'Facultad eliminada con éxito');
    }

    /**
     * ✅ Generar reporte PDF de Facultades
     */
    public function exportPdf()
    {
        $facultades = Facultade::all();

        $pdf = Pdf::loadView('facultade.pdf', compact('facultades'));

        return $pdf->download('facultades.pdf');
    }
}
