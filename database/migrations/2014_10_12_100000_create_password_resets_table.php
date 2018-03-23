<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreatePasswordResetsTable extends BasicMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('password_resets')) {
            Schema::create('password_resets', function (Blueprint $table) {
                $table->string('email')->index();
                $table->string('token')->index();
                $table->timestamp('created_at')->nullable();
            });
        } else {
            if (!Schema::hasColumn('password_resets', 'email')) {
                Schema::table('password_resets', function (Blueprint $table) {
                    $table->string('email')->index();
                });
            }
            if (!Schema::hasColumn('password_resets', 'token')) {
                Schema::table('password_resets', function (Blueprint $table) {
                    $table->string('token')->index();
                });
            }
            if (!Schema::hasColumn('password_resets', 'created_at')) {
                Schema::table('password_resets', function (Blueprint $table) {
                    $table->timestamp('created_at')->nullable();
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
        $this->dropTablesWithoutForeignCheck(['password_resets']);
    }
}
