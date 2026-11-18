<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
            $table->string('category')->nullable()->after('slug');
            $table->text('problem')->nullable()->after('description');
            $table->text('goal')->nullable()->after('problem');
            $table->string('role')->nullable()->after('goal');
            $table->text('features')->nullable()->after('role');
            $table->string('github_link', 500)->nullable()->after('live_link');
            $table->text('documentation')->nullable()->after('tech_stack');
            $table->text('feedback')->nullable()->after('documentation');
            $table->boolean('is_featured')->default(false)->after('feedback');
            $table->unsignedSmallInteger('sort_order')->default(0)->after('is_featured');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->string('role')->nullable()->after('name');
            $table->string('type')->default('contact')->after('message');
            $table->boolean('is_read')->default(false)->after('type');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->string('email')->nullable(false)->change();
            $table->dropColumn(['role', 'type', 'is_read']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'slug', 'category', 'problem', 'goal', 'role', 'features',
                'github_link', 'documentation', 'feedback', 'is_featured', 'sort_order',
            ]);
        });
    }
};
