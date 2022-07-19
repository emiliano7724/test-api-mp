<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->foreign(['id_estado'], 'pagos_ibfk_2')->references(['id'])->on('estados');
            $table->foreign(['id_plataforma'], 'pagos_ibfk_1')->references(['id'])->on('plataformas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->dropForeign('pagos_ibfk_2');
            $table->dropForeign('pagos_ibfk_1');
        });
    }
}
