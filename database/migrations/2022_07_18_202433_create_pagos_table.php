<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->dateTime('fecha');
            $table->string('preference_id', 200)->comment('id de MP que identifica el intento de pago para inicializar el checkout');
            $table->bigInteger('payment_id')->nullable()->comment('id (codigo operacion) retornado por mp una vez efectuado el pago, indpendientemente del estado');
            $table->string('collection_id', 100);
            $table->string('collection_status', 100);
            $table->string('status', 100);
            $table->string('external_reference', 100);
            $table->string('payment_type', 100);
            $table->string('merchant_order_id', 100);
            $table->string('site_id', 100);
            $table->string('processing_mode', 100);
            $table->string('merchant_account_id', 100);
            $table->integer('id_plataforma')->index('id_plataforma');
            $table->integer('id_estado')->nullable()->index('id_estado');
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
