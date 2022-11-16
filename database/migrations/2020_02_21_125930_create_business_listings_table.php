<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_listings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->default(1);
            $table->string('user_type')->default('admin');
            $table->text('business_name');
            $table->string('business_list_type');
            $table->string('business_list_id');
            $table->string('business_slug');
            $table->text('business_image');
            $table->integer('business_review_count');
            $table->double('business_rating');
            $table->double('business_lattitude');
            $table->double('business_longitude');
            $table->text('business_address_1');
            $table->text('business_address_3');
            $table->string('business_city');
            $table->string('business_state');
            $table->string('business_country');
            $table->string('business_phone');
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
        Schema::dropIfExists('business_listings');
    }
}
