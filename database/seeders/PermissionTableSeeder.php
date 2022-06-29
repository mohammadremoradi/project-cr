<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'all-client-list',
            'all-my-client',
            'appointment-client',
            'client-edit',
            'client-delete',
            'client-search',
            'show-client-delete',

            'consumer',
            'consumer-file',
            'notify-email',
            'notify-sms',
            'accounting-advertise',
            'accounting-advertise-budget',
            'accounting-advertise-sourse',
            'survey',
            'setting-tag-client',
            'setting-service-client',
            'setting-status-client',
            'setting-role-list',
            'setting-role-create',
            'setting-role-edit',
            'setting-role-delete',
            "setting-user-page",
            "setting-user-role",
            "setting-user-promission",

        ];


        foreach ($permissions as $permission) {

            Permission::create(['name' => $permission]);
        }
    }
}
