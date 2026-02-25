<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
{
    Schema::create('deplacements', function (Blueprint $table) {
        $table->id();
        $table->string('code_deplacement')->unique();

        $table->dateTime('date_depart');
        $table->dateTime('date_prevus');
        $table->dateTime('date_retour')->nullable();

        $table->string('litineraire');
        $table->integer('km_depart');
        $table->integer('carburant_initial');
        $table->integer('km_retour')->nullable();
        $table->integer('km_parcourus')->nullable();
        $table->integer('carburant_restant')->nullable();
        $table->integer('carburant_consomme')->nullable();

        $table->string('motif');
        $table->double('frais_mission')->default(0);

        $table->enum('statut', [
            'En attente',
            'En cours',
            'Termine',
            'Confirme'
        ])->default('En attente');

        $table->foreignId('user_id')
              ->constrained('users')
              ->onDelete('cascade');

        $table->foreignId('vehicule_id')
              ->constrained('vehicules')
              ->onDelete('cascade');

        $table->foreignId('projet_id')
              ->constrained('projets')
              ->onDelete('cascade');

        $table->foreignId('approved_by')
              ->nullable()
              ->constrained('users')
              ->nullOnDelete();

        $table->text('description')->nullable();

        $table->timestamps();
    });
}



    public function down(): void
    {
        Schema::dropIfExists('deplacements');
    }
};
