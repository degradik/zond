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
        Schema::create('umbrellas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Station::class,);
            $table->enum("status",["available","rented","lost"])->default("available");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umbrellas');
    }
};
