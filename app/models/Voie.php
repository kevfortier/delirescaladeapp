<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Voie extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $fillable = array('idMembre','idDifficulte','nomVoie',
		'nbMouvements','couleurPrise','isActive',
		'isDeleted','created_at','updated_at');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'voie';

	protected $primaryKey = 'idVoie';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static function getVoieCompleteDataById($id){
		return $listeVoies = DB::table('voie')
			->select('users.id AS idUser','users.pseudo','users.nom AS nomUser',
				'users.prenom','users.type AS typeUser','voie.idVoie', 'nbMouvements',
				'voie.nomVoie','voie.couleurPrise','voie.idSecteur', 'voie.idDifficulte',
				'voie.updated_at','typedifficulte.typeVoie','voie.dateOuverture',
				'typedifficulte.nomDifficulte','typedifficulte.couleurDifficulte')
			->join('users','users.id','=','voie.idMembre')
			->join('typedifficulte','typedifficulte.idTypeDifficulte','=','voie.idDifficulte')
			->where('voie.idVoie','=',$id)
			->first();
	}

	public static function getAllActiveUndeletedVoies(){
		try{
			$listeVoies = DB::table('voie')
			->select('users.id AS idUser','users.pseudo','users.nom AS nomUser',
				'users.prenom','users.type AS typeUser','voie.idVoie',
				'voie.nomVoie','voie.couleurPrise','voie.idSecteur',
				'voie.updated_at','typedifficulte.typeVoie',
				'typedifficulte.nomDifficulte','typedifficulte.couleurDifficulte')
			->join('users','users.id','=','voie.idMembre')
			->join('typedifficulte','typedifficulte.idTypeDifficulte','=','voie.idDifficulte')
			->where('dateOuverture','<',date('Y-m-d H:i:s'))
			->where('isDeleted','=',0);

			if(Input::get('typeVoie')){
	    		$listeVoies->where('typedifficulte.typeVoie', '=', Input::get('typeVoie'));
	    	}

	    	if(Input::get('couleurVoie')){
	    		$listeVoies->where('typedifficulte.couleurDifficulte', '=', Input::get('couleurVoie'));
	    	}
	    	
	    	if(Input::get('nomVoie')){
	    		$listeVoies->where('voie.nomVoie', 'like', "%".Input::get('nomVoie')."%");
	    	}
	    	
			return $listeVoies->paginate(24);
		}
		catch(Exception $e){
			return 'error';
		}
	}

	public static function getAllDifficultees(){
		try{
			return $listediffs = DB::table('typedifficulte')->get();
		}
		catch(Exception $e){
			return 'error';
		}
	}
}
