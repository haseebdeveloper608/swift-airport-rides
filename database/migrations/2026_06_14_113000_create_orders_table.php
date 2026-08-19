<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('stripe_session_id')->unique();
            $table->string('stripe_payment_intent_id')->nullable();
            $table->string('customer_email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('car_name');
            $table->string('pickup');
            $table->string('dropoff');
            $table->date('pickup_date')->nullable();
            $table->string('pickup_time')->nullable();
            $table->string('outbound_flight_number')->nullable();
            $table->string('outbound_flight_time')->nullable();
            $table->float('meet_greet_outbound_fee')->default(0);
            $table->text('notes')->nullable();
            $table->date('return_date')->nullable();
            $table->string('return_time')->nullable();
            $table->string('return_flight_number')->nullable();
            $table->string('return_flight_time')->nullable();
            $table->float('meet_greet_return_fee')->default(0);
            $table->text('return_notes')->nullable();
            $table->string('trip_type')->default('oneway');
            $table->float('miles')->default(0);
            $table->float('amount')->default(0);
            $table->string('currency')->default('gbp');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
