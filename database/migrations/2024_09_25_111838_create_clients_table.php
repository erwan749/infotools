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
            $table->id(); // Auto-incrementing primary key 'id'
            $table->string('CPClient', 50); // 'CPClient' VARCHAR(50)
            $table->string('VilleClient', 50); // 'VilleClient' VARCHAR(50)
            $table->string('AdresseClient', 100); // 'AdresseClient' VARCHAR(100)
            $table->Integer('idProspects'); // Foreign key for prospects table

            // Add foreign key constraint
            $table->foreign('idProspects')->references('id')->on('prospects')->onDelete('cascade');

            $table->timestamps(); // 'created_at' and 'updated_at' timestamps
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
