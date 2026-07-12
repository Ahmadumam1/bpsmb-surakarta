<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->dropColumnIfExists('services', 'sort_order');
        $this->dropColumnIfExists('testing_durations', 'sort_order');
        $this->dropColumnIfExists('accreditation_scopes', 'sort_order');
        $this->dropColumnIfExists('product_certification_infos', 'sort_order');
        $this->dropColumnIfExists('sample_collection_fees', 'sort_order');
        $this->dropColumnIfExists('service_fees', 'sort_order');
        $this->dropColumnIfExists('lph_sections', 'sort_order');
        $this->dropColumnIfExists('calibration_scopes', 'group_order');
        $this->dropColumnIfExists('calibration_scopes', 'sort_order');
    }

    public function down(): void
    {
        $this->addOrderColumnIfMissing('services', 'sort_order');
        $this->addOrderColumnIfMissing('testing_durations', 'sort_order');
        $this->addOrderColumnIfMissing('accreditation_scopes', 'sort_order');
        $this->addOrderColumnIfMissing('product_certification_infos', 'sort_order');
        $this->addOrderColumnIfMissing('sample_collection_fees', 'sort_order');
        $this->addOrderColumnIfMissing('service_fees', 'sort_order');
        $this->addOrderColumnIfMissing('lph_sections', 'sort_order');
        $this->addOrderColumnIfMissing('calibration_scopes', 'group_order');
        $this->addOrderColumnIfMissing('calibration_scopes', 'sort_order');
    }

    private function dropColumnIfExists(string $table, string $column): void
    {
        if (Schema::hasColumn($table, $column)) {
            Schema::table($table, function (Blueprint $table) use ($column) {
                $table->dropColumn($column);
            });
        }
    }

    private function addOrderColumnIfMissing(string $table, string $column): void
    {
        if (! Schema::hasColumn($table, $column)) {
            Schema::table($table, function (Blueprint $table) use ($column) {
                $table->unsignedInteger($column)->default(0);
            });
        }
    }
};
