<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('deplacement_employes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('deplacement_id')
                  ->constrained('deplacements')
                  ->onDelete('cascade');

            $table->foreignId('employe_id')
                  ->constrained('employes')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deplacement_employes');
    }
};
