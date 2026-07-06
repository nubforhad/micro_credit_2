<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [

            // Dashboard
            'dashboard.view',

            // User
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            // Role
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',

            // Permission
            'permission.view',
            'permission.create',
            'permission.edit',
            'permission.delete',

            // Company
            'company.view',
            'company.create',
            'company.edit',
            'company.delete',

            // Branch
            'branch.view',
            'branch.create',
            'branch.edit',
            'branch.delete',

            // Member
            'member.view',
            'member.create',
            'member.edit',
            'member.delete',

            // Loan Product
            'loan_product.view',
            'loan_product.create',
            'loan_product.edit',
            'loan_product.delete',

            // Loan
            'loan.view',
            'loan.create',
            'loan.edit',
            'loan.delete',
            'loan.approve',
            'loan.disburse',

            // Installment
            'installment.view',
            'installment.collect',

            // Savings
            'saving.view',
            'saving.create',
            'saving.deposit',
            'saving.withdraw',

            // Reports
            'report.view',

            // Settings
            'setting.view',
            'setting.edit',

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web'
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);

        $manager = Role::firstOrCreate([
            'name' => 'Manager',
            'guard_name' => 'web'
        ]);

        $collector = Role::firstOrCreate([
            'name' => 'Collector',
            'guard_name' => 'web'
        ]);

        $superAdmin->syncPermissions(Permission::all());

        $admin->syncPermissions([
            'dashboard.view',
            'member.view',
            'loan.view',
            'saving.view',
            'report.view'
        ]);
    }
}