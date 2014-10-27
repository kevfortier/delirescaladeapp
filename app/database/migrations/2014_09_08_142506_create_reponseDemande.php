<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReponseDemande extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reponseDemande', function($table){
			$table->bigIncrements('idReponseDemande');
			$table->bigInteger('idMembre')->unsigned();
			$table->bigInteger('idDemande')->unsigned();
			$table->boolean('isAccepted')->default(false);
			$table->timestamps();

			$table->foreign('idMembre')->references('id')->on('users');
			$table->foreign('idDemande')->references('idDemande')->on('demandePartenaire');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reponseDemande');
	}

}
