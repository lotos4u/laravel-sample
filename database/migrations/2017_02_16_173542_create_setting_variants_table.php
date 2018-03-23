<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingVariantsTable extends BasicMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('setting_variants')) {
            Schema::create('setting_variants', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('value');
                $table->integer('type_id')->unsigned();
                $table->foreign('type_id')->references('id')->on('setting_types')->onUpdate('cascade')->onDelete('cascade');
                $table->timestamps();
            });
        } else {
            if (!Schema::hasColumn('setting_variants', 'id')) {
                Schema::table('setting_variants', function (Blueprint $table) {
                    $table->increments('id');
                });
            }
            if (!Schema::hasColumn('setting_variants', 'name')) {
                Schema::table('setting_variants', function (Blueprint $table) {
                    $table->string('name');
                });
            }
            if (!Schema::hasColumn('setting_variants', 'value')) {
                Schema::table('setting_variants', function (Blueprint $table) {
                    $table->string('value');
                });
            }
            if (!Schema::hasColumn('setting_variants', 'type_id')) {
                Schema::table('setting_variants', function (Blueprint $table) {
                    $table->integer('type_id')->unsigned();
                    $table->foreign('type_id')->references('id')->on('setting_types')->onUpdate('cascade')->onDelete('cascade');
                });
            }
            if (!Schema::hasColumn('setting_variants', 'created_at') && !Schema::hasColumn('setting_variants', 'updated_at')) {
                Schema::table('setting_variants', function (Blueprint $table) {
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
        $this->dropTablesWithoutForeignCheck(['setting_variants']);
    }
}
