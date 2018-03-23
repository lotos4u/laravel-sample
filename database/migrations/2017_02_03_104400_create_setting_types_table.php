<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingTypesTable extends BasicMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('setting_types')) {
            Schema::create('setting_types', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->tinyInteger('variantable');
                $table->string('default');
                $table->timestamps();
            });
        } else {
            if (!Schema::hasColumn('setting_types', 'id')) {
                Schema::table('setting_types', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
            if (!Schema::hasColumn('setting_types', 'name')) {
                Schema::table('setting_types', function (Blueprint $table) {
                    $table->string('name')->unique();
                });
            }
            if (!Schema::hasColumn('setting_types', 'variantable')) {
                Schema::table('setting_types', function (Blueprint $table) {
                    $table->tinyInteger('variantable');
                });
            }
            if (!Schema::hasColumn('setting_types', 'default')) {
                Schema::table('setting_types', function (Blueprint $table) {
                    $table->string('default');
                });
            }
            if (!Schema::hasColumn('setting_types', 'created_at') && !Schema::hasColumn('setting_types', 'updated_at')) {
                Schema::table('setting_types', function (Blueprint $table) {
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
        $this->dropTablesWithoutForeignCheck(['setting_types']);
    }
}
