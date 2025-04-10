<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use App\Models\Client;
use App\Http\Requests\StoreProspectRequest;
use App\Http\Requests\UpdateProspectRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prospects = Prospect::all();
        return view('prospects.index', compact('prospects'))
            ->with('i', (request()->input('page', 1) - 1) * 50);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prospects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NomProspects' => 'required|string|max:255',
            'PrenomProspects' => 'required|string|max:255',
            'telProspects' => 'required|string|max:15',
            'EmailProspects' => 'required|email|unique:prospects,EmailProspects|max:255',
            'mdpProspect' => 'required|string|min:6|confirmed',
        ]);

        // Création du prospect
        $prospect = new Prospect();
        $prospect->NomProspects = $request->NomProspects;
        $prospect->PrenomProspects = $request->PrenomProspects;
        $prospect->telProspects = $request->telProspects;
        $prospect->EmailProspects = $request->EmailProspects;
        $prospect->mdpProspect = Hash::make($request->mdpProspect); // Hash du mot de passe
        $prospect->save();

        // Rediriger vers la liste des prospects avec un message de succès
        return redirect()->route('prospects.index')
            ->with('success', 'Prospect ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $prospect = Prospect::find($id);
        if (!$prospect) {
            return redirect()->route('prospects.index')
                ->with('error', 'Prospect non trouvé.');
        }

        return view('prospects.show', compact('prospect')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = auth()->user();

        // Vérifier si l'utilisateur a les droits pour supprimer
        if ($user->role != 'manager') {
            return redirect()->route('prospects.index')
                ->with('error', 'Vous n\'avez pas les droits pour modifier ce prospect');
        }
        $prospect = Prospect::find($id);
        if (!$prospect) {
            return redirect()->route('prospects.index')
                ->with('error', 'Prospect non trouvé.');
        }

        return view('prospects.edit', compact('prospect'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();

        // Vérifier si l'utilisateur a les droits pour supprimer
        if ($user->role != 'manager') {
            return redirect()->route('prospects.index')
                ->with('error', 'Vous n\'avez pas les droits pour modifier ce prospect');
        }
        // Validation des données
        $request->validate([
            'NomProspects' => 'required|string|max:255',
            'PrenomProspects' => 'required|string|max:255',
            'telProspects' => 'required|string|max:15',
            'EmailProspects' => 'required|email|unique:prospects,EmailProspects,' . $id . '|max:255',
            'mdpProspect' => 'nullable|string|min:6|confirmed',  // Le mot de passe est facultatif
        ]);

        $prospect = Prospect::find($id);
        if (!$prospect) {
            return redirect()->route('prospects.index')
                ->with('error', 'Prospect non trouvé.');
        }

        // Mise à jour des informations du prospect
        $prospect->NomProspects = $request->NomProspects;
        $prospect->PrenomProspects = $request->PrenomProspects;
        $prospect->telProspects = $request->telProspects;
        $prospect->EmailProspects = $request->EmailProspects;

        // Si un nouveau mot de passe est fourni, on le hash
        if ($request->filled('mdpProspect')) {
            $prospect->mdpProspect = Hash::make($request->mdpProspect);
        }

        $prospect->save();

        return redirect()->route('prospects.index')
            ->with('success', 'Prospect mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prospect $prospect)
    {
        $user = auth()->user();

        // Vérifier si l'utilisateur a les droits pour supprimer
        if ($user->role != 'manager') {
            return redirect()->route('prospects.index')
                ->with('error', 'Vous n\'avez pas les droits pour supprimer ce prospect');
        }
    
        // Vérifier si le prospect est lié à un client
        $client = Client::where('idProspects', $prospect->id)->first();
    
        if ($client) {
            return redirect()->route('prospects.index')
                ->with('error', 'Ce prospect est lié à un client et ne peut pas être supprimé.');
        }
    
        // Si le prospect n'est pas lié à un client, il peut être supprimé
        $prospect->delete();
    
        return redirect()->route('prospects.index')
            ->with('success', 'Prospect supprimé avec succès.');
    }
}
