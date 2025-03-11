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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\User::class,);
            $table->foreignIdFor(App\Models\Umbrella::class,);
            $table->dateTime("date_start")->nullable();
            $table->dateTime("date_end")->nullable();
            $table->decimal('total_cost', 10, 2)->default(0);
            $table->enum("status",["active","completed"])->default("active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
