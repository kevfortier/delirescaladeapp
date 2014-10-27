<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table){
			$table->bigIncrements('id');
			$table->string('pseudo',40)->nullable();
			$table->string('nom',100);
			$table->string('prenom',100);
			$table->string('password',64);
			$table->date('dateNaissance',64)->nullable();
			$table->string('type',30)->nullable()->default(1);
			$table->string('email');
			$table->string('telephone',14)->nullable();
			$table->string('cellulaire',14)->nullable();
			$table->string('noCivique',10)->nullable();
			$table->string('rue',80)->nullable();
			$table->string('ville',80)->nullable();
			$table->string('codePostal',7)->nullable();
			$table->string('noMembre',32)->nullable();
			$table->integer('points')->default(0);
			$table->integer('intervalNotification')->nullable();
			$table->boolean('textNotification')->default(false);
			$table->boolean('emailNotification')->default(false);
			$table->string('idCentre',50)->nullable();
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
		Schema::drop('users');
	}
}
