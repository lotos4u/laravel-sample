<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends BasicMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->increments('id');
                $table->string('value');
                $table->integer('type_id')->unsigned();
                $table->foreign('type_id')->references('id')->on('setting_types')->onUpdate('cascade')->onDelete('cascade');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                $table->timestamps();

                $table->unique(['type_id', 'user_id'], 'type_for_user_unique');
            });
        } else {
            if (!Schema::hasColumn('settings', 'id')) {
                Schema::table('settings', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
            if (!Schema::hasColumn('settings', 'value')) {
                Schema::table('settings', function (Blueprint $table) {
                    $table->string('value');
                });
            }
            if (!Schema::hasColumn('settings', 'user_id')) {
                Schema::table('settings', function (Blueprint $table) {
                    $table->integer('user_id')->unsigned();
                    $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                });
            }
            if (!Schema::hasColumn('settings', 'type_id')) {
                Schema::table('settings', function (Blueprint $table) {
                    $table->integer('type_id')->unsigned();
                    $table->foreign('type_id')->references('id')->on('setting_types')->onUpdate('cascade')->onDelete('cascade');
                });
            }
            if (!Schema::hasColumn('settings', 'created_at') && !Schema::hasColumn('settings', 'updated_at')) {
                Schema::table('settings', function (Blueprint $table) {
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
        $this->dropTablesWithoutForeignCheck(['settings']);
    }
}
