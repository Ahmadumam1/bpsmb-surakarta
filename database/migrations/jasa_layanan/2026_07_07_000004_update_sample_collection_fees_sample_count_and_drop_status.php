<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sample_collection_fees', function (Blueprint $table) {
            if (! Schema::hasColumn('sample_collection_fees', 'sample_count')) {
                $table->unsignedInteger('sample_count')->default(1)->after('description');
            }
        });

        if (Schema::hasColumn('sample_collection_fees', 'unit')) {
            DB::table('sample_collection_fees')
                ->select(['id', 'unit'])
                ->orderBy('id')
                ->get()
                ->each(function (object $row): void {
                    preg_match('/\d+/', (string) $row->unit, $matches);

                    DB::table('sample_collection_fees')
                        ->where('id', $row->id)
                        ->update(['sample_count' => max(1, (int) ($matches[0] ?? 1))]);
                });
        }

        Schema::table('sample_collection_fees', function (Blueprint $table) {
            if (Schema::hasColumn('sample_collection_fees', 'unit')) {
                $table->dropColumn('unit');
            }

            if (Schema::hasColumn('sample_collection_fees', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }

    public function down(): void
    {
        Schema::table('sample_collection_fees', function (Blueprint $table) {
            if (! Schema::hasColumn('sample_collection_fees', 'unit')) {
                $table->string('unit')->default('1 sample')->after('description');
            }

            if (! Schema::hasColumn('sample_collection_fees', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('fee');
            }
        });

        if (Schema::hasColumn('sample_collection_fees', 'sample_count')) {
            DB::table('sample_collection_fees')
                ->select(['id', 'sample_count'])
                ->orderBy('id')
                ->get()
                ->each(function (object $row): void {
                    DB::table('sample_collection_fees')
                        ->where('id', $row->id)
                        ->update(['unit' => max(1, (int) $row->sample_count).' sample']);
                });
        }

        Schema::table('sample_collection_fees', function (Blueprint $table) {
            if (Schema::hasColumn('sample_collection_fees', 'sample_count')) {
                $table->dropColumn('sample_count');
            }
        });
    }
};
