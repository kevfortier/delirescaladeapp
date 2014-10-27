<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentaire extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('commentaire', function($table){
			$table->bigIncrements('idCommentaire');
			$table->bigInteger('idMembre')->unsigned();
			$table->bigInteger('idInstance')->unsigned();
			$table->string('commentaire',255)->nullable();
			$table->tinyInteger('typeCommentaire');
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
		Schema::drop('reponseDemande');
	}

}
