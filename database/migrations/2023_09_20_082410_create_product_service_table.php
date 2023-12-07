<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_service', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_id');
            $table->string('url');
            $table->string('heart_beat');
            $table->string('status');
            $table->string('reason');
            $table->string('resolution_comment');
            $table->timestamp('status_resolved_time')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('product_service');
    }
}
