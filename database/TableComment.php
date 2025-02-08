<?php

namespace Database;

use Illuminate\Support\Facades\DB;

trait TableComment
{

    public function comment($table, $comment)
    {
        $driver = DB::getDriverName();
        switch ($driver) {
            case "pgsql":
                DB::statement("comment on table {$table} is '{$comment}'");
                break;
            case "mysql":
                DB::statement("ALTER TABLE {$table} COMMENT = '{$comment}'");
                break;
            default:
                DB::statement("comment on table {$table} is '{$comment}'");
        }
    }

}