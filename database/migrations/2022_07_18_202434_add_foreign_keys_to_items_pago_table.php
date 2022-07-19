<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToItemsPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items_pago', function (Blueprint $table) {
            $table->foreign(['id_pago'], 'items_pago_ibfk_1')->references(['id'])->on('pagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items_pago', function (Blueprint $table) {
            $table->dropForeign('items_pago_ibfk_1');
        });
    }
}
