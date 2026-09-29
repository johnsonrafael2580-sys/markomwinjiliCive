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
    Schema::create('schedules', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Mf. Misa ya Kwanza, Mazoezi ya Katikati ya Wiki
        $table->date('date');
        $table->time('time');
        $table->string('location')->default('Parokiani');
        $table->text('description')->nullable(); // Maelezo ya ziada
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
