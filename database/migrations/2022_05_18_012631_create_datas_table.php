<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datas', function (Blueprint $table) {
            $table->id();
            $table->integer('site_id')->comment('site_id');
            $table->tinyInteger('is_vip')->comment('1是2否');
            $table->bigInteger('user_id')->comment('user_id');
            $table->string('first_name', 255)->comment('first_name');
            $table->string('last_name', 255)->comment('last_name');
            $table->string('email', 255)->comment('邮箱');
            $table->string('city', 100)->comment('city');
            $table->string('province', 100)->comment('province');
            $table->string('province_code', 100)->comment('province_code');
            $table->string('country', 100)->comment('country');
            $table->string('country_code', 100)->comment('country_code');
            $table->string('post_code', 100)->comment('post_code');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datas');
    }
};
