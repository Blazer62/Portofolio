<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_profiles', function (Blueprint $table) {
            $table->text('cv_summary')->nullable()->after('bio');
            $table->text('languages')->nullable()->after('interests');
        });
    }

    public function down(): void
    {
        Schema::table('site_profiles', function (Blueprint $table) {
            $table->dropColumn(['cv_summary', 'languages']);
        });
    }
};
