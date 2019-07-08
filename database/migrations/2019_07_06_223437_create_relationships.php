<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });
        Schema::table('inventories', function($table)
        {
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');

        });
        Schema::table('sales_invoices', function($table)
        {
            $table->foreign('sale_id')->references('id')->on('sales')->onUpdate('cascade');
            $table->foreign('inventory_id')->references('id')->on('inventories')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relationships');
    }
}
