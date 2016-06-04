<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupCartTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Create the products table.
         */
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->float('price');
            $table->string('image')->nullable();
            $table->integer('stock');
            $table->timestamps();
        });

        /**
         * Create the orders table.
         */
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hash');
            $table->float('total');
            $table->integer('address_id');
            $table->boolean('paid');
            $table->integer('customer_id');
            $table->timestamps();
        });

        /**
         * Create the intermediate table for Orders and Products.
         * This table includes the proper relationships.
         */
        Schema::create('orders_products', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')
                  ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')
                  ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('quantity');
        });

        /**
         * Create the customers table.
         */
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->timestamps();
        });

        /**
         * Create the addresses table.
         */
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('postal_code');
            $table->timestamps();
        });

        /**
         * Create the payments table.
         */
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->boolean('failed');
            $table->string('transaction_id')->nullable(); // Just in case something went wrong
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
        Schema::drop('products');
        Schema::drop('orders');
        Schema::drop('orders_products');
        Schema::drop('customers');
        Schema::drop('addresses');
        Schema::drop('payments');
    }
}
