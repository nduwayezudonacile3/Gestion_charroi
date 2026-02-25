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
    Schema::create('vehicules', function (Blueprint $table) {
        $table->id();
        $table->string('immatriculation')->unique();
        $table->string('categorie');
        $table->string('marque');
        $table->enum('status', [
            'disponible',
            'indisponible',
            'au service',
            'maintenance'
        ])->default('disponible');
        $table->text('description')->nullable();
        $table->string('annee_fabrication');
        $table->foreignId('user_id')
              ->constrained('users')
              ->onDelete('cascade');
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
