<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'pinterest')) {
                $table->string('pinterest')->nullable()->after('linkedin');
            }
            if (!Schema::hasColumn('settings', 'quora')) {
                $table->string('quora')->nullable()->after('pinterest');
            }
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (Schema::hasColumn('settings', 'pinterest')) {
                $table->dropColumn('pinterest');
            }
            if (Schema::hasColumn('settings', 'quora')) {
                $table->dropColumn('quora');
            }
        });
    }
};
