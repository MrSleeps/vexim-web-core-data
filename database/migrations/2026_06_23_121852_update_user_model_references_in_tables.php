<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // User model mapping
        $oldUserModel = 'App\Models\User';
        $newUserModel = 'VEximweb\Core\Data\Models\User';
        
        // EximUser model mapping
        $oldEximUserModel = 'VEximweb\Core\EximUser\Models\EximUser';
        $newEximUserModel = 'VEximweb\Core\Data\Models\EximUser';
        
        // Also handle the old App\Models\EximUser if it exists
        $oldAppEximUserModel = 'App\Models\EximUser';

        // Tables to update
        $tables = [
            'activity_log',
            'vw_activity_log',
            'model_has_roles',
            'vw_model_has_roles',
            'model_has_permissions',
            'vw_model_has_permissions',
            'personal_access_tokens',
            'vw_personal_access_tokens',
        ];

        foreach ($tables as $table) {
            if (!Schema::hasTable($table)) {
                continue;
            }

            // Update User model
            $this->updateMorphTypes($table, $oldUserModel, $newUserModel);
            
            // Update EximUser model (from old namespace)
            $this->updateMorphTypes($table, $oldEximUserModel, $newEximUserModel);
            
            // Update EximUser model (from App\Models namespace)
            $this->updateMorphTypes($table, $oldAppEximUserModel, $newEximUserModel);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // User model mapping
        $oldUserModel = 'App\Models\User';
        $newUserModel = 'VEximweb\Core\Data\Models\User';
        
        // EximUser model mapping
        $oldEximUserModel = 'VEximweb\Core\EximUser\Models\EximUser';
        $newEximUserModel = 'VEximweb\Core\Data\Models\EximUser';

        $tables = [
            'activity_log',
            'vw_activity_log',
            'model_has_roles',
            'vw_model_has_roles',
            'model_has_permissions',
            'vw_model_has_permissions',
            'personal_access_tokens',
            'vw_personal_access_tokens',
        ];

        foreach ($tables as $table) {
            if (!Schema::hasTable($table)) {
                continue;
            }

            // Revert User model
            $this->updateMorphTypes($table, $newUserModel, $oldUserModel);
            
            // Revert EximUser model (back to old namespace)
            $this->updateMorphTypes($table, $newEximUserModel, $oldEximUserModel);
        }
    }

    /**
     * Update morph type columns in a table
     * This method is used by both up() and down()
     */
    private function updateMorphTypes(string $table, string $old, string $new): void
    {
        $columns = ['subject_type', 'causer_type', 'model_type', 'tokenable_type'];
        
        foreach ($columns as $column) {
            if (!Schema::hasColumn($table, $column)) {
                continue;
            }
            
            DB::table($table)
                ->where($column, $old)
                ->update([$column => $new]);
        }
    }
};