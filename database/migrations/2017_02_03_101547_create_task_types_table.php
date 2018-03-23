<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTypesTable extends BasicMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('task_types')) {
            Schema::create('task_types', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->timestamps();
            });
        } else {
            if (!Schema::hasColumn('task_types', 'id')) {
                Schema::table('task_types', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
            if (!Schema::hasColumn('task_types', 'name')) {
                Schema::table('task_types', function (Blueprint $table) {
                    $table->string('name')->unique();
                });
            }
            if (!Schema::hasColumn('task_types', 'created_at') && !Schema::hasColumn('task_types', 'updated_at')) {
                Schema::table('task_types', function (Blueprint $table) {
                    $table->timestamps();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->dropTablesWithoutForeignCheck(['task_types']);
    }
}
