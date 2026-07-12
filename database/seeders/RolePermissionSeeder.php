<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        $permissions = [

            // Dashboard
            'dashboard.view',


            // User Management
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',


            // Role Permission
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',


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


            // Area
            'area.view',
            'area.create',
            'area.edit',
            'area.delete',


            // Center
            'center.view',
            'center.create',
            'center.edit',
            'center.delete',


            // Member
            'member.view',
            'member.create',
            'member.edit',
            'member.delete',
            'member.ledger',


            // Loan
            'loan.view',
            'loan.create',
            'loan.edit',
            'loan.delete',
            'loan.approve',
            'loan.close',
            'loan.collection',
            'loan.payment.history',
            'loan.overdue',
            'loan.report',


            // Savings
            'saving.view',
            'saving.deposit',
            'saving.edit',
            'saving.delete',
            'saving.withdraw',
            'saving.withdraw.approve',
            'saving.withdraw.reject',
            'saving.ledger',
            'saving.summary',


            // DPS
            'dps.plan',
            'dps.account',
            'dps.collection',
            'dps.maturity',
            'dps.report',
            'dps.receipt',
            'dps.due',


            // Fund
            'fund.account',
            'fund.transaction',
            'fund.ledger',


            // Income Expense
            'income.view',
            'income.create',
            'income.edit',
            'income.delete',


            // Cash Book
            'cashbook.view',


            // Reports
            'report.dashboard',
            'report.daily',


        ];


        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);

        }



        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */


        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);


        $branchManager = Role::firstOrCreate([
            'name' => 'Branch Manager',
            'guard_name' => 'web'
        ]);


        $accountant = Role::firstOrCreate([
            'name' => 'Accountant',
            'guard_name' => 'web'
        ]);


        $collector = Role::firstOrCreate([
            'name' => 'Collector',
            'guard_name' => 'web'
        ]);


        $auditor = Role::firstOrCreate([
            'name' => 'Auditor',
            'guard_name' => 'web'
        ]);




        /*
        |--------------------------------------------------------------------------
        | Admin All Permission
        |--------------------------------------------------------------------------
        */

        $admin->syncPermissions(
            Permission::all()
        );



        /*
        |--------------------------------------------------------------------------
        | Branch Manager
        |--------------------------------------------------------------------------
        */

        $branchManager->syncPermissions([

            'dashboard.view',

            'member.view',
            'member.create',
            'member.edit',
            'member.ledger',

            'loan.view',
            'loan.create',
            'loan.approve',
            'loan.collection',
            'loan.close',

            'saving.view',
            'saving.deposit',
            'saving.withdraw',

            'dps.account',
            'dps.collection',

            'report.dashboard'

        ]);




        /*
        |--------------------------------------------------------------------------
        | Accountant
        |--------------------------------------------------------------------------
        */

        $accountant->syncPermissions([

            'dashboard.view',

            'loan.view',
            'loan.payment.history',
            'loan.report',

            'saving.view',
            'saving.deposit',
            'saving.withdraw.approve',
            'saving.ledger',

            'dps.plan',
            'dps.account',
            'dps.maturity',
            'dps.report',

            'fund.account',
            'fund.transaction',
            'fund.ledger',

            'income.view',
            'income.create',
            'income.edit',

            'cashbook.view',

            'report.dashboard',
            'report.daily'

        ]);




        /*
        |--------------------------------------------------------------------------
        | Collector
        |--------------------------------------------------------------------------
        */

        $collector->syncPermissions([

            'dashboard.view',

            'member.view',

            'loan.view',
            'loan.collection',

            'saving.view',
            'saving.deposit',

            'dps.collection',

        ]);




        /*
        |--------------------------------------------------------------------------
        | Auditor
        |--------------------------------------------------------------------------
        */

        $auditor->syncPermissions([

            'dashboard.view',

            'company.view',
            'branch.view',

            'member.view',
            'member.ledger',

            'loan.view',
            'loan.report',
            'loan.payment.history',

            'saving.view',
            'saving.summary',
            'saving.ledger',

            'dps.report',

            'fund.ledger',

            'income.view',

            'cashbook.view',

            'report.dashboard',
            'report.daily'

        ]);


        app()[PermissionRegistrar::class]->forgetCachedPermissions();

    }
}