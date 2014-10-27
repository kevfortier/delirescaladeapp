<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class ReponseDemande extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $fillable = array('idMembre','idDemande',
		'isAccepted','created_at','updated_at');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'reponsedemande';

	protected $primaryKey = 'idReponseDemande';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static function doesCurrentUserHasProposedByDemandePartenaireId($idDemande){
		$reponseDemandeNum = DB::table('reponseDemande')
			->where('idDemande','=', $idDemande)
			->where('idMembre','=', $_SESSION['user']->id)
			->get();
			if(count($reponseDemandeNum)>0){
				return 1;
			}
			return 0;
	}
	public static function GetUserWhoAcceptedDemandeByDemandeId($id,$demandeProprioId){
		try
		{
			$reponseCommentaire = DB::table('reponsedemande')
			->select('users.id','users.pseudo','users.nom',
				'users.prenom','users.type','users.points',
				'reponsedemande.isAccepted')
			->join('users','users.id','=','reponsedemande.idMembre')
			->where('reponsedemande.idDemande',$id)
			->where('reponsedemande.idMembre','!=',$demandeProprioId)
			->groupBy('idMembre')
			->paginate(6);

			return $reponseCommentaire;
		}
		catch(Exception $e)
		{
			return "error";
		}
	}
	public static function GetReponseDemandeIdByUserIdAndDemandeId($userId,$demandeId){
		$reponseCommentaire = DB::table('reponsedemande')
		->select('reponsedemande.idReponseDemande')
		->where('reponsedemande.idMembre','=',$userId)
		->where('reponsedemande.idDemande','=',$demandeId)
		->first();
		return $reponseCommentaire->idReponseDemande;
	}
}
