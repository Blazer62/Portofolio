<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('headline')->default('Frontend Developer');
            $table->string('tagline')->nullable();
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->string('class')->nullable();
            $table->string('major')->nullable();
            $table->string('school')->nullable();
            $table->string('location')->nullable();
            $table->string('email')->nullable();
            $table->string('github')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('cv_file')->nullable();
            $table->text('interests')->nullable();
            $table->text('career_goal')->nullable();
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedTinyInteger('percentage')->default(0);
            $table->string('type')->default('hard');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('level');
            $table->string('institution');
            $table->string('major')->nullable();
            $table->string('start_year')->nullable();
            $table->string('end_year')->nullable();
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('organisasi'); // plk, organisasi, lomba
            $table->string('title');
            $table->string('organization')->nullable();
            $table->string('period')->nullable();
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('issuer')->nullable();
            $table->string('year')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();
            $table->string('type')->default('teman'); // guru, teman, pengguna, plk
            $table->text('message');
            $table->string('photo')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('tag')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('educations');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('site_profiles');
    }
};
