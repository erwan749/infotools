<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commercial;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;



class CommercialApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request)
    {
        // Valider les entrées
        $request->validate([
            'email' => 'required|email',
            'psw' => 'required'
        ]);

        // Trouver l'utilisateur par email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                "success" => false,
                "message" => "L'utilisateur n'existe pas."
            ], 404);
        }

        // Vérifier le mot de passe
        if (!Hash::check($request->psw, $user->password)) {
            return response()->json([
                "success" => false,
                "message" => "Mauvais mot de passe."
            ], 401);
        }

        // Supprimer les anciens tokens (optionnel pour éviter l'accumulation)
        $user->tokens()->delete();

        // Générer un nouveau token avec une expiration de 24 heures
        $token = $user->createToken('auth_token', ['*'], now()->addHours(24))->plainTextToken;

        return response()->json([
            "success" => true,
            "data" => [
                "name" => $user->name,
                "token" => $token
            ]
        ]);
    }

}
