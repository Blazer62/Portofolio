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
        Schema::table('projects', function (Blueprint $table) {
            $table->text('image')->nullable()->change();
            $table->text('image_url')->nullable()->change();
        });

        Schema::table('site_profiles', function (Blueprint $table) {
            $table->text('photo')->nullable()->change();
            $table->text('cv_file')->nullable()->change();
        });

        Schema::table('certificates', function (Blueprint $table) {
            $table->text('image')->nullable()->change();
            $table->text('file')->nullable()->change();
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->text('photo')->nullable()->change();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->text('image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
