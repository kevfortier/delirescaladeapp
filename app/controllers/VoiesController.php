<?php
class VoiesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$voies = Voie::getAllActiveUndeletedVoies();
		$this->layout->content = View::make('Voies.VoiesIndex',array('voies'=> $voies));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$diffs = Voie::getAllDifficultees();
		$this->layout->content = View::make('Voies.VoiesAdd',array('diffs'=> $diffs));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		//try{
			$allData = Input::all();

			$validator = Validator::make(
			    array(
			        'nom' => $allData['nom'],
			        'mouvements' => $allData['mouvements'],
			        'couleur' => $allData['couleur'],
			        'dateOuverture' => $allData['dateOuverture'],
			        'image' => $allData['image'],
			        'video' => $allData['video'],
			    ),
			    array(

			    	//Les validations peuvent être séparé dans un array ou par des pipes -> "|" dans une string
			    	'nom' => 'required|min:3|max:255',
			    	'mouvements' => 'required|min:0|numeric',
			    	'couleur' => 'max:255|required',
			        'dateOuverture' => array('required','regex:/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/'),
			    	'image' => array('image','mimes:jpg,JPG,jpeg,JPEG','max:1024'),// une meg maximum pour l'img
			    	'video' => array('mimes:mp4,MP4,avi,AVI,divx,DIVX,mov,MOV,mpeg,MPEG,mpg,MPG,wmv,WMV','max:40000')
			    )
			);


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
				$diffs = Voie::getAllDifficultees();
				$this->layout->content = View::make('Voies.VoiesAdd',array('diffs'=> $diffs));
			}
			else{
				$voie = new voie;
				$voie->idMembre = $_SESSION['user']->id;
				$voie->idDifficulte = $allData['difficulte'];
				$voie->nomVoie = $allData['nom'];
				$voie->nbMouvements = $allData['mouvements'];
				$voie->couleurPrise = $allData['couleur'];
				$voie->idSecteur = $allData['secteur'];
				$voie->dateOuverture = $allData['dateOuverture'];
				$voie->created_at = date('Y-m-d H:i:s');
				$voie->updated_at = date('Y-m-d H:i:s');
				$voie->save();
				var_dump($allData);


				if($_FILES['video']['error'] == 0){
			        move_uploaded_file($_FILES['video']['tmp_name'],(public_path('/img/voie/video/').$voie->idVoie));
				}
				//throw new exception($allData['idMembre']);
				//$result = Voie::create($allData);
				$file = Input::file('image');

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
					imagejpeg($image_p, public_path('/img/voie/image/'.$voie->idVoie), 100);
				}
				Session::flash('message','Voie crée');
				Session::flash('class','success');
				$diffs = Voie::getAllDifficultees();
				$this->layout->content = View::make('Voies.VoiesAdd',array('diffs'=> $diffs));
			}
		/*}	
		catch(exception $e){
			Session::flash('message', $e->getMessage());
			Session::flash('class','danger');

			//Le retour à la vue
			$diffs = Voie::getAllDifficultees();
			$this->layout->content = View::make('Voies.VoiesAdd',array('diffs'=> $diffs));
		}*/
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$uneVoie = Voie::getVoieCompleteDataById($id);
		$this->layout->content = View::make('Voies.VoiesShow',array('voie'=> $uneVoie));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		$uneVoie = Voie::getVoieCompleteDataById($id);
		$diffs = Voie::getAllDifficultees();
		$this->layout->content = View::make('Voies.VoiesEdit',array('voie'=> $uneVoie,'diffs'=> $diffs));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
		//try{
			$allData = Input::all();

			$validator = Validator::make(
			    array(
			        'nom' => $allData['nom'],
			        'mouvements' => $allData['mouvements'],
			        'couleur' => $allData['couleur'],
			        'dateOuverture' => $allData['dateOuverture'],
			        'image' => $allData['image'],
			        'video' => $allData['video'],
			    ),
			    array(

			    	//Les validations peuvent être séparé dans un array ou par des pipes -> "|" dans une string
			    	'nom' => 'required|min:3|max:255',
			    	'mouvements' => 'required|min:0|numeric',
			    	'couleur' => 'max:255|required',
			        'dateOuverture' => array('required','regex:/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/'),
			    	'image' => array('image','mimes:jpg,JPG,jpeg,JPEG','max:1024'),// une meg maximum pour l'img
			    	'video' => array('mimes:mp4,MP4,avi,AVI,divx,DIVX,mov,MOV,mpeg,MPEG,mpg,MPG,wmv,WMV','max:40000')
			    )
			);


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
				$uneVoie = Voie::getVoieCompleteDataById($id);
		$diffs = Voie::getAllDifficultees();
		$this->layout->content = View::make('Voies.VoiesEdit',array('voie'=> $uneVoie,'diffs'=> $diffs));
			}
			else{
				$voie = Voie::find($id);
				$voie->idMembre = $_SESSION['user']->id;
				$voie->idDifficulte = $allData['difficulte'];
				$voie->nomVoie = $allData['nom'];
				$voie->nbMouvements = $allData['mouvements'];
				$voie->couleurPrise = $allData['couleur'];
				$voie->idSecteur = $allData['secteur'];
				$voie->dateOuverture = $allData['dateOuverture'];
				$voie->updated_at = date('Y-m-d H:i:s');
				$voie->save();
				var_dump($allData);


				if($_FILES['video']['error'] == 0){
			        move_uploaded_file($_FILES['video']['tmp_name'],(public_path('/img/voie/video/').$voie->idVoie));
				}
				//throw new exception($allData['idMembre']);
				//$result = Voie::create($allData);
				$file = Input::file('image');

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
					imagejpeg($image_p, public_path('/img/voie/image/'.$voie->idVoie), 100);
				}
				Session::flash('message','Voie modifiée');
				Session::flash('class','success');
				$uneVoie = Voie::getVoieCompleteDataById($id);
				$diffs = Voie::getAllDifficultees();
				$this->layout->content = View::make('Voies.VoiesEdit',array('voie'=> $uneVoie,'diffs'=> $diffs));
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