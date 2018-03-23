<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class TranslateNotificationTypes extends BasicMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notification_type_id')->unsigned();
            $table->string('display_name');
            $table->string('description');
            $table->string('locale')->index();

            $table->unique(['notification_type_id', 'locale'], 'not_type_locale_unique');
            $table->foreign('notification_type_id', 'not_type_locale_foreign')->references('id')->on('notification_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->dropTablesWithoutForeignCheck(['notification_type_translations']);
    }
}
