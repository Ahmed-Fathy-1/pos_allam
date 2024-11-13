<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
class PermessionDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
         DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();
        $permissions = [
            'home',
            "product",
            "create_product",
            "edit_product",
            "delete_product",
            'category',
            'create_category',
            "edit_category",
            "delete_category",
            "banner",
            "create_banner",
            "edit_banner",
            "delete_banner",
            "coupon",
            "create_coupon",
            "edit_coupon",
            "delete_coupon",
            "cashier",
            "orders",
            "invoices",
            "delivery",
            "employee",
            "create_employee",
            "edit_employee",
            "delete_employee",
            "role",
            "create_role",
            "edit_role",
            "delete_role",
            "setting",
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
