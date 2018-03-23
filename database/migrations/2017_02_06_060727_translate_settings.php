<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TranslateSettings extends BasicMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('setting_type_id')->unsigned();
            $table->string('display_name');
            $table->string('description');
            $table->string('locale')->index();

            $table->unique(['setting_type_id', 'locale']);
            $table->foreign('setting_type_id')->references('id')->on('setting_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->dropTablesWithoutForeignCheck(['setting_type_translations']);
    }
}
