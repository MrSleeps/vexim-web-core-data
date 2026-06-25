<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update activity_log table
        DB::table('vw_activity_log')
            ->where('subject_type', 'App\Models\EximUser')
            ->update(['subject_type' => 'VEximweb\Core\Data\Models\EximUser']);

        DB::table('vw_activity_log')
            ->where('causer_type', 'App\Models\EximUser')
            ->update(['causer_type' => 'VEximweb\Core\Data\Models\EximUser']);

        // Update model_has_role table
        DB::table('vw_model_has_roles')
            ->where('model_type', 'App\Models\EximUser')
            ->update(['model_type' => 'VEximweb\Core\Data\Models\EximUser']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert activity_log table
        DB::table('vw_activity_log')
            ->where('subject_type', 'VEximweb\Core\Data\Models\EximUser')
            ->update(['subject_type' => 'App\Models\EximUser']);

        DB::table('vw_activity_log')
            ->where('causer_type', 'VEximweb\Core\Data\Models\EximUser')
            ->update(['causer_type' => 'App\Models\EximUser']);

        // Revert model_has_role table
        DB::table('vw_model_has_roles')
            ->where('model_type', 'VEximweb\Core\Data\Models\EximUser')
            ->update(['model_type' => 'App\Models\EximUser']);
    }
};
