<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminstratorDBSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => "Admin",
            "email" => "admin@admin.com",
            "mobile" => "01205389327",
            "password" =>bcrypt('12345678'),
            "email_verified_at" => now(),
            "mobile_verified_at" => now(),
            "role_name" => "Super Admin",
        ]);

        $role = Role::create(['name' => 'admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions); // multiple permissions
        $user->assignRole([$role->id]);

      $cashier = User::create([
            'name' => "sales man",
            "email" => "sales_man@gmail.com",
            "mobile" => "019393333",
            "password" =>bcrypt('12345678'),
            "email_verified_at" => now(),
            "mobile_verified_at" => now(),
            "role_name" => "cashier",
        ]);
        $cashier->assignRole('cashier');

        /*  $cashier2 = User::create([
            'name' => " Ali Jabr",
            "email" => "ali_jbr@gmail.com",
            "mobile" => "0123004327",
            "password" =>bcrypt('12345678'),
            "email_verified_at" => now(),
            "mobile_verified_at" => now(),
            "role_name" => "cashier",
        ]);
        $cashier2->assignRole('cashier');

        $delivery = User::create([
            'name' => " Khaled Ali",
            "email" => "khaled_ali@gmail.com",
            "mobile" => "0121104327",
            "password" =>bcrypt('12345678'),
            "email_verified_at" => now(),
            "mobile_verified_at" => now(),
            "role_name" => "delivery",
        ]);
        $delivery->assignRole('delivery');

        $delivery2 = User::create([
            'name' => "Adel Ahmed",
            "email" => "adel_ahmed@gmail.com",
            "mobile" => "012998327",
            "password" =>bcrypt('12345678'),
            "email_verified_at" => now(),
            "mobile_verified_at" => now(),
            "role_name" => "delivery",
        ]);

        $delivery2->assignRole('delivery');

        $delivery3= User::create([
            'name' => "Zaeen Mohamed",
            "email" => "zaeen_mohamed@gmail.com",
            "mobile" => "012933327",
            "password" =>bcrypt('12345678'),
            "email_verified_at" => now(),
            "mobile_verified_at" => now(),
            "role_name" => "delivery",
        ]);
        $delivery3->assignRole('delivery')*/;

    }
}
