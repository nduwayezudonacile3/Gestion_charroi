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
    Schema::create('deplacementemployes', function (Blueprint $table) {
        $table->id();

        $table->foreignId('employe_id')
              ->constrained('employes')
              ->onDelete('cascade');

        $table->foreignId('deplacement_id')
              ->constrained('deplacements')
              ->onDelete('cascade');

        $table->unique(['employe_id', 'deplacement_id']);
         $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deplacement_employes');
    }
};
