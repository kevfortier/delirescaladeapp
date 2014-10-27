<?php

class MdpController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->layout->content = View::make('Mdp.MdpIndex');
	}
	
	public function store()
	{

		//echo "<script>alert('on rentre dans le store')</script>"; //DEBUG CODE

		//Mettre le code pour changer le mot de passe
		try {
			//Mettre tous le data des inputs dans la variable $allData
			$allData = Input::all();

			//var_dump($allData);//DEBUG CODE

			//Verifie si les deux mots de passe sont identiques
			if ($allData['password1'] != $allData['password2']) {
				
				//echo "<script>alert('Les passwords sont NON identiques')</script>"; //DEBUG CODE

				throw new exception('Les deux champs des mots de passe ne sont pas identiques!');
			}
			else
			{

				//echo "<script>alert('Les passwords sont identiques')</script>"; //DEBUG CODE

				$validator = Validator::make(
			    array(
			    	'email' => $allData['courriel'],
			        'password' => $allData['password1'],
			        'password' => $allData['password2']
			    ),
			    array(
			    	'email' => array('required','email','max:255'),
			        'password' => array('required','max:64'),
			        'password' => array('required','max:64')
			    ));

				//On test si le bundle de validation est ok ou non. Ici on test si les validations dans
				//la variable $validator est un fail
				if ($validator->fails()){
					//Si non valide

					//echo "<script>alert('La validation a échouée')</script>"; //DEBUG CODE

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
					$this->layout->content = View::make('Mdp.MdpIndex');
				}
				else
				{
					//echo "<script>alert('La validation a réussie')</script>"; //DEBUG CODE

					//Si Les inputs sont conforme aux restrictions

					//Encryption du mot de passe
					$pwEncrypte = sha1($allData['password1']);
					
					//On envoie les informations dans la fonction pour la modification du mot de passe
					if (Mdp::changePassword($allData['courriel'], $pwEncrypte) == true) {
						
						Session::flash('message','Le mot de passe a été changé');
						Session::flash('class','success');

						//Le retour à la vue
						$this->layout->content = View::make('Mdp.MdpIndex');
					}
					else
					{
						throw new exception('Aucun compte pour cet email n a été trouvé!!');
					}

				}
			}
			
		}
		//Si erreur
		catch(exception $e){
			Session::flash('message',$e->getMessage());
			Session::flash('class','danger');
			$this->layout->content = View::make('Mdp.MdpIndex');
		}

	}
	
}
