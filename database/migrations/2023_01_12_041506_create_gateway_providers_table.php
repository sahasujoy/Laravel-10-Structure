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
        Schema::create('gateway_providers', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('provider_type')->comment('1 = SendGrid, 2 = onesignal');
            $table->text('provider_credentials')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1 = active, 2 = deactivate');
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
        Schema::dropIfExists('gateway_providers');
    }
};
