<?php

namespace App\Http\Controllers;

use App\Models\Commercial;
use App\Models\User;
use App\Http\Requests\StoreCommercialRequest;
use App\Http\Requests\UpdateCommercialRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

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
        return view('commercial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validation des données du formulaire
    $request->validate([
        'Name' => 'required|string|max:255',
        'role' => 'required|in:Commercial,manager',
        'email' => 'required|email|unique:users,email',
        'mdp1' => [
            'required',
            'string',
            'min:8',
            'regex:/[a-z]/',
            'regex:/[A-Z]/',
            'regex:/[0-9]/',
            'regex:/[@$!%*?&]/',
            'confirmed',  
        ],
        'CP' => 'required|regex:/^\d{5}$/',
        'Ville' => 'required|string|max:255',
        'Adresse' => 'required|string|max:255',
        'Tel' => 'required|regex:/^(\+?\d{1,3}[- ]?)?\d{10}$/',
    ]);

    // Création de l'utilisateur
    $password = Hash::make($request->mdp1);
    $user = User::create([
        'name' => $request->Name,  
        'role' => $request->role,  
        'email' => $request->email, 
        'password' => $password,  
    ]);

    // Création du commercial
    Commercial::create([
        'cpCom' => $request->CP,  
        'villeCom' => $request->Ville,  
        'rueCom' => $request->Adresse,  
        'telCom' => $request->Tel,  
        'idUser' => $user->id,  
    ]);

    // Redirection avec message de succès
    return redirect()->route('commercial.index')->with('success', 'Commercial ajouté avec succès!');
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
    public function edit($id)
    {
        // Récupérer les informations du commercial avec l'id donné
        $commercial = Commercial::findOrFail($id);
        return view('commercial.edit', compact('commercial'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'Name' => 'required|string|max:255',
            'role' => 'required|in:Commercial,manager',
            'email' => 'required|email|unique:users,email,' . $id,
            'mdp1' => [
                'nullable', // Permet de laisser vide si l'utilisateur ne veut pas changer le mot de passe
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'CP' => 'required|regex:/^\d{5}$/',
            'Ville' => 'required|string|max:255',
            'Adresse' => 'required|string|max:255',
            'Tel' => 'required|regex:/^(\+?\d{1,3}[- ]?)?\d{10}$/',
        ]);
    
        // Mettre à jour les informations du commercial
        $commercial = Commercial::findOrFail($id);
    
        // Mise à jour des informations du commercial
        $commercial->update([
            'cpCom' => $request->CP,
            'villeCom' => $request->Ville,
            'rueCom' => $request->Adresse,
            'telCom' => $request->Tel,
        ]);
    
        // Mise à jour des informations utilisateur (si nécessaire)
        $user = $commercial->user;
        $user->name = $request->Name;
        $user->role = $request->role;
        $user->email = $request->email;
        
        // Si un nouveau mot de passe est fourni, le mettre à jour
        if ($request->mdp1) {
            $user->password = Hash::make($request->mdp1);
        }
        $user->save();
    
        return redirect()->route('commercial.index')->with('success', 'Commercial mis à jour avec succès');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commercial $commercial)
    {
        $userId = $commercial->idUser;
        
        $commercial->delete();
        
        $user = User::find($userId);
        if ($user) {
            $user->delete();
        }

        return redirect()->route('commercial.index')->with('success', 'Commercial et son utilisateur supprimés avec succès');
    }
}
