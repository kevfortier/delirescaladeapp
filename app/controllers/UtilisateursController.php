<?php
class UtilisateursController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$result = User::getAllUser();
		$this->layout->content = View::make('Utilisateurs.UtilisateursIndex', array('data'=> $result));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content = View::make('Utilisateurs.UtilisateursAdd');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//Si des erreurs sont catch on fait une redirection à la page pour s'enregistrer
		//avec des variable Flash
		try{
			//Mettre tous le data des inputs dans la variable $allData
			$allData = Input::all();

			//Mettre en majuscule
			$allData['codePostal'] = strtoupper($allData['codePostal']);

			//Si la date est vide passer null pour bypasser la validation
			/*if($allData['dateNaissance'] ==''){
				$allData['dateNaissance'] = null;
			}*/
			
			//Pour faire la validation Validator::make prend 2 params qui sont des array dans cette 
			//situation. Dans le premier paramètre on assigne le nom exacte du champ dans la bd avec
			// une variable a valider. Dans le 2e param on associe au nom de champ des validations 
			$validator = Validator::make(
			    array(
			        'pseudo' => $allData['pseudo'],
			        'email' => $allData['email'],
			        'password' => $allData['password'],
			        'confirmation' => $allData['confirmation'],
			        'telephone' => $allData['telephone'],
			        'prenom' => $allData['prenom'],
			        'nom' => $allData['nom'],
			        'dateNaissance' => $allData['dateNaissance'],
			        'noCivique' => $allData['noCivique'],
			        'rue' => $allData['rue'],
			        'ville' => $allData['ville'],
			        'codePostal' => $allData['codePostal'],
			        'avatar' => $allData['avatar']
			    ),
			    array(

			    	//Les validations peuvent être séparé dans un array ou par des pipes -> "|" dans une string
			    	'pseudo' => 'required|min:3|max:40|unique:users',
			        'email' => array('required','unique:users','email','max:255'),
			        'password' => array('required','max:64'),
			        'confirmation' => array('required', 'same:password'),
			        'telephone' => array('regex:/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/'),
			        'prenom' => array('required','max:100'),
			        'nom' => array('required','max:100'),
			        'dateNaissance' => array('required','regex:/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/'),
			        'noCivique' => array('max:10'),
			        'rue' => array('max:80'),
			        'ville' => array('max:80'),
			        'codePostal' => array('regex:/^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/'),
			    	'avatar' => array('image','mimes:jpg,JPG,jpeg,JPEG','max:1024')// une meg maximum pour l'img
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
				$this->layout->content = View::make('Utilisateurs.UtilisateursAdd');
			}
			else{
				//Si Les inputs sont conforme aux restrictions

				//Encription du mot de passe
				$allData['password'] = sha1($allData['password']);

				//On ajoute dans la bd. Pour savoir quel sont les champs qui peuvent être
				//rempli par create, allez voir dans le top du modèle des users.
				//On peut voir "protected $fillable" qui contient un array de tous les champs
				//"remplissable"
				$result = User::create($allData);
			    $file = Input::file('avatar');

			    //Si une image est choisi
				if($file != ''){

					//Des calculs de cropping si image est non carré
					list($width, $height) = getimagesize($file);
					$size = $width <= $height?$width:$height;
					$image_p = imagecreatetruecolor($size, $size);
					$image = imagecreatefromjpeg($file);
					$crop = 0;

					if($width <= $height){
						$crop = ($height-$size)/2;
						imagecopyresampled($image_p, $image, 0, 0, 0,
						 $crop, $size, $size, $size, $size);
					}
					else{
						$crop = ($width-$size)/2;
						imagecopyresampled($image_p, $image, 0, 0, $crop, 0,
						 $size, $size, $size, $size);
					}
					imagejpeg($image_p, public_path('/img/userProfileAvatar/'.$result->id), 100);
				}

				//Variable flash (Des variables session qui sont en mémoire pour une redirection
				// seulement) qui affiche le message de success
				//Session::flash('message','Profil créé');
				//Session::flash('class','success');

				//Ajout de la variable session pour la connection de l'utilisateur
				//La class stdclass() permet de crer des obj dynamiquement comme en javascript
				$user = new stdclass();
				$user->id = $result['id'];
				$user->pseudo = $result['pseudo'];
				$user->email = $result['email'];
				$user->password = $result['password'];
				$user->type = 1;

				//Ajout de l'objet avec data nécessaire dans la variable de session
				$_SESSION['user'] = $user;

				//Le retour à la vue
				$this->layout->content = View::make('Home.dashboard');
			}
		}	
		catch(exception $e){

			/*'Une erreur est survenue, réessayez l\'enregistrement.'*/

			//Variable flash (Des variables session qui sont en mémoire pour une redirection
			// seulement) qui affiche le message d'erreur
			Session::flash('message', $e->getMessage());
			Session::flash('class','danger');

			//Le retour à la vue
			$this->layout->content = View::make('Utilisateurs.UtilisateursAdd');
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
		//$userId = Input::get('id');

		$result = User::getUserById($id);
		$this->layout->content = View::make('Utilisateurs.UtilisateursInfo', array('result' => $result));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$result = User::find($id);
		$this->layout->content = View::make('Utilisateurs.ProfilePerso', array('result' => $result));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try{
			$sameEmail = false;
			$testData = User::find($id);
			//Mettre tous le data des inputs dans la variable $allData
			$allData = Input::all();
			//var_dump($allData);
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
			        //'avatar' => $allData['avatar']
			    ),
			    array(

			    	//Les validations peuvent être séparé dans un array ou par des pipes -> "|" dans une string
			    	
			        'email' => array('required','unique:users','email','max:255'),
			        //'password' => array('required','max:64'),
			        'cellulaire' => array('regex:/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/'),
			        'telephone' => array('regex:/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/'),
			        'prenom' => array('max:100'),
			        'nom' => array('max:100'),
			        'dateNaissance' => array('regex:/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/'),
			        'noCivique' => array('max:10'),
			        'rue' => array('max:80'),
			        'ville' => array('max:80'),
			        'codePostal' => array('regex:/^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/'),
			    	//'avatar' => array('image','mimes:jpg,JPG,jpeg,JPEG','max:1024')// une meg maximum pour l'img
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
				$this->layout->content = View::make('Utilisateurs.ProfilePerso', array('result' => $result));
			}
			else{
				
				$file = Input::file('avatar');

			    //Si une image est choisi
				if($file != ''){

					//Des calculs de cropping si image est non carré
					list($width, $height) = getimagesize($file);
					$size = $width <= $height?$width:$height;
					$image_p = imagecreatetruecolor($size, $size);
					$image = imagecreatefromjpeg($file);
					$crop = 0;

					if($width <= $height){
						$crop = ($height-$size)/2;
						imagecopyresampled($image_p, $image, 0, 0, 0,
						 $crop, $size, $size, $size, $size);
					}
					else{
						$crop = ($width-$size)/2;
						imagecopyresampled($image_p, $image, 0, 0, $crop, 0,
						 $size, $size, $size, $size);
					}
					imagejpeg($image_p, public_path('/img/userProfileAvatar/'.$_SESSION['user']->id), 100);
				}

				$result = User::find($id);
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
				$result->noMembre =$allData['noMembre'];
				$result->save();

				//$result->rue = str_replace('_', ' ', $result->rue);

				$this->layout->content = View::make('Utilisateurs.ProfilePerso', array('result' => $result));
			}
		}	
		catch(exception $e){

			/*'Une erreur est survenue, réessayez l\'enregistrement.'*/

			//Variable flash (Des variables session qui sont en mémoire pour une redirection
			// seulement) qui affiche le message d'erreur
			Session::flash('message', $e->getMessage());
			Session::flash('class','danger');
			$result = User::find($id);
			//Le retour à la vue
			$this->layout->content = View::make('Utilisateurs.ProfilePerso', array('result' => $result));
		}


	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}
?>
