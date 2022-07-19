<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_pago', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_pago')->index('id_pago');
            $table->string('title', 100);
            $table->integer('quantity');
            $table->float('unit_price', 6);
            $table->string('description', 200)->nullable();
            $table->integer('category_id')->nullable();
            $table->string('picture_url', 200)->nullable();
            $table->integer('currency_id')->nullable();
            $table->dateTime('updated_at');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_pago');
    }
}
