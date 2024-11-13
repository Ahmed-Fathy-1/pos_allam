<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
            DB::table('roles')->truncate();
            DB::table('role_has_permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        $roleAdmin = Role::create(['name' => 'admin']);
        $permissions = Permission::pluck('id','id')->all();
        $roleAdmin->syncPermissions($permissions);

        $roleCashier = Role::create(['name' => 'cashier']);
        $permissionsCashier = [18];
        $roleCashier->syncPermissions($permissionsCashier);

        $roleDelivery = Role::create(['name' => 'delivery']);
        $permissionDelivery = [21];
        $roleDelivery->syncPermissions($permissionDelivery);
    }
}
