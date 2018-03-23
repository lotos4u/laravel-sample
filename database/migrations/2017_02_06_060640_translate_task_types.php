<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class TranslateTaskTypes extends BasicMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_type_id')->unsigned();
            $table->string('display_name');
            $table->string('description');
            $table->string('locale')->index();

            $table->unique(['task_type_id', 'locale']);
            $table->foreign('task_type_id')->references('id')->on('task_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->dropTablesWithoutForeignCheck(['task_type_translations']);
    }
}
