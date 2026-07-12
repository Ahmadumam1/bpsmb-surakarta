<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_certification_infos', function (Blueprint $table) {
            foreach (['file_type', 'is_active'] as $column) {
                if (Schema::hasColumn('product_certification_infos', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('product_certification_infos', function (Blueprint $table) {
            if (! Schema::hasColumn('product_certification_infos', 'file_type')) {
                $table->string('file_type')->nullable()->after('file_path');
            }

            if (! Schema::hasColumn('product_certification_infos', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('file_type');
            }
        });
    }
};
