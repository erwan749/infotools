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
        $table->id();
        $table->foreignId('idFact')->constrained('factures')->onDelete('cascade');
        $table->foreignId('idProd')->constrained('produits')->onDelete('cascade');
        $table->integer('Qte');
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
