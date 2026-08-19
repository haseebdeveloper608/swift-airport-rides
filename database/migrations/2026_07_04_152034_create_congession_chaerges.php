<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('concession_charges')) {
            Schema::create('concession_charges', function (Blueprint $table) {
                $table->id();
                $table->foreignId('car_id')->nullable()->constrained('cars')->onDelete('cascade');
                $table->string('place');
                $table->string('post_code')->nullable();
                $table->decimal('radius', 8, 2)->default(0);
                $table->string('fare_type')->default('Fixed');
                $table->decimal('amount', 10, 2)->default(0);
                $table->string('applies')->default('Pickup');
                $table->string('lat')->nullable();
                $table->string('lng')->nullable();
                $table->timestamps();
            });

            return;
        }

        Schema::table('concession_charges', function (Blueprint $table) {
            if (!Schema::hasColumn('concession_charges', 'radius')) {
                $table->decimal('radius', 8, 2)->default(0)->after('post_code');
            }

            if (!Schema::hasColumn('concession_charges', 'fare_type')) {
                $table->string('fare_type')->default('Fixed')->after('radius');
            }

            if (!Schema::hasColumn('concession_charges', 'applies')) {
                $table->string('applies')->default('Pickup')->after('amount');
            }

            if (!Schema::hasColumn('concession_charges', 'lat')) {
                $table->string('lat')->nullable()->after('applies');
            }

            if (!Schema::hasColumn('concession_charges', 'lng')) {
                $table->string('lng')->nullable()->after('lat');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasTable('concession_charges')) {
            return;
        }

        Schema::table('concession_charges', function (Blueprint $table) {
            if (Schema::hasColumn('concession_charges', 'radius')) {
                $table->dropColumn('radius');
            }

            if (Schema::hasColumn('concession_charges', 'fare_type')) {
                $table->dropColumn('fare_type');
            }

            if (Schema::hasColumn('concession_charges', 'applies')) {
                $table->dropColumn('applies');
            }

            if (Schema::hasColumn('concession_charges', 'lat')) {
                $table->dropColumn('lat');
            }

            if (Schema::hasColumn('concession_charges', 'lng')) {
                $table->dropColumn('lng');
            }
        });
    }
};
