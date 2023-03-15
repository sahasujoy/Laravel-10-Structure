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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('app_id',36)->index();
            $table->string('player_id',36);
            $table->string('external_user_id',36);
            $table->integer('session_count')->default(0);
            $table->string('language',30)->nullable();
            $table->string('timezone',30)->nullable();
            $table->string('game_version',30)->nullable();
            $table->string('device_os',30)->nullable();
            $table->string('device_type',30)->nullable();
            $table->string('device_model',30)->nullable();
            $table->string('ad_id',36)->nullable();
            $table->string('tags')->nullable();
            $table->string('last_active',50)->nullable();
            $table->string('amount_spent')->nullable();
            $table->string('invalid_identifier')->nullable();
            $table->string('sdk')->nullable();
            $table->integer('badge_count')->default(0);
            $table->string('test_type')->nullable();
            $table->string('ip')->nullable();
            $table->tinyInteger('statue')->comment("0=pending,1=active,2=deactive");
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
        Schema::dropIfExists('players');
    }
};
