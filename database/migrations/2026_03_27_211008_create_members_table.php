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
       Schema::create('members', function (Blueprint $table) {
    $table->id();
    $table->string('full_name');
    $table->string('registration_number')->unique()->nullable(); // Kama ni mwanafunzi wa UDOM
    $table->enum('voice_part', ['Soprano', 'Alto', 'Tenor', 'Bass']);
    $table->string('phone_number')->nullable();
    $table->string('course')->nullable(); // Kozi anayosoma (e.g., Bsc. in IS)
    $table->boolean('is_active')->default(true); // Kama bado yupo chuo au amehitimu
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
