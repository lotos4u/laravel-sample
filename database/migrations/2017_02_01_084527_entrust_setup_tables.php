<?php

use Illuminate\Database\Schema\Blueprint;

class EntrustSetupTables extends BasicMigration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        /////////////////////////////////
        // Create table for storing roles
        /////////////////////////////////
        if (!Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->string('display_name')->nullable();
                $table->string('description')->nullable();
                $table->timestamps();
            });
        } else {
            if (!Schema::hasColumn('roles', 'id')) {
                Schema::table('roles', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
            if (!Schema::hasColumn('roles', 'name')) {
                Schema::table('roles', function (Blueprint $table) {
                    $table->string('name')->unique();
                });
            }
            if (!Schema::hasColumn('roles', 'display_name')) {
                Schema::table('roles', function (Blueprint $table) {
                    $table->string('display_name')->nullable();
                });
            }
            if (!Schema::hasColumn('roles', 'description')) {
                Schema::table('roles', function (Blueprint $table) {
                    $table->string('description')->nullable();
                });
            }
            if (!Schema::hasColumn('roles', 'created_at') && !Schema::hasColumn('roles', 'updated_at')) {
                Schema::table('roles', function (Blueprint $table) {
                    $table->timestamps();
                });
            }
        }


        /////////////////////////////////////////////////////////////
        // Create table for associating roles to users (Many-to-Many)
        /////////////////////////////////////////////////////////////
        if (!Schema::hasTable('role_user')) {
            Schema::create('role_user', function (Blueprint $table) {
                $table->integer('user_id')->unsigned();
                $table->integer('role_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
                $table->primary(['user_id', 'role_id']);
            });
        } else {
            if (!Schema::hasColumn('role_user', 'user_id')) {
                Schema::table('role_user', function (Blueprint $table) {
                    $table->integer('user_id')->unsigned();
                });
            }
            if (!Schema::hasColumn('role_user', 'role_id')) {
                Schema::table('role_user', function (Blueprint $table) {
                    $table->integer('role_id')->unsigned();
                });
            }
            Schema::table('role_user', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
                $table->primary(['user_id', 'role_id']);
            });
        }


        ///////////////////////////////////////
        // Create table for storing permissions
        ///////////////////////////////////////
        if (!Schema::hasTable('permissions')) {
            Schema::create('permissions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->string('display_name')->nullable();
                $table->string('description')->nullable();
                $table->timestamps();
            });
        } else {
            if (!Schema::hasColumn('permissions', 'id')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
            if (!Schema::hasColumn('permissions', 'name')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->string('name')->unique();
                });
            }
            if (!Schema::hasColumn('permissions', 'display_name')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->string('display_name')->nullable();
                });
            }
            if (!Schema::hasColumn('permissions', 'description')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->string('description')->nullable();
                });
            }
            if (!Schema::hasColumn('permissions', 'created_at') && !Schema::hasColumn('permissions', 'updated_at')) {
                Schema::table('permissions', function (Blueprint $table) {
                    $table->timestamps();
                });
            }
        }


        ///////////////////////////////////////////////////////////////////
        // Create table for associating permissions to roles (Many-to-Many)
        ///////////////////////////////////////////////////////////////////
        if (!Schema::hasTable('permission_role')) {
            Schema::create('permission_role', function (Blueprint $table) {
                $table->integer('permission_id')->unsigned();
                $table->integer('role_id')->unsigned();
                $table->foreign('permission_id')->references('id')->on('permissions')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
                $table->primary(['permission_id', 'role_id']);
            });
        } else {
            if (!Schema::hasColumn('permission_role', 'permission_id')) {
                Schema::table('permission_role', function (Blueprint $table) {
                    $table->integer('permission_id')->unsigned();
                });
            }
            if (!Schema::hasColumn('permission_role', 'role_id')) {
                Schema::table('permission_role', function (Blueprint $table) {
                    $table->integer('role_id')->unsigned();
                });
            }
            Schema::table('permission_role', function (Blueprint $table) {
                $table->foreign('permission_id')->references('id')->on('permissions')->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
                $table->primary(['permission_id', 'role_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        $this->dropTablesWithoutForeignCheck(['permission_role', 'permissions', 'role_user', 'roles']);
    }
}
