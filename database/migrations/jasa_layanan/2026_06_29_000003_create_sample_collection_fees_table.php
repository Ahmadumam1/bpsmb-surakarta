<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sample_collection_fees', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedInteger('sample_count')->default(1);
            $table->unsignedInteger('fee')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sample_collection_fees');
    }
};
