<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class RolesTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $exists=\App\Models\Auth\Role::query()->count();
        if ($exists==0)
        {
            $roles = (new \App\Repositories\Access\RoleRepository())->query()->firstOrCreate(['id' => '1'],[
                'name' => 'System Admin',
                'description' => 'Administrator',
                'isactive' => '1',
                'isadmin' => '1',
            ]);
            $roles = (new \App\Repositories\Access\RoleRepository())->query()->firstOrCreate(['id' => '2'],[
                'name' => 'Tour Operator',
                'description' => 'Tour Operator',
                'isactive' => '1',
                'isadmin' => '0',
            ]);
            $roles = (new \App\Repositories\Access\RoleRepository())->query()->firstOrCreate(['id' => '3'],[
                'name' => 'Tourist',
                'description' => 'Tourist',
                'isactive' => '1',
                'isadmin' => '0',
            ]);
        }
    }
}
