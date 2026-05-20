<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->enum('form_type', ['contact', 'inquiry', 'service_inquiry', 'callback'])->default('contact');
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->foreignId('service_id')->nullable()->constrained()->nullOnDelete();
            $table->string('subject')->nullable();
            $table->text('message');
            $table->string('source_url')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->enum('status', ['new', 'contacted', 'qualified', 'converted', 'archived'])->default('new')->index();
            $table->text('notes')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
