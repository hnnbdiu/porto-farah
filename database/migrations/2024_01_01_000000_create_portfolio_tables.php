<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->json('tech_stack')->nullable();
            $table->string('github_url')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->nullable(); // material symbol name
            $table->integer('percentage')->default(0); // added based on design
            $table->string('category')->nullable(); // added based on design (Data Analysis & ML)
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->nullable(); // e.g., International Exhibition Showcase
            $table->text('description');
            $table->string('image')->nullable();
            $table->json('tags')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('body');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        Schema::create('profile_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('role')->nullable();
            $table->text('bio')->nullable();
            $table->string('foto')->nullable();
            $table->string('cv_path')->nullable();
            $table->json('sosial_media')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_settings');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('achievements');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('projects');
    }
};
