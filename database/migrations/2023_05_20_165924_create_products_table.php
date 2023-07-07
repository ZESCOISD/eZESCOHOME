<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('name',50);
            $table->integer('category_id')->nullable();
             $table->string('icon_link',512)->nullable();
            $table->string('system_cover_image')->nullable();
             $table->string('user_manual',512)->nullable();
             $table->string('video',512)->nullable();
             $table->string('cost_saving',512)->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('number_of_clicks')->default('0');
            $table->string('url',512)->nullable();
            $table->string('test_url',512)->nullable();
            $table->string('lead_developer',50);
            $table->string('short_description',100);
            $table->string('long_description',512)->nullable();
            $table->string('tutorial_url',512)->nullable();
            $table->date('date_launched')->nullable();
            $table->date('date_decommissioned')->nullable();
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
        Schema::dropIfExists('products');
    }
}
