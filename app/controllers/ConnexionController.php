<?php

class ConnexionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->layout->content = View::make('Connexion.ConnexionIndex');
	}
	
	public function store()
	{
		try{
			//Retrouve tous les paramètres
			$allData = Input::all();
			
			var_dump($allData); // Debug
	
			if($allData['courriel'] =='' || $allData['password'] == ''){
				throw new exception('Remplissez tous les champs!');
			}
			else
			{
				if(($result = Connexion::verifyCredentials($allData['courriel'], $allData['password']))!=null)
				{
					//var_dump($result[0]);
					$user = new stdclass();
					$user->id = $result[0]->id;
					$user->pseudo = $result[0]->pseudo;
					$user->email = $result[0]->email;
					$user->password = $result[0]->password;
					$user->type = $result[0]->type;

					//Ajout de l'objet avec data nécessaire dans la variable de session
					$_SESSION['user'] = $user;

					//Création du cookie
					$cookie = null;
					if (isset($allData['remember']))
					{
						$cookie = Cookie::make('cookieRemember', $allData['courriel'], 60*24*30);
						var_dump($cookie); //DEBUG CODE
						return Redirect::route('home')->withCookie($cookie);
					}
					//echo "<script>alert('On rentre dans la fonction updateLeCompte de Administration.php')</script>"; //DEBUG CODE

					//$this->layout->content = View::make('Home.dashboard');
					return Redirect::route('home');
				}
				else
				{
					throw new exception('Informations erronnées!');
				}
				
			}
			
		}
		//Si erreur
		catch(exception $e){
			Session::flash('message',$e->getMessage());
			Session::flash('class','danger');
			$this->layout->content = View::make('Connexion.ConnexionIndex');
		}
	}
}