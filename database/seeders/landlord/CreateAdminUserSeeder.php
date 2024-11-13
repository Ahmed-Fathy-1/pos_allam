<?php

namespace Database\Seeders\landlord;

use Carbon\Carbon;
use App\Models\SuperAdmin\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    private $permissions = [
        'Role-list',
        'Role-create',
        'Role-edit',
        'Role-delete',

        'User-list',
        'User-create',
        'User-edit',
        'User-delete',
        'User-restore',
        'User-forceDelete',

        'aboutUs-edit',
        'features-edit',
        'homeCover-edit',
        'mainNeeds-edit',
        'settings-edit',
        'profilePage',


        'Domain-list',

        'contactUs-list',
        'contactUs-delete',
        'contactUs-forceDeleted',
        'contactUs-restore',

        'faqs-list',
        'faqs-create',
        'faqs-forceDelete',
        'faqs-delete',
        'faqs-edit',
        'faqs-restored',
        'faqs-delete',

        'feedbacks-list',
        'feedbacks-restore',
        'feedbacks-forceDelete',
        'feedbacks-delete',

        'subNeeds-list',
        'subNeeds-create',
        'subNeeds-restore',
        'subNeeds-forceDelete',
        'subNeeds-edit',
        'subNeeds-delete',

        'packages-list',
        'package-create',
        'packages-archived',
        'packages-edit',
        'packages-delete',
        'packages-forceDelete',
        'packages-restore',

        'technologies-list',
        'technologies-create',
        'technologies-forceDelete',
        'technologies-edit',
        'technologies-delete',
        'technologies-restore',

        'tenants-list',
        'tenants-edit',
        'tenants-create',

        'payments-list',
        'payments-edit',
        'payments-delete',
        'payments-forceDelete',
        'payments-restore',
        'payments-status',

        'paymentMethods-edit',
        'paymentMethods-delete',
        'paymentMethods-create',
        'paymentMethods-list',
        'paymentMethods-forceDelete',
        'paymentMethods-restore'


    ];


    private $permissionsAdmin = [
        'faqs-list',

        'packages-list',

        'technologies-list',

        'paymentMethods-list',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create permissions
        foreach ($this->permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
        foreach ($this->permissionsAdmin as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create admin user
        $user = User::create([
            "name" => "Ahmed Fathy",
            "email" => "SuperAdmin@admin.com",
            "phone" => "01040983170",
            "password" => bcrypt('12345678'),
            "email_verified_at" => Carbon::now(),
            "phone_verified_at" => Carbon::now(),
            "image" => "feed-back-1.jpg",
        ]);

        // Create admin role
        $role = Role::firstOrCreate(['guard_name' => 'web', 'name' => 'Super Admin']);

        // Assign all permissions to the role
        $permissions = Permission::pluck('id')->toArray();
        $role->syncPermissions($permissions);

        // Assign the role to the user
        $user->assignRole($role);

        // ------------------------------------------------------------------------------------------------------------


        // Create admin user
        $user = User::create([
            "name" => "ibrahem youssef",
            "email" => "ibrahemAdmin@pos.com",
            "phone" => "01040983170",
            "password" => bcrypt('12345678'),
            "email_verified_at" => Carbon::now(),
            "phone_verified_at" => Carbon::now(),
            "image" => "feed-back-1.jpg",
        ]);

        // Create admin role
        $role = Role::firstOrCreate(['guard_name' => 'web', 'name' => 'Admin']);

        // Assign all permissions to the role
        $permissions = Permission::whereIn('id', $this->permissionsAdmin)->pluck('id')->toArray();

        $role->syncPermissions($permissions);

        // Assign the role to the user
        $user->assignRole($role);
}


}
