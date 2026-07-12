<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_certification_infos', function (Blueprint $table) {
            $table->id();
            $table->string('scheme');
            $table->string('category');
            $table->string('product_type');
            $table->string('reference');
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_certification_infos');
    }
};
