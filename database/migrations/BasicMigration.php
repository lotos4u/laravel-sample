<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BasicMigration extends Migration
{

    protected function dropTablesWithoutForeignCheck(array $tableNames)
    {
        Schema::disableForeignKeyConstraints();
        foreach ($tableNames as $table) {
            Schema::dropIfExists($table);
        }
        Schema::enableForeignKeyConstraints();
    }
}