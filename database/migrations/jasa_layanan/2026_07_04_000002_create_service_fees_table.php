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
            $table->unsignedSmallInteger('unit')->default(1);
            $table->unsignedInteger('price')->default(0);
            $table->timestamps();

            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_fees');
    }
};
