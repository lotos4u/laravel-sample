<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class TranslateNotificationStatuses extends BasicMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        Schema::create('notification_status_translations', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('notification_status_id')->unsigned();
        $table->string('display_name');
        $table->string('description');
        $table->string('locale')->index();

        $table->unique(['notification_status_id', 'locale'], 'not_status_locale_unique');
        $table->foreign('notification_status_id', 'not_status_locale_foreign')->references('id')->on('notification_statuses')->onDelete('cascade');
    });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->dropTablesWithoutForeignCheck(['notification_status_translations']);
    }
}
