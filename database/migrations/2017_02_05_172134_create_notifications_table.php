<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends BasicMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('notifications')) {
            Schema::create('notifications', function (Blueprint $table) {
                $table->increments('id');
                $table->string('subject');
                $table->text('text');
                $table->integer('type_id')->unsigned();
                $table->foreign('type_id')->references('id')->on('notification_types')->onUpdate('cascade')->onDelete('cascade');
                $table->integer('sender_id')->unsigned();
                $table->foreign('sender_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                $table->timestamps();
            });
        } else {
            if (!Schema::hasColumn('notifications', 'id')) {
                Schema::table('notifications', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
            if (!Schema::hasColumn('notifications', 'subject')) {
                Schema::table('notifications', function (Blueprint $table) {
                    $table->string('subject');
                });
            }
            if (!Schema::hasColumn('notifications', 'text')) {
                Schema::table('notifications', function (Blueprint $table) {
                    $table->text('text');
                });
            }
            if (!Schema::hasColumn('notifications', 'type_id')) {
                Schema::table('notifications', function (Blueprint $table) {
                    $table->integer('type_id')->unsigned();
                    $table->foreign('type_id', '')->references('id')->on('notification_types')->onUpdate('cascade')->onDelete('cascade');
                });
            }
            if (!Schema::hasColumn('notifications', 'status_id')) {
                Schema::table('notifications', function (Blueprint $table) {
                    $table->integer('status_id')->unsigned();
                    $table->foreign('status_id', '')->references('id')->on('notification_statuses')->onUpdate('cascade')->onDelete('cascade');
                });
            }
            if (!Schema::hasColumn('notifications', 'sender_id')) {
                Schema::table('notifications', function (Blueprint $table) {
                    $table->integer('sender_id')->unsigned();
                    $table->foreign('sender_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                });
            }
            if (!Schema::hasColumn('notifications', 'created_at') && !Schema::hasColumn('notifications', 'updated_at')) {
                Schema::table('notifications', function (Blueprint $table) {
                    $table->timestamps();
                });
            }
        }

        if (!Schema::hasTable('notification_user')) {
            Schema::create('notification_user', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('notification_id')->unsigned();
                $table->foreign('notification_id')->references('id')->on('notifications')->onUpdate('cascade')->onDelete('cascade');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                $table->integer('status_id')->unsigned();
                $table->foreign('status_id')->references('id')->on('notification_statuses')->onUpdate('cascade')->onDelete('cascade');
                $table->timestamps();

                $table->unique(['notification_id', 'user_id', 'status_id'], 'notification_with_status_for_user_unique');
            });
        } else {
            if (!Schema::hasColumn('notification_user', 'id')) {
                Schema::table('notification_user', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
            if (!Schema::hasColumn('notification_user', 'notification_id')) {
                Schema::table('notification_user', function (Blueprint $table) {
                    $table->integer('notification_id')->unsigned();
                    $table->foreign('notification_id')->references('id')->on('notifications')->onUpdate('cascade')->onDelete('cascade');
                });
            }
            if (!Schema::hasColumn('notification_user', 'user_id')) {
                Schema::table('notification_user', function (Blueprint $table) {
                    $table->integer('user_id')->unsigned();
                    $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                });
            }
            if (!Schema::hasColumn('notification_user', 'status_id')) {
                Schema::table('notification_user', function (Blueprint $table) {
                    $table->integer('status_id')->unsigned();
                    $table->foreign('status_id')->references('id')->on('notification_statuses')->onUpdate('cascade')->onDelete('cascade');
                });
            }
            if (!Schema::hasColumn('notification_user', 'created_at') && !Schema::hasColumn('notification_user', 'updated_at')) {
                Schema::table('notification_user', function (Blueprint $table) {
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
        $this->dropTablesWithoutForeignCheck(['notifications', 'notification_user']);
    }
}
