<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandePartenaire extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('demandePartenaire', function($table){
			$table->bigIncrements('idDemande');
			$table->timestamp('datePrevue');
			$table->tinyInteger('typeEscalade');
			$table->boolean('hasRecivedAnOffer')->default(false);
			$table->boolean('hasAcceptedAnOffer')->default(false);
			$table->boolean('isDeleted')->default(false);
			$table->bigInteger('idMembre')->unsigned();
			$table->timestamps();

			$table->foreign('idMembre')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('demandePartenaire');
	}

}
