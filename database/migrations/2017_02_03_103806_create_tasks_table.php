<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends BasicMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tasks')) {
            Schema::create('tasks', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->text('data');
                $table->integer('type_id')->unsigned();
                $table->foreign('type_id')->references('id')->on('task_types')->onUpdate('cascade')->onDelete('cascade');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                $table->timestamps();
            });
        } else {
            if (!Schema::hasColumn('tasks', 'id')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
            if (!Schema::hasColumn('tasks', 'name')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->string('name');
                });
            }
            if (!Schema::hasColumn('tasks', 'data')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->text('data');
                });
            }
            if (!Schema::hasColumn('tasks', 'type_id')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->integer('type_id')->unsigned();
                    $table->foreign('type_id')->references('id')->on('task_types')->onUpdate('cascade')->onDelete('cascade');
                });
            }
            if (!Schema::hasColumn('tasks', 'user_id')) {
                Schema::table('tasks', function (Blueprint $table) {
                    $table->integer('user_id')->unsigned();
                    $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                });
            }
            if (!Schema::hasColumn('tasks', 'created_at') && !Schema::hasColumn('tasks', 'updated_at')) {
                Schema::table('tasks', function (Blueprint $table) {
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
        $this->dropTablesWithoutForeignCheck(['tasks']);
    }
}
