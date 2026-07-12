<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_fees', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('service_name');
            $table->text('description')->nullable();
            $table->string('unit', 120);
            $table->unsignedInteger('price')->default(0);
            $table->string('regulation_reference')->nullable();
            $table->unsignedSmallInteger('source_page')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'category']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_fees');
    }
};
