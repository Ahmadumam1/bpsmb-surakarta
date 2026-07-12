<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_certification_infos', function (Blueprint $table) {
            if (! Schema::hasColumn('product_certification_infos', 'scheme')) {
                $table->string('scheme')->nullable()->after('id');
            }

            if (! Schema::hasColumn('product_certification_infos', 'category')) {
                $table->string('category')->nullable()->after('scheme');
            }

            if (! Schema::hasColumn('product_certification_infos', 'product_type')) {
                $table->string('product_type')->nullable()->after('category');
            }

            if (! Schema::hasColumn('product_certification_infos', 'reference')) {
                $table->string('reference')->nullable()->after('product_type');
            }
        });

        if (Schema::hasColumn('product_certification_infos', 'title')) {
            DB::table('product_certification_infos')
                ->whereNull('product_type')
                ->update([
                    'scheme' => 'Produk',
                    'category' => 'Informasi Sertifikasi Produk',
                    'product_type' => DB::raw('title'),
                    'reference' => '-',
                ]);
        }

        Schema::table('product_certification_infos', function (Blueprint $table) {
            if (Schema::hasColumn('product_certification_infos', 'title')) {
                $table->dropColumn('title');
            }

            if (Schema::hasColumn('product_certification_infos', 'description')) {
                $table->dropColumn('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('product_certification_infos', function (Blueprint $table) {
            if (! Schema::hasColumn('product_certification_infos', 'title')) {
                $table->string('title')->nullable()->after('id');
            }

            if (! Schema::hasColumn('product_certification_infos', 'description')) {
                $table->text('description')->nullable()->after('title');
            }
        });

        if (Schema::hasColumn('product_certification_infos', 'product_type')) {
            DB::table('product_certification_infos')
                ->whereNull('title')
                ->update([
                    'title' => DB::raw('product_type'),
                    'description' => DB::raw('reference'),
                ]);
        }

        Schema::table('product_certification_infos', function (Blueprint $table) {
            foreach (['scheme', 'category', 'product_type', 'reference'] as $column) {
                if (Schema::hasColumn('product_certification_infos', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
