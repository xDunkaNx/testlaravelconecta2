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
        Schema::create('register_petitions', function (Blueprint $table) {
            $table->id();
            $table->string("segmentation_id")->nullable();
            $table->string("program_id")->nullable();
            $table->string("user_id")->nullable();
            $table->string("netcommerce_id")->nullable();
            $table->string("one_signal_player_id")->nullable();
            $table->string("identification_type_id")->nullable();
            $table->string("identification_number")->nullable();
            $table->string("mobile_number")->nullable();
            $table->string("meta")->nullable();
            $table->string("insitu_code_reference")->nullable();
            $table->date("birth_date")->nullable();
            $table->boolean("active")->nullable()->default(true);
            $table->string("has_updated_info")->nullable();
            $table->string("inactivate_reason")->nullable();
            $table->string("account_lockout_date")->nullable();
            $table->string("state_user_id")->nullable();
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
        Schema::dropIfExists('register_petitions');
    }
};
