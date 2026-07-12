<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('calibration_scopes', function (Blueprint $table) {
            if (Schema::hasColumn('calibration_scopes', 'group') && ! Schema::hasColumn('calibration_scopes', 'category')) {
                $table->renameColumn('group', 'category');
            }
        });

        Schema::table('calibration_scopes', function (Blueprint $table) {
            if (Schema::hasColumn('calibration_scopes', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }

    public function down(): void
    {
        Schema::table('calibration_scopes', function (Blueprint $table) {
            if (Schema::hasColumn('calibration_scopes', 'category') && ! Schema::hasColumn('calibration_scopes', 'group')) {
                $table->renameColumn('category', 'group');
            }
        });

        Schema::table('calibration_scopes', function (Blueprint $table) {
            if (! Schema::hasColumn('calibration_scopes', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('item')->index();
            }
        });
    }
};
