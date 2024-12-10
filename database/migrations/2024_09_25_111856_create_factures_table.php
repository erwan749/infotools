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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->dateTime('DateFact'); 
            $table->unsignedBigInteger('idClient'); // Clé étrangère vers clients.id
            $table->timestamps();

            $table->foreign('idClient')
                  ->references('id')
                  ->on('clients')
                  ->onDelete('cascade'); // Suppression en cascade si un client est supprimé
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
