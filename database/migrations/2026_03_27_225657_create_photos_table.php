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
    Schema::create('photos', function (Blueprint $table) {
        $table->id();
        $table->string('caption');       // Maelezo fupi ya picha (mf: Misa ya Kipaimara)
        $table->string('path');          // Njia (path) ambapo picha itahifadhiwa
        $table->string('category')->nullable(); // Si lazima (mf: Misa, Safari, Mazoezi)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
