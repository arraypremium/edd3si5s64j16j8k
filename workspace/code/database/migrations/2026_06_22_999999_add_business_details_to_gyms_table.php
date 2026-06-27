<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gyms', function (Blueprint $table) {
            if (! Schema::hasColumn('gyms', 'business_name')) {
                $table->string('business_name')->nullable()->after('name');
            }
            if (! Schema::hasColumn('gyms', 'business_number')) {
                $table->string('business_number', 50)->nullable()->after('business_name');
            }
            if (! Schema::hasColumn('gyms', 'business_address')) {
                $table->text('business_address')->nullable()->after('address');
            }
            if (! Schema::hasColumn('gyms', 'business_map_link')) {
                $table->string('business_map_link', 512)->nullable()->after('business_address');
            }
        });
    }

    public function down(): void
    {
        Schema::table('gyms', function (Blueprint $table) {
            $table->dropColumn(['business_name','business_number','business_address','business_map_link']);
        });
    }
};
