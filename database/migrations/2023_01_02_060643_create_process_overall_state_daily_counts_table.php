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
        Schema::create('process_overall_state_daily_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('app_id', 40)->nullable();
            $table->date('daily_date')->index();
            $table->integer('total_project')->default(0);
            $table->integer('total_user')->default(0);
            $table->integer('total_notification')->default(0);
            $table->integer('total_players')->default(0);
            $table->integer('total_messageable_players')->default(0);
            $table->integer('total_delivered')->default(0);
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
        Schema::dropIfExists('process_overall_state_daily_counts');
    }
};
