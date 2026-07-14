<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus service_id (FK) dan sort_order dari tabel documents
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn(['service_id', 'sort_order']);
        });

        // Hapus sort_order (beserta index-nya) dari tabel surveys
        Schema::table('surveys', function (Blueprint $table) {
            $table->dropIndex(['sort_order']);
            $table->dropColumn('sort_order');
        });
    }

    public function down(): void
    {
        // Kembalikan kolom documents
        Schema::table('documents', function (Blueprint $table) {
            $table->foreignId('service_id')->nullable()->constrained()->nullOnDelete()->after('id');
            $table->unsignedInteger('sort_order')->default(0)->after('file_type');
        });

        // Kembalikan kolom surveys
        Schema::table('surveys', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->default(0)->index()->after('file_type');
        });
    }
};
