<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos', function (Blueprint $table) {
            $table->smallIncrements('id_ti');
            $table->string('detalle_ti');
        });
        Schema::table('turnos', function (Blueprint $table) {
            $table->unsignedSmallInteger('id_ti')->nullable();
            $table->text('obs_tu')->nullable();
            $table->foreign('id_ti')->references('id_ti')->on('tipos')->nullable();
        });
        DB::table('tipos')->insert([
            [
                'id_ti' =>  1,
                'detalle_ti' =>  'Quiero refinanciar mi deuda'
            ],
            [
                'id_ti' =>  2,
                'detalle_ti' =>  'Cómo puedo realizar el pago de mi deuda'
            ],
            [
                'id_ti' =>  3,
                'detalle_ti' =>  'Quiero conocer el valor total del adeudo'
            ],
            [
                'id_ti' =>  4,
                'detalle_ti' =>  'Ya he pagado y quiero registrar el pago del valor total del adeudo'
            ],
            [
                'id_ti' =>  5,
                'detalle_ti' =>  'Tengo otro requerimiento'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('turnos', function (Blueprint $table) {
            $table->dropForeign(['id_ti']);
            $table->dropColumn('id_ti');
            $table->dropColumn('obs_tu');
        });
        Schema::dropIfExists('tipos');
    }
}
