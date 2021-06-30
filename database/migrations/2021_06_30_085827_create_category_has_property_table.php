<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryHasPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_has_property', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->BigInteger('product_property_id')->unsigned();
            $table->foreign('product_property_id')->references('id')->on('product_properties');
        });
    }

    /**xs
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_has_property');
    }
}
