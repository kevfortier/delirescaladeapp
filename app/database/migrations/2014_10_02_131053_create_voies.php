<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoies extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('voie', function($table){
			$table->bigIncrements('idVoie');
			$table->bigInteger('idMembre')->unsigned();
			$table->bigInteger('idDifficulte')->unsigned();
			$table->string('nomVoie',255)->nullable();
			$table->smallInteger('nbMouvements');
			$table->string('couleurPrise',255);
			$table->tinyInteger('idSecteur');
			$table->timestamp('dateOuverture');
			$table->boolean('isDeleted')->default(false);
			$table->timestamps();

			$table->foreign('idMembre')->references('id')->on('users');
			$table->foreign('idDifficulte')
			->references('idTypeDifficulte')->on('typeDifficulte');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('voie');
	}

}
