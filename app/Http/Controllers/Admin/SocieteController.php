<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Societe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SocieteController extends Controller
{

    public function __construct() {
        $this->middleware('permission:societe-list|societe-create|societe-edit|societe-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:societe-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:societe-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:societe-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $societes = Societe::orderBy('id', 'DESC')
                        ->when(
                            $request->title,
                            function(Builder $builder) use ($request) {
                                $builder->where('title', 'LIKE', '%'. $request->title .'%');
                            }
                        )
                        ->paginate(10);
        return view('admin.societes.index', compact('societes', 'request'))
                    ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.societes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'title' => 'required',
            'adresse' => 'required',
            'ville' => 'required',
            'pays' => 'required',
        ]);

        Societe::create($request->all());

        return redirect()->route('societes.index')
                        ->with('success', 'La société créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Societe $societe): View
    {
        return view('admin.societes.show', compact('societe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Societe $societe): View
    {
        return view('admin.societes.edit', compact('societe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Societe $societe): RedirectResponse
    {
        request()->validate([
            'title' => 'required',
            'adresse' => 'required',
            'ville' => 'required',
            'pays' => 'required',
        ]);

        $societe->update($request->all());

        return redirect()->route('societes.index')
                        ->with('success', 'Informations sur la société mises à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Societe $societe): RedirectResponse
    {
        $societe->delete();

        return redirect()->route('societes.index')
                        ->with('success', 'La société a été supprimé avec succès.');
    }
}
