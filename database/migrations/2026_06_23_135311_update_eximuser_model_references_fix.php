<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $oldModel = 'VEximweb\Core\EximUser\Models\EximUser';
        $newModel = 'VEximweb\Core\Data\Models\EximUser';

        // Update vw_model_has_roles
        if (Schema::hasTable('vw_model_has_roles')) {
            $count = DB::table('vw_model_has_roles')
                ->where('model_type', $oldModel)
                ->count();
            
            $updated = DB::table('vw_model_has_roles')
                ->where('model_type', $oldModel)
                ->update(['model_type' => $newModel]);
        }

        // Update vw_activity_log
        if (Schema::hasTable('vw_activity_log')) {
            $updated = DB::table('vw_activity_log')
                ->where('subject_type', $oldModel)
                ->update(['subject_type' => $newModel]);
            
            $updated = DB::table('vw_activity_log')
                ->where('causer_type', $oldModel)
                ->update(['causer_type' => $newModel]);
        }

        // Update vw_personal_access_tokens
        if (Schema::hasTable('vw_personal_access_tokens')) {
            $updated = DB::table('vw_personal_access_tokens')
                ->where('tokenable_type', $oldModel)
                ->update(['tokenable_type' => $newModel]);
        }
    }

    public function down(): void
    {
        $oldModel = 'VEximweb\Core\EximUser\Models\EximUser';
        $newModel = 'VEximweb\Core\Data\Models\EximUser';

        if (Schema::hasTable('vw_model_has_roles')) {
            DB::table('vw_model_has_roles')
                ->where('model_type', $newModel)
                ->update(['model_type' => $oldModel]);
        }

        if (Schema::hasTable('vw_activity_log')) {
            DB::table('vw_activity_log')
                ->where('subject_type', $newModel)
                ->update(['subject_type' => $oldModel]);
            
            DB::table('vw_activity_log')
                ->where('causer_type', $newModel)
                ->update(['causer_type' => $oldModel]);
        }

        if (Schema::hasTable('vw_personal_access_tokens')) {
            DB::table('vw_personal_access_tokens')
                ->where('tokenable_type', $newModel)
                ->update(['tokenable_type' => $oldModel]);
        }
    }
};
