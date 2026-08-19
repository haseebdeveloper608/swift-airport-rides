<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('concession_charges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            $table->string('place')->nullable();
            $table->string('post_code')->nullable();
            $table->decimal('amount', 10, 2)->default(0);
            $table->enum('applies', ['Pickup', 'Dropoff', 'Both'])->default('Pickup');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concession_charges');
    }
};
