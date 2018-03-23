<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStatusesTable extends BasicMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('user_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('user_status_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_status_id')->unsigned();
            $table->string('display_name');
            $table->string('description');
            $table->string('locale')->index();

            $table->unique(['user_status_id', 'locale'], 'user_status_locale_unique');
            $table->foreign('user_status_id', 'user_status_locale_foreign')->references('id')->on('user_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->dropTablesWithoutForeignCheck(['user_statuses', 'user_status_translations']);
    }
}
