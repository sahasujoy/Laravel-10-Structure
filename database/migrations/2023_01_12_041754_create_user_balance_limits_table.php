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
        Schema::create('user_balance_limits', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('balance_key')->index()->comment("apps = 1, notification = 2");
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('balance')->nullable();
            $table->string('current_balance')->nullable();
            $table->tinyInteger('limit_type')->default(1)->comment("1 = by default and 2 = by admin");
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
        Schema::dropIfExists('user_balance_limits');
    }
};
