<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contenirs', function (Blueprint $table) {
            // Suppression de l'identifiant classique
            // $table->id(); // Retiré car nous utilisons une clé primaire composée
    
            // Clés étrangères
            $table->foreignId('idFact')->constrained('factures')->onDelete('cascade');
            $table->foreignId('idProd')->constrained('produits')->onDelete('cascade');
    
            // Autres colonnes
            $table->integer('Qte');
    
            // Clé primaire composée
            $table->primary(['idFact', 'idProd']);
    
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenirs');
    }
};
