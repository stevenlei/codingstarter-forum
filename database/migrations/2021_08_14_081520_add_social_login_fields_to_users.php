<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialLoginFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('channel')->after('password');
            $table->string('token')->after('channel');
            $table->string('channel_user_id')->after('token');
            $table->string('profile_image_url')->after('channel_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('channel');
            $table->string('token');
            $table->string('channel_user_id');
            $table->string('profile_image_url');
        });
    }
}
