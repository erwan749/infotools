<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->string('CPClient', 50); // Code postal
            $table->string('VilleClient', 50); // Ville
            $table->string('AdresseClient', 100); // Adresse
            $table->unsignedBigInteger('idProspects'); // Clé étrangère vers prospects.id

            // Définition de la clé étrangère
            $table->foreign('idProspects')
                  ->references('id')
                  ->on('prospects')
                  ->onDelete('cascade'); // Suppression en cascade

            $table->timestamps(); // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
