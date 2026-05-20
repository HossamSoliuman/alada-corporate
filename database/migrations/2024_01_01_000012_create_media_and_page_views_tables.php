<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('path');
            $table->string('mime_type');
            $table->unsignedBigInteger('size');
            $table->string('alt_text')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->morphs('viewable');
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->text('referer')->nullable();
            $table->timestamp('viewed_at')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_views');
        Schema::dropIfExists('media');
    }
};
