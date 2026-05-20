<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('case_study_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_study_category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('industry_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique()->index();
            $table->string('client_name')->nullable();
            $table->string('client_logo')->nullable();
            $table->text('challenge');
            $table->longText('solution');
            $table->longText('result');
            $table->string('featured_image');
            $table->json('gallery')->nullable();
            $table->string('pdf_file')->nullable();
            $table->string('cta_title')->nullable();
            $table->text('cta_text')->nullable();
            $table->string('cta_link')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('case_studies');
        Schema::dropIfExists('case_study_categories');
    }
};
