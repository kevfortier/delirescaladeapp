<?php

class AdministrationController extends \BaseController {

	public function index()
	{

		$result = User::getAllUser();

		$this->layout->content = View::make('Utilisateurs.UtilisateursIndex', array('data'=> $result));
	}

	public function show($id)
	{
		$result = User::getUserById($id);
		$this->layout->content = View::make('Utilisateurs.UtilisateursInfo', array('result' => $result));
	}
	
	public function store()
	{
		//Pour changer le type de compte d'un utilisateur (Grimpeur, Traceur, Administrateur)
		if(isset($_POST['saveAccountType']))
		{
			$allData = Input::all();
			var_dump($allData);

			echo "<script>alert('on rentre dans le store de AdministrationController.php')</script>"; //DEBUG CODE

			//Mettre le code pour changer le type de compte de l'utilisateur
			try {
				if(Administration::updateLeCompte($allData['idCompteCliquer'], $allData['typeDUtilisateur']) == true)
				{
					Session::flash('message','Le compte a été mis a jour');
					Session::flash('class','success');

					$result = User::getUserById($allData['idCompteCliquer']);
					//$this->layout->content = View::make('Utilisateurs.UtilisateursInfo', array('result' => $result));

					return Redirect::action('UtilisateursController@show',array($result->id));
				}
				else
				{
					throw new Exception("Erreur lors du changement du type de compte", 1);
				}
			}
			//Si erreur
			catch(exception $e){
				Session::flash('message',$e->getMessage());
				Session::flash('class','danger');

				$result = User::getUserById($allData['idCompteCliquer']);
				//$this->layout->content = View::make('Utilisateurs.UtilisateursInfo', array('result' => $result));

				return Redirect::action('UtilisateursController@show',array($result->id));
			}
		}
		
		//Pour le deuxième bouton de la page afin de permmettre la suppression du compte
		if(isset($_POST['supprimeCompte']))
		{
			$allData = Input::all();

			echo "<script>alert('on rentre dans le store de AdministrationController.php pour l option de la suppression')</script>"; //DEBUG CODE

			try {
				if(Administration::suppressionCompte($allData['idCompteCliquer'], $allData['emailDeAdminFaisantAction'],$allData['pseudoDeAdminFaisantAction'], $allData['raisonDeSuppression'] ) == true)
				{
					//Retour à la vue listant tous les utilisateurs de la base de données
					$result = User::getAllUser();
					//$this->layout->content = View::make('Utilisateurs.UtilisateursIndex', array('data'=> $result));
					return Redirect::action('UtilisateursController@index');
				}
				else
				{
					throw new Exception("Erreur lors de la suppression du compte", 1);
				}
			} catch (Exception $e) {
				Session::flash('message',$e->getMessage());
				Session::flash('class','danger');

				$result = User::getUserById($allData['idCompteCliquer']);
				$this->layout->content = View::make('Utilisateurs.UtilisateursInfo', array('result' => $result));
			}
		}

		
		//Pour le troisième bouton de la page afin de permmettre la sauvegarde des nouvelles informations du compte
		if(isset($_POST['saveAcountInfo']))
		{
			try{
				$sameEmail = false;

				//Mettre tous le data des inputs dans la variable $allData
				$allData = Input::all();

				$testData = User::find($allData['idCompteCliquer']);
				
				//Mettre en majuscule
				$allData['codePostal'] = strtoupper($allData['codePostal']);

				//Si la date est vide passer null pour bypasser la validation
				if($allData['dateNaissance'] ==''){
					$allData['dateNaissance'] = null;
				}
				
				if($testData->email == $allData['email']){
					$allData['email'] = "dummyemailtopassvalidation@unique.qwerty";
					$sameEmail=true;
				}
				//Pour faire la validation Validator::make prend 2 params qui sont des array dans cette 
				//situation. Dans le premier paramètre on assigne le nom exacte du champ dans la bd avec
				// une variable a valider. Dans le 2e param on associe au nom de champ des validations 
				$validator = Validator::make(
				    array(
				        
				        'email' => $allData['email'],
				       // 'password' => $allData['password'],
				        'cellulaire' => $allData['cellulaire'],
				        'telephone' => $allData['telephone'],
				        'prenom' => $allData['prenom'],
				        'nom' => $allData['nom'],
				        'dateNaissance' => $allData['dateNaissance'],
				        'noCivique' => $allData['noCivique'],
				        'rue' => $allData['rue'],
				        'ville' => $allData['ville'],
				        'codePostal' => $allData['codePostal'],
				    ),
				    array(

				    	//Les validations peuvent être séparé dans un array ou par des pipes -> "|" dans une string
				    	
				        'email' => array('required','unique:users','email','max:255'),
				        'cellulaire' => array('regex:/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/'),
				        'telephone' => array('regex:/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/'),
				        'prenom' => array('max:100'),
				        'nom' => array('max:100'),
				        'dateNaissance' => array('regex:/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/'),
				        'noCivique' => array('max:10'),
				        'rue' => array('max:80'),
				        'ville' => array('max:80'),
				        'codePostal' => array('regex:/^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/'),
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
					$result = User::getUserById($allData['idCompteCliquer']);
					return Redirect::action('UtilisateursController@show',array($result->id));
				}
				else{
					
					$result = User::find($allData['idCompteCliquer']);
					$result->prenom =$allData['prenom'];
					$result->nom =$allData['nom'];
					$result->dateNaissance =$allData['dateNaissance'];
					if(!$sameEmail){
						$result->email =$allData['email'];
					}
					$result->telephone =$allData['telephone'];
					$result->cellulaire =$allData['cellulaire'];
					$result->noCivique =$allData['noCivique'];
					$result->rue = $allData['rue'];
					$result->ville =$allData['ville'];
					$result->codePostal =$allData['codePostal'];
					$result->save();

					Session::flash('message','Les informations du compte ont été mises à jour');
					Session::flash('class','success');

					//Le retour à la vue
					$result = User::getUserById($allData['idCompteCliquer']);
					return Redirect::action('UtilisateursController@show',array($result->id));
				}
			}	
			catch(exception $e){

				/*'Une erreur est survenue, réessayez l\'enregistrement.'*/

				//Variable flash (Des variables session qui sont en mémoire pour une redirection
				// seulement) qui affiche le message d'erreur
				Session::flash('message', $e->getMessage());
				Session::flash('class','danger');
				//$result = User::find();
				
				$result = User::getUserById($allData['idCompteCliquer']);
				return Redirect::action('UtilisateursController@show',array($result->id));
			}
		}


	}


	
	
}
