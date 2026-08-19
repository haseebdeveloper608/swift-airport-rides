<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // Branding
            $table->string('site_name')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();

            // SEO / Tracking
            $table->text('header_code')->nullable();
            $table->text('footer_code')->nullable();
            $table->string('google_analytics_id')->nullable();
            $table->string('facebook_pixel_id')->nullable();

            // Copyright
            $table->text('copyright_text')->nullable();

            // Social Links
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('tiktok')->nullable();


            // Contact Information
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();
            $table->text('company_address')->nullable();

            // Footer About
            $table->longText('footer_about')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};