<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prospect;
use Illuminate\Support\Facades\Hash;

class ProspectApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(!auth()->user()->tokenCan('read')){
            abort(401,'non autorisé');
        }
        $prospects = Prospect::all();
        return response()->json([
            "succes"=>true,
            "message"=>"Liste des prospect",
            "data"=> $prospects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->tokenCan('create')) {
            abort(401, 'non autorisé');
        }
    
        $request->validate([
            'NomProspects' => 'required',
            'PrenomProspects' => 'required',
            'telProspects' => 'required',
            'EmailProspects' => 'required|email',
            'mdpProspect' => 'required',
        ]);
    
        $input = $request->only(['NomProspects', 'PrenomProspects', 'telProspects', 'EmailProspects', 'mdpProspect']);
        $input['mdpProspect'] = Hash::make($input['mdpProspect']);
    
        try {
            $prospects = Prospect::create($input);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "Erreur lors de l'ajout du prospect: " . $e->getMessage(),
            ], 500);
        }
    
        return response()->json([
            "success" => true,
            "message" => "Prospect ajouté avec succès",
            "data" => $prospects
        ]);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!auth()->user()->tokenCan('read')){
            abort(401,'non autorisé');
        }

        $prospects = Prospect::find($id);

        if(is_null($prospects)){
            return response()->json([
                "success" => false,
                "message" => "prospect non trouvé."
            ], 404);
        }

        return response()->json([
            "success" => true,
            "message" => "Prosect trouver avec succès",
            "data" => $prospects
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
        ]);

        // Trouver le prospect par ID
        $prospect = Prospect::find($id);

        // Vérifier si le prospect existe
        if (is_null($prospect)) {
            return response()->json([
                "success" => false,
                "message" => "prospect non trouvé."
            ], 404);
        }

        // Mettre à jour les données
        $prospect->NomProspects = $request->nom;
        $prospect->PrenomProspects = $request->prenom;
        $prospect->telProspects = $request->tel ?? $prospect->telProspects; // Gérer les champs optionnels
        $prospect->EmailProspects = $request->mail ?? $prospect->EmailProspects;   // Gérer les champs optionnels
        $prospect->mdpProspect = $request->mdp ?? $prospect->mdpProspect; // Gérer les champs optionnels
        $prospect->save();

        // Retourner la réponse
        return response()->json([
            "success" => true,
            "message" => "prospect mis à jour avec succès.",
            "data" => $prospect
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        
        if(!auth()->user()->tokenCan('delete')){
            abort(401,'non autorisé');
        }



        Prospect::destroy($id);
        return response()->json([
            "success" => true,
            "message" => "prospect supprimé avec succès.",
        ]);
    }
}
