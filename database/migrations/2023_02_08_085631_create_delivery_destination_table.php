<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryDestinationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_destination', function (Blueprint $table) {
            $table->string('delivery_id', 6)->primary();
            $table->string('delivery_name_1', 50);
            $table->string('delivery_name_2', 40)->nullable();
            $table->string('delivery_furigana_1', 80);
            $table->string('delivery_furigana_2', 60)->nullable();
            $table->string('note', 50)->nullable();
            $table->string('category_delivery_id_1', 4)->nullable();
            $table->string('category_delivery_id_2', 4)->nullable();
            $table->string('category_delivery_id_3', 4)->nullable();
            $table->string('zipcode', 8);
            $table->string('province_name', 50);
            $table->string('city', 12);
            $table->string('town', 16);
            $table->string('address_home', 16)->nullable();
            $table->string('address_1', 200)->nullable();
            $table->string('address_2', 200)->nullable();
            $table->string('phone', 20);
            $table->string('fax_number', 20)->nullable();
            $table->string('author_name', 200);
            $table->string('time_created', 200);
            $table->string('people_update', 200);
            $table->string('time_updated', 200);
            $table->string('deleted', 2)->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_destination');
    }
}
