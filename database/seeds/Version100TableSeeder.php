<?php

use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Illuminate\Support\Facades\DB;

/**
 * Class AccessTableSeeder.
 */
class Version100TableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();


        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        DB::commit();

    }
}
