<?php
class PartenairesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$result = Partenaire::getAllPartenaireInstancesFormatedForFullList();
		$this->layout->content = View::make('Partenaires.PartenairesIndex',array('data'=> $result));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content = View::make('Partenaires.PartenairesAdd');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try{
			//Mettre tous le data des inputs dans la variable $allData
			$allData = Input::all();
			$nowStamp = date('Y-m-d H:i:s');
			$allData['dfg'] = $nowStamp;
			$strValidTime = 'after:'.date('Y-m-d');
			$allData['heure'] = -1;
			$allData['minute'] = -1;

			if(strrpos($allData['heures'], ':', 0) != -1){
				$time = explode(":", $allData['heures']);
				$allData['heure'] = $time[0];
				$allData['minute'] = $time[1];
			}
			//var_dump($allData);

			//Pour faire la validation Validator::make prend 2 params qui sont des array dans cette 
			//situation. Dans le premier paramètre on assigne le nom exacte du champ dans la bd avec
			// une variable a valider. Dans le 2e param on associe au nom de champ des validations 
			$validator = Validator::make(
			    array(
			        'date' => $allData['date'],
			        'heure' => $allData['heure'],
			        'minute' => $allData['minute'],
			        'commentaire' => $allData['commentaire']
			    ),
			    array(
			    	//Les validations peuvent être séparé dans un array ou par des pipes -> "|" dans une string
			        'date' => array('required','regex:/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/',$strValidTime),
			   		'heure' => array('required', 'numeric', 'min:9', 'max:20'),
					'minute' => array('required', 'numeric', 'min:0', 'max:59'),
			   		'commentaire' => array('max:255')
			    )
			);

			//On test si le bundle de validation est ok ou non. Ici on test si les validations dans
			//la variable $validator est un fail
			if ($validator->fails()){
				//Si non valide

				//Mettre les messages d'erreur dans la variable $messages
				$messages = $validator->messages();

				//Formatage de la liste d'erreurs à retourner.
				$msgToReturn ="";
				foreach ($messages->all() as $message)
				{
				    $msgToReturn = $msgToReturn.'<p>'.$message.'</p>';
				}
				
				//Variable flash (Des variables session qui sont en mémoire pour une redirection
				// seulement) qui affiche le message d'erreur
				Session::flash('message',$msgToReturn);
				Session::flash('class','danger');

				//Le retour à la vue
				$this->layout->content = View::make('Partenaires.PartenairesAdd');
			}
			else{
				//$allData
				$formatedData = array(
					'datePrevue' =>($allData['date'].' '.$allData['heure'].':'.$allData['minute'].':00'),
					'typeEscalade'=>$allData['typeEscalade'],
					'idMembre'=>$_SESSION['user']->id,
					'created_at'=>$nowStamp,
					'updated_at'=>$nowStamp);
				$result = Partenaire::create($formatedData);

				if($allData['commentaire'] !=""){
					$comment = new commentaire;
					$comment->idMembre = $_SESSION['user']->id;
					$comment->idInstance = $result->idDemande;
					$comment->commentaire = $allData['commentaire'];
					$comment->typeCommentaire = CommentaireType::DemandePartenaire;
					$comment->created_at = date('Y-m-d H:i:s');
					$comment->updated_at = date('Y-m-d H:i:s');
					$comment->save();
				}

				$notif = new Notification;
				$notif->isView = 0;
				$notif->user_id = $_SESSION['user']->id;
				$notif->message = 'Nouvelle demande de partenaire.';
				$notif->typeNotification = NotificationType::DemandePartenaire;
				$notif->instance_id = $result->idDemande;
				$notif->created_at = date('Y-m-d H:i:s');
				$notif->updated_at = date('Y-m-d H:i:s');
				$notif->save();

				//Variable flash (Des variables session qui sont en mémoire pour une redirection
				// seulement) qui affiche le message de success
				Session::flash('message','Demande crée');
				Session::flash('class','success');
				$this->layout->content = View::make('Partenaires.PartenairesAdd');
			}
			
		}
		catch(exception $e){
			//Variable flash (Des variables session qui sont en mémoire pour une redirection
			// seulement) qui affiche le message d'erreur
			Session::flash('message', 'Erreur sur le format de la date');
			Session::flash('class','danger');

			//Le retour à la vue
			$this->layout->content = View::make('Partenaires.PartenairesAdd');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$result = Partenaire::getAllPartenaireInstancesByUserId($_SESSION['user']->id);
		$this->layout->content = View::make('Partenaires.PartenairesShow',array('data'=> $result));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{	$demande = Partenaire::find($id);
		$result = Partenaire::getDemandeCreatorAndMessageByDemandeId($id);
		$usersCommentaire = ReponseDemande::GetUserWhoAcceptedDemandeByDemandeId($id,$demande->idMembre);
		$hasAlreadyProposed = ReponseDemande::doesCurrentUserHasProposedByDemandePartenaireId($id);
		$this->layout->content = View::make('Partenaires.PartenairesEdit',
			array('demande' => $result[0],
				'commentaires'=>$result[1],
				'usersCommentaire'=>$usersCommentaire,
				'hasAlreadyProposed' => $hasAlreadyProposed,
				'demandeType' => $demande->typeEscalade
				));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id){	
		$isPorpose = false;
		$allData = Input::all();
		$toChange = Partenaire::find($id);
		
		if($_SESSION['user']->id != $toChange->idMembre){
			if($allData['commentaire'] !="" && strlen($allData['commentaire']) < 256){
				$comment = new commentaire;
				$comment->idMembre = $_SESSION['user']->id;
				$comment->idInstance = $id;
				$comment->commentaire = $allData['commentaire'];
				$comment->typeCommentaire = CommentaireType::DemandePartenaire;
				$comment->created_at = date('Y-m-d H:i:s');
				$comment->updated_at = date('Y-m-d H:i:s');
				$comment->save();
			}
			if(isset($allData['propose'])){
				$toChange->hasRecivedAnOffer = '1';
				$toChange->save();
				$isPorpose = true;
				$reponseDemande = new reponseDemande;
				$reponseDemande->idMembre = $_SESSION['user']->id;
				$reponseDemande->idDemande = $toChange->idDemande;
				$reponseDemande->created_at = date('Y-m-d H:i:s');
				$reponseDemande->updated_at = date('Y-m-d H:i:s');
				$reponseDemande->save();
			}
			$notif = new Notification;
				$notif->isView = 0;
				$notif->user_id = $_SESSION['user']->id;
				if($isPorpose){
					$notif->message = 'Vous avez fait une proposition d\'acceptation à une demande de partenaire.';
				}
				else{
					$notif->message = 'Vous avez fait un commentaire sur une demande de partenaire.';
				}
				
				$notif->typeNotification = NotificationType::DemandePartenaire;
				$notif->instance_id = $toChange->idDemande;
				$notif->created_at = date('Y-m-d H:i:s');
				$notif->updated_at = date('Y-m-d H:i:s');
				$notif->save();

			$notif = new Notification;
				$notif->isView = 0;
				$notif->user_id = $toChange->idMembre;
				if($isPorpose){
					$notif->message = 'Un utilisateur vous propose de faire équipe.';
				}
				else{
					$notif->message = 'Un utilisateur à commenté une de vos demande.';
				}
				$notif->typeNotification = NotificationType::DemandePartenaire;
				$notif->instance_id = $toChange->idDemande;
				$notif->created_at = date('Y-m-d H:i:s');
				$notif->updated_at = date('Y-m-d H:i:s');
				$notif->save();
		}
		else{

			
			if(isset($allData['effacer'])){
				$resultDel = Partenaire::deleteDemandePartenaireInstance($id);
				return Redirect::action('PartenairesController@show',array($_SESSION['user']->id));
			}
			else{
				if($allData['commentaire'] !="" && strlen($allData['commentaire']) < 256){
				$comment = new commentaire;
				$comment->idMembre = $_SESSION['user']->id;
				$comment->idInstance = $id;
				$comment->commentaire = $allData['commentaire'];
				$comment->typeCommentaire = CommentaireType::DemandePartenaire;
				$comment->created_at = date('Y-m-d H:i:s');
				$comment->updated_at = date('Y-m-d H:i:s');
				$comment->save();
			}
				if(isset($allData['acceptOffer'])){
					$demande = Partenaire::find($id);
					$demande->hasAcceptedAnOffer = 1;
					$demande->save();
					$reponseDemandeId = ReponseDemande::GetReponseDemandeIdByUserIdAndDemandeId($allData['selectedUser'],$id);
					$reponseDemande = ReponseDemande::find($reponseDemandeId);
					$reponseDemande->isAccepted = 1;
					$reponseDemande->save();
					//mettre la réponse du user a true
					$notif = new Notification;
					$notif->isView = 0;
					$notif->user_id = $allData['selectedUser'];
					$notif->message = 'Un utilisateur à accepter votre demande de partenaire';
					$notif->typeNotification = NotificationType::DemandePartenaire;
					$notif->instance_id = $id;
					$notif->created_at = date('Y-m-d H:i:s');
					$notif->updated_at = date('Y-m-d H:i:s');
					$notif->save();

					$notif = new Notification;
					$notif->isView = 0;
					$notif->user_id = $_SESSION['user']->id;
					$notif->message = 'Vous avez accepté une offre de partenaire';
					$notif->typeNotification = NotificationType::DemandePartenaire;
					$notif->instance_id = $id;
					$notif->created_at = date('Y-m-d H:i:s');
					$notif->updated_at = date('Y-m-d H:i:s');
					$notif->save();
				}
			}
		}
		$demande = Partenaire::find($id);
		$result = Partenaire::getDemandeCreatorAndMessageByDemandeId($id);
		$hasAlreadyProposed = ReponseDemande::doesCurrentUserHasProposedByDemandePartenaireId($id);
		$usersCommentaire = ReponseDemande::GetUserWhoAcceptedDemandeByDemandeId($id,$demande->idMembre);
		$this->layout->content = View::make('Partenaires.PartenairesEdit',array(
			'demande' => $result[0],
			'commentaires'=>$result[1],
			'usersCommentaire'=>$usersCommentaire,
			'hasAlreadyProposed' => $hasAlreadyProposed,
			'demandeType' => $demande->typeEscalade
			));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->layout->content = View::make('Partenaires.PartenairesDestroy',array('data'=>$id));
	}
}
?>