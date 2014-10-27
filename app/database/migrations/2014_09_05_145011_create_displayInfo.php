<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisplayInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('displayinfo', function($table){
			$table->bigIncrements('id');
			$table->boolean('pseudo');
			$table->boolean('nom');
			$table->boolean('prenom');
			$table->boolean('password');
			$table->boolean('dateNaissance');
			$table->boolean('type');
			$table->boolean('email');
			$table->boolean('telephone');
			$table->boolean('cellulaire');
			$table->boolean('noCivique');
			$table->boolean('rue');
			$table->boolean('ville');
			$table->boolean('codePostal');
			$table->boolean('avatar');
			$table->boolean('points');
			
			
			$table->foreign('id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('displayinfo');
	}

}
