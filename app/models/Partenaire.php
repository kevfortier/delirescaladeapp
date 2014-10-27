<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Partenaire extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $fillable = array('datePrevue','typeEscalade','idMembre','created_at','updated_at');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'demandepartenaire';

	protected $primaryKey = 'idDemande';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static function deleteDemandePartenaireInstance($idDemande){
		try{
			$deleteCommentaire = DB::table('commentaire')
				->where('typeCommentaire','=',CommentaireType::DemandePartenaire)
				->where('idInstance','=',$idDemande)
				->delete();

			$deleteReponse = DB::table('reponsedemande')
			->where('idDemande','=',$idDemande)
			->delete();

			$deleteDemande = Partenaire::find($idDemande);
			$deleteDemande->isDeleted = 1;
			$deleteDemande->save();
			return 1;
		}
		catch(Exception $e){
			return 'error';
		}
	}
	public static function getAllPartenaireInstancesByUserId($userId){
		try
		{
			$user = DB::table('demandepartenaire')
			->join('users','users.id','=','demandepartenaire.idMembre')
			->where('idMembre','=', $userId)
			->orderBy('hasAcceptedAnOffer')
			->orderBy('hasRecivedAnOffer')
			->orderBy('datePrevue');

			if(Input::get('typeEscalade')){
	    		$user->where('typeEscalade', '=', Input::get('typeEscalade'));
	    	}

	    	if(Input::get('typeStatus')){
	    		if(Input::get('typeStatus') == DemandeStatus::Fresh){
	    			$user->where('hasRecivedAnOffer', '=', 0);
	    		}
	    		else if(Input::get('typeStatus') == DemandeStatus::Answered) {
	    			$user->where('hasRecivedAnOffer', '!=', 0);
	    		}
	    		else{
	    			$user->where('hasAcceptedAnOffer', '!=', 0);
	    		}
	    	}

	    	if(Input::get('date')){
	    		if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",Input::get('date'))){
	    			$user->where('datePrevue','>=',(Input::get('date').' 00:00:00'));
	    			$user->where('datePrevue','<=',(Input::get('date').' 23:59:59'));
	    		}
	    	}

			return $user->paginate(24);
		}
		catch(Exception $e)
		{
			return "error";
		}
	}

	public static function getDemandeById($id){
		try
		{
			$result = DB::table('demandepartenaire')
				->where('idDemande',$id)
				->first();
			return $result;
		}
		catch(Exception $e)
		{
			return "error";
		}
	}

	public static function GetUserInTheCommentsByDemandeId($id){
		try
		{
			$reponseCommentaire = DB::table('commentaire')
			->select('users.id','users.pseudo','users.nom','users.prenom','users.type','users.points')
			->join('users','users.id','=','commentaire.idMembre')
			->where('idInstance',$id)
			->where('typeCommentaire',CommentaireType::DemandePartenaire)
			->where('idMembre','!=',$_SESSION['user']->id)
			->groupBy('idMembre')
			->paginate(6);

			return $reponseCommentaire;
		}
		catch(Exception $e)
		{
			return "error";
		}
	}

	public static function getDemandeCreatorAndMessageByDemandeId($id){
		try
		{
			$demande = DB::table('demandepartenaire')
			->join('users','users.id','=','demandepartenaire.idMembre')
			->where('idDemande',$id)
			->first();

			$comments = DB::table('commentaire')
			->select('commentaire.idMembre','commentaire.IdInstance','commentaire.commentaire',
				'commentaire.created_at','users.pseudo','users.nom','users.prenom','users.type')
			->join('users','users.id','=','commentaire.idMembre')
			->where('idInstance',$id)
			->where('typeCommentaire',CommentaireType::DemandePartenaire)
			->orderBy('idCommentaire')
			->paginate(6);

			$return = array($demande,$comments);
			return $return;
		}
		catch(Exception $e)
		{
			return "error";
		}
	}
	public static function getAllPartenaireHoraireFormatedForFullList(){
		try{

			$demandes = DB::table('demandepartenaire')
			->select('demandepartenaire.idMembre',
				'demandepartenaire.idDemande',
				'demandepartenaire.datePrevue',
				'demandepartenaire.typeEscalade',
				'users.pseudo','users.prenom',
				'users.nom','users.type')
			->join('reponsedemande','reponsedemande.idDemande','=','demandepartenaire.idDemande')
			->join('users','users.id','=','reponsedemande.idMembre')
			->where('demandepartenaire.hasAcceptedAnOffer', '=', 1)
			->where('reponsedemande.isAccepted', '=', 1)
			->where('demandepartenaire.datePrevue', '>=', date('Y-m-d',mktime(0, 0, 0, date("m")  , date("d")-2, date("Y"))))
			->where(function($query){
				$query->where('demandepartenaire.idMembre','=',$_SESSION['user']->id)
                      ->orWhere('reponsedemande.idMembre', '=', $_SESSION['user']->id);
			});

			if(Input::get('typeEscalade2')){
	    		$demandes->where('demandepartenaire.typeEscalade', '=', Input::get('typeEscalade2'));
	    	}
	    	if(Input::get('date2')){
	    		if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",Input::get('date2'))){
	    			$demandes->where('demandepartenaire.datePrevue','>=',(Input::get('date2').' 00:00:00'));
	    			$demandes->where('demandepartenaire.datePrevue','<=',(Input::get('date2').' 23:59:59'));
	    		}
	    	}

			return $demandes->orderBy('demandepartenaire.datePrevue')->paginate(24);
		}
		catch(Exception $e)
		{
			return "error";
		}
	}
	public static function getAllPartenaireInstancesFormatedForFullList(){
		try{

			$user = DB::table('demandepartenaire')
			->join('users','users.id','=','demandepartenaire.idMembre')
			->where('datePrevue', '>=', date('Y-m-d H:i:s'))
			->where('hasAcceptedAnOffer', '!=', 1)
			->where('idMembre','!=',$_SESSION['user']->id)
			->orderBy('hasRecivedAnOffer')
			->orderBy('datePrevue');

			if(Input::get('typeEscalade')){
	    		$user->where('typeEscalade', '=', Input::get('typeEscalade'));
	    	}
	    	if(Input::get('typeStatus')){
	    		if(Input::get('typeStatus')==DemandeStatus::Fresh){
	    			$user->where('hasRecivedAnOffer', '=', 0);
	    		}
	    		else{
	    			$user->where('hasRecivedAnOffer', '!=', 0);
	    		}
	    	}
	    	if(Input::get('date')){
	    		if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",Input::get('date'))){
	    			$user->where('datePrevue','>=',(Input::get('date').' 00:00:00'));
	    			$user->where('datePrevue','<=',(Input::get('date').' 23:59:59'));
	    		}
	    	}
			return $user->paginate(24);
		}
		catch(Exception $e)
		{
			return "error";
		}
	}
	public static function validateDate($date)
	{
	    $d = DateTime::createFromFormat('Y-m-d', $date);
	    return $d && $d->format('Y-m-d') == $date;
	}
}
