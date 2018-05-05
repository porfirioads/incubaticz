<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegranteTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'integrante';

    /**
     * Run the migrations.
     * @table integrante
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre', 45);
            $table->string('pri_apellido', 45);
            $table->string('seg_apellido', 45)->nullable();
            $table->string('email');
            $table->date('nacimiento');
            $table->string('nivel_estudio', 45);
            $table->string('carrera');
            $table->string('universidad');
            $table->string('titulo_profesional')->nullable();
            $table->string('constancia_estudios')->nullable();
            $table->string('constancia_obligaciones')->nullable();
            $table->string('ine')->nullable();
            $table->string('curp')->nullable();
            $table->string('protesta_verdad')->nullable();
            $table->string('rfc')->nullable();
            $table->string('carta_sat')->nullable();

            $table->unique(["email"], 'email_UNIQUE');
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
