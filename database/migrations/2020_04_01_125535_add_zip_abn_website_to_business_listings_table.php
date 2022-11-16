<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddZipAbnWebsiteToBusinessListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_listings', function (Blueprint $table) {
           $table->string('business_zipcode')->nullable()->after('business_phone');
		   $table->string('business_abn')->nullable()->after('business_zipcode');
		   $table->string('business_website_url')->nullable()->after('business_abn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_listings', function (Blueprint $table) {
            //
        });
    }
}
