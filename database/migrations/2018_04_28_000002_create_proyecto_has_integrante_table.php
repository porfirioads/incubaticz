<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoHasIntegranteTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'proyecto_has_integrante';

    /**
     * Run the migrations.
     * @table proyecto_has_integrante
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('integrante_id')->unsigned();
            $table->integer('proyecto_id')->unsigned();
            $table->string('rol', 20);

            $table->index(["proyecto_id"], 'fk_integrante_has_proyecto_proyecto1_idx');

            $table->index(["integrante_id"], 'fk_integrante_has_proyecto_integrante_idx');


            $table->foreign('integrante_id', 'fk_integrante_has_proyecto_integrante_idx')
                ->references('id')->on('integrante')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('proyecto_id', 'fk_integrante_has_proyecto_proyecto1_idx')
                ->references('id')->on('proyecto')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
