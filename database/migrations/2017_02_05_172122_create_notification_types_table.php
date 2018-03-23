<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTypesTable extends BasicMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('notification_types')) {
            Schema::create('notification_types', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->timestamps();
            });
        } else {
            if (!Schema::hasColumn('notification_types', 'id')) {
                Schema::table('notification_types', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
            if (!Schema::hasColumn('notification_types', 'name')) {
                Schema::table('notification_types', function (Blueprint $table) {
                    $table->string('name')->unique();
                });
            }
            if (!Schema::hasColumn('notification_types', 'created_at') && !Schema::hasColumn('notification_types', 'updated_at')) {
                Schema::table('notification_types', function (Blueprint $table) {
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
        $this->dropTablesWithoutForeignCheck(['notification_types']);
    }
}
