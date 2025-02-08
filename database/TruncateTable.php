<?php

namespace Database;

use Illuminate\Support\Facades\DB;

/**
 * Class TruncateTable.
 */
trait TruncateTable
{
    /**
     * @param $table
     *
     * @return bool
     */
    protected function truncate($table)
    {
        switch (DB::getDriverName()) {
            case 'mysql':
                return DB::table($table)->truncate();

            case 'pgsql':
                return  DB::statement('TRUNCATE TABLE ONLY '.$table.' RESTART IDENTITY');

            case 'sqlite':
                return DB::statement('DELETE FROM '.$table);
        }

        return false;
    }

    /**
     * @param $table
     * @return mixed
     */
    protected function delete($table)
    {
        return DB::statement('DELETE FROM '.$table);
    }

    /**
     * @param array $tables
     */
    protected function truncateMultiple(array $tables)
    {
        foreach ($tables as $table) {
            $this->truncate($table);
        }
    }


    /*Reset id sequence for next id*/
    protected  function alterIdSequence($table)
    {
        $last_data = DB::table($table)->orderBy('id', 'desc')->first();
        $max_id = ($last_data) ? $last_data->id : 0;
        $next_id = $max_id + 1;
        $sequence = $table . '_id_seq';
        DB::statement('ALTER SEQUENCE ' .  $sequence . ' RESTART WITH '. $next_id);
    }

}
