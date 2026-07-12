<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lph_sections', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('tab_label');
            $table->string('eyebrow')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('items')->nullable();
            $table->string('primary_button_label')->nullable();
            $table->string('primary_button_url')->nullable();
            $table->string('secondary_button_label')->nullable();
            $table->string('secondary_button_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lph_sections');
    }
};
