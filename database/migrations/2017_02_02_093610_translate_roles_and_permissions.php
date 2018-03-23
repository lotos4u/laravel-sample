<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TranslateRolesAndPermissions extends BasicMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ///////////////////////////////////////
        // Modify table for roles
        ///////////////////////////////////////
        if (Schema::hasTable('roles')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->dropColumn('display_name');
                $table->dropColumn('description');
            });
        }

        ///////////////////////////////////////
        // Create translation table for roles
        ///////////////////////////////////////
        Schema::create('role_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->string('display_name');
            $table->string('description');
            $table->string('locale')->index();

            $table->unique(['role_id', 'locale']);
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });


        ///////////////////////////////////////
        // Modify table for permissions
        ///////////////////////////////////////
        if (Schema::hasTable('permissions')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->dropColumn('display_name');
                $table->dropColumn('description');
            });
        }

        ///////////////////////////////////////
        // Create translation table for permissions
        ///////////////////////////////////////
        Schema::create('permission_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id')->unsigned();
            $table->string('display_name');
            $table->string('description');
            $table->string('locale')->index();

            $table->unique(['permission_id', 'locale']);
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Return native column 'display_name' and 'description' to the 'roles' table
        if (Schema::hasTable('roles')) {
            if (!Schema::hasColumn('roles', 'display_name')) {
                Schema::table('roles', function (Blueprint $table) {
                    $table->string('display_name')->after('name')->nullable();
                });
            }
            if (!Schema::hasColumn('roles', 'description')) {
                Schema::table('roles', function (Blueprint $table) {
                    $table->string('description')->after('display_name')->nullable();
                });
            }
        }

        // Return native column 'display_name' and 'description' to the 'permissions' table
        if (Schema::hasTable('permissions')) {
            if (!Schema::hasColumn('permissions', 'display_name')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->string('display_name')->after('name')->nullable();
                });
            }
            if (!Schema::hasColumn('permissions', 'description')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->string('description')->after('display_name')->nullable();
                });
            }
        }

        $this->dropTablesWithoutForeignCheck(['permission_translations', 'role_translations']);
    }
}
