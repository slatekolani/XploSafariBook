<?php

use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $exists = \App\Models\Auth\User::query()->count();
        if ($exists == 0) {
            $admin = (new \App\Repositories\Access\UserRepository())->query()->firstOrCreate(['id' => '1'],
                [
                    'username' => 'Edgar Bonaventure',
                    'email' => 'edgarfwalo99@gmail.com',
                    'phone' => '0743154530',
                    'password' => bcrypt('00001111'),
                    'confirmation_code' => '101010',
                    'role' => '1',
                ]);
            $admin->roles()->sync([1]);

            $tour_operator = (new \App\Repositories\Access\UserRepository())->query()->firstOrCreate(['id' => '2'],
                [
                    'username' => 'Gaudence Bonaventure',
                    'email' => 'gaudence@gmail.com',
                    'phone' => '0657485848',
                    'password' => bcrypt('00001111'),
                    'confirmation_code' => '202020',
                    'role' => '2',
                ]);
            $tour_operator->roles()->sync([2]);
        }
        $tourist = (new \App\Repositories\Access\UserRepository())->query()->firstOrCreate(['id' => '3'],
            [
                'username' => 'Deogratius Bonaventure',
                'email' => 'deogratius@gmail.com',
                'phone' => '0758493929',
                'password' => bcrypt('00001111'),
                'confirmation_code' => '303030',
                'role' => '3',
            ]);
        $tourist->roles()->sync([3]);
    }
}

