<?php

namespace App\Http\Controllers;

use App\Models\Commercial;
use App\Models\User;
use App\Http\Requests\StoreCommercialRequest;
use App\Http\Requests\UpdateCommercialRequest;
use Illuminate\Http\Request;

class CommercialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('commercial.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommercialRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Récupérer l'utilisateur par ID
        $user = User::find($id);
        
        // Vérifier si l'utilisateur existe
        if (!$user) {
            return redirect()->route('commercial.index')->with('error', 'Utilisateur non trouvé');
        }
    
        // Récupérer les détails du commercial associé à cet utilisateur
        $commercial = Commercial::where('idUser', $id)->first();
    
        // Retourner la vue 'commercial.show' avec l'utilisateur et les détails du commercial
        return view('commercial.show', compact('user', 'commercial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commercial $commercial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommercialRequest $request, Commercial $commercial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commercial $commercial)
    {
        //
    }
}
