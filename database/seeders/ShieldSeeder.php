<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_exam","view_any_exam","create_exam","update_exam","restore_exam","restore_any_exam","replicate_exam","reorder_exam","delete_exam","delete_any_exam","force_delete_exam","force_delete_any_exam","view_exam::result","view_any_exam::result","create_exam::result","update_exam::result","restore_exam::result","restore_any_exam::result","replicate_exam::result","reorder_exam::result","delete_exam::result","delete_any_exam::result","force_delete_exam::result","force_delete_any_exam::result","view_payment","view_any_payment","create_payment","update_payment","restore_payment","restore_any_payment","replicate_payment","reorder_payment","delete_payment","delete_any_payment","force_delete_payment","force_delete_any_payment","view_personal::information","view_any_personal::information","create_personal::information","update_personal::information","restore_personal::information","restore_any_personal::information","replicate_personal::information","reorder_personal::information","delete_personal::information","delete_any_personal::information","force_delete_personal::information","force_delete_any_personal::information","view_shield::role","view_any_shield::role","create_shield::role","update_shield::role","delete_shield::role","delete_any_shield::role","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","page_Themes","page_HealthCheckResults","page_Caesar","page_RC4"]},{"name":"panel_user","guard_name":"web","permissions":[]},{"name":"patient","guard_name":"web","permissions":["view_exam","view_any_exam","create_exam","update_exam","view_exam::result","view_any_exam::result","view_payment","view_any_payment"]},{"name":"Doctor","guard_name":"web","permissions":["view_exam","view_any_exam","create_exam","update_exam","view_exam::result","view_any_exam::result","create_exam::result","update_exam::result"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
