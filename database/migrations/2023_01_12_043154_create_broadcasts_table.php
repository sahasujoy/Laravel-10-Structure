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
        Schema::create('broadcasts', function (Blueprint $table) {
            $table->id();
            $table->string('app_id', 40)->index();
            $table->string('notification_id', 40)->index()->nullable();
            $table->string('message_title');
            $table->text('message');
            $table->string('image');
            $table->string('launch_url');
            $table->tinyInteger('google_chrome')->default(1);
            $table->string('google_chrome_platform_setting_icon', 150)->nullable();
            $table->string('google_chrome_platform_setting_image_url', 150)->nullable();
            $table->string('google_chrome_platform_setting_badge_url', 150)->nullable();
            $table->tinyInteger('safari')->default(1);
            $table->tinyInteger('edge')->default(1);
            $table->tinyInteger('mozilla_firefox')->default(1);
            $table->string('mozilla_firefox_platform_setting_icon', 150)->nullable();
            $table->tinyInteger('advanced_setting')->default(0)->comment('1 = active, 0 = inactive');
            $table->string('advanced_setting_collapse_id', 150)->nullable();
            $table->string('advanced_setting_web_push_topic', 150)->nullable();
            $table->tinyInteger('advanced_setting_priority')->default(1)->comment('normal = 1, high = 2');
            $table->tinyInteger('time_to_live')->default(1)->comment('normal = 1, high = 2');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('data', 255)->nullable();
            $table->string('contents', 50)->nullable();
            $table->string('filters')->nullable();
            $table->text('include_external_user_ids')->nullable();
            $table->text('include_player_ids')->nullable();
            $table->integer('ttl')->nullable();
            $table->integer('total_delivered')->default(0);
            $table->integer('total_messageable_players')->default(0);
            $table->integer('total_failed')->default(0);
            $table->tinyInteger('send_type')->default(1)->comment('1 = instant, 2 = schedule ,3 =draft');
            $table->tinyInteger('content_type')->default(1)->comment('1 = web ,2 = sms , 3 = email');
            $table->tinyInteger('status')->default(0)->comment('0 = pending, 1 = running, 2 = send, 3 = `delivered, 4 = failed');
            $table->dateTime('send_date')->default(date('Y-m-d H:i:00'));
            $table->string('error_reason')->nullable();
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
        Schema::dropIfExists('broadcasts');
    }
};
