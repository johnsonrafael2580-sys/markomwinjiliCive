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
    Schema::table('members', function (Blueprint $table) {
        // Inaongeza reg_no baada ya full_name, na inaweza kuwa tupu (nullable)
        $table->string('reg_no')->nullable()->after('full_name'); 
    });
}

public function down(): void
{
    Schema::table('members', function (Blueprint $table) {
        $table->dropColumn('reg_no');
    });
}
};
