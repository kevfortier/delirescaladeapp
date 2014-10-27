<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeDifficulte extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('typeDifficulte', function($table){
			$table->bigIncrements('idTypeDifficulte');
			$table->tinyInteger('typeVoie');
			$table->tinyInteger('logicalOrder');
			$table->string('nomDifficulte',255);
			$table->smallInteger('nbPoints');
			$table->string('couleurDifficulte',255);
		});
		//rose, bleu, vert, jaune, rouge, noir
		DB::table('typeDifficulte')->insert(array(
			array('typeVoie' => 1,'logicalOrder' => 1,'nomDifficulte' => '5.12B',
				'nbPoints' => 750,'couleurDifficulte' => 'pink'),
			array('typeVoie' => 1,'logicalOrder' => 2,'nomDifficulte' => '5.12C',
					'nbPoints' => 800,'couleurDifficulte' => 'blue'),
			array('typeVoie' => 1,'logicalOrder' => 3,'nomDifficulte' => '5.12D',
					'nbPoints' => 850,'couleurDifficulte' => 'blue' ),
			array('typeVoie' => 1,'logicalOrder' => 4,'nomDifficulte' => '5.13A',
					'nbPoints' => 900,'couleurDifficulte' => 'green'),
			array('typeVoie' => 1,'logicalOrder' => 5,'nomDifficulte' => '5.13B',
					'nbPoints' => 950,'couleurDifficulte' => 'yellow' ),
			array('typeVoie' => 1,'logicalOrder' => 6,'nomDifficulte' => '5.13C',
					'nbPoints' => 1000,'couleurDifficulte' => 'red'),
			array('typeVoie' => 1,'logicalOrder' => 7,'nomDifficulte' => '5.13D',
					'nbPoints' => 1050,'couleurDifficulte' => 'red'),
			array('typeVoie' => 1,'logicalOrder' => 8,'nomDifficulte' => '5.14A',
					'nbPoints' => 1100,'couleurDifficulte' => 'black'),

			array('typeVoie' => 2,'logicalOrder' => 1,'nomDifficulte' => 'V5',
					'nbPoints' => 750,'couleurDifficulte' => 'pink'),
			array('typeVoie' => 2,'logicalOrder' => 2,'nomDifficulte' => 'V6',
					'nbPoints' => 850,'couleurDifficulte' => 'blue'),
			array('typeVoie' => 2,'logicalOrder' => 3,'nomDifficulte' => 'V7',
					'nbPoints' => 900,'couleurDifficulte' => 'green'),
			array('typeVoie' => 2,'logicalOrder' => 4,'nomDifficulte' => 'V8',
					'nbPoints' => 950,'couleurDifficulte' => 'yellow'),
			array('typeVoie' => 2,'logicalOrder' => 5,'nomDifficulte' => 'V9',
					'nbPoints' => 1050,'couleurDifficulte' => 'red'),
			array('typeVoie' => 2,'logicalOrder' => 6,'nomDifficulte' => 'V10',
					'nbPoints' => 1100,'couleurDifficulte' => 'black')

		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('typeDifficulte');
	}

}
