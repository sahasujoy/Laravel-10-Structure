<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_apps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('app_id',36)->index();
            $table->string('app_name',30)->index();
            $table->string('app_rest_api_key',70)->index()->nullable();
            $table->string('chrome_web_origin',100);
            $table->string('chrome_web_default_notification_icon',255)->nullable();
            $table->string('chrome_web_sub_domain',50)->nullable();
            $table->string('safari_site_origin',255)->nullable();
            $table->longText('onesignal_response')->nullable();
            $table->integer('players')->default(0);
            $table->integer('messageable_players')->default(0);
            $table->integer('last_offset')->default(0);
            $table->tinyInteger('status')->default(1)->comment("1 = active, 2= delete");
            $table->tinyInteger('process_status')->default(1)->comment("0 = pending, 1= processing");
            $table->text('notification_alert_config_code')->nullable();
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
        Schema::dropIfExists('web_apps');
    }
};
