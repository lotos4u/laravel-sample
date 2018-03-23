<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationStatusesTable extends BasicMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('notification_statuses')) {
            Schema::create('notification_statuses', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->timestamps();
            });
        } else {
            if (!Schema::hasColumn('notification_statuses', 'id')) {
                Schema::table('notification_statuses', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
            if (!Schema::hasColumn('notification_statuses', 'name')) {
                Schema::table('notification_statuses', function (Blueprint $table) {
                    $table->string('name')->unique();
                });
            }
            if (!Schema::hasColumn('notification_statuses', 'created_at') && !Schema::hasColumn('notification_statuses', 'updated_at')) {
                Schema::table('notification_statuses', function (Blueprint $table) {
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
        $this->dropTablesWithoutForeignCheck(['notification_statuses']);
    }
}
