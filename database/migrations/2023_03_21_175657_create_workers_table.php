<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birth_date');
            $table->date('hiring_date');
            $table->bigInteger('gender_id')->unsigned();
            $table->foreign('gender_id')->references('id')->on('genders')
				->onDelete('cascade')
				->onUpdate('cascade');
            $table->bigInteger('Specialization_id')->unsigned();
            $table->foreign('Specialization_id')->references('id')->on('specializations')
				->onDelete('cascade')
				->onUpdate('cascade');
            $table->string('adress');
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
        Schema::dropIfExists('workers');
    }
}
