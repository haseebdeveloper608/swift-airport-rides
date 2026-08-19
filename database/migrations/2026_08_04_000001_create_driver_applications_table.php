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
        if (!Schema::hasTable('driver_applications')) {
            Schema::create('driver_applications', function (Blueprint $table) {
                $table->id();
                $table->string('first_name');
                $table->string('middle_name')->nullable();
                $table->string('last_name');
                $table->string('email');
                $table->string('phone');
                $table->date('date_of_birth')->nullable();
                $table->string('previous_driver')->default('No');
                $table->string('vehicle_option')->default('Own Vehicle');
                $table->string('pco_license')->nullable();
                $table->string('vehicle_details')->nullable();
                $table->string('status')->default('pending');
                $table->string('ip_address')->nullable();
                $table->text('user_agent')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_applications');
    }
};
