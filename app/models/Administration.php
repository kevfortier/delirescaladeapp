<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Administration extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	
	public static function updateLeCompte($id, $nouveauTypeDeCompte)
	{
		/*echo "<script>alert('On rentre dans la fonction updateLeCompte de Administration.php')</script>"; //DEBUG CODE

		echo "<script>alert('On rentre dans la fonction updateLeCompte de Administration.php')</script>"; //DEBUG CODE
		echo "</br> id du compte cliquer : ", $id;
		echo "</br> nouveauTypeDeCompte : ", $nouveauTypeDeCompte;*/
		try {
			DB::table('users')
			->where('id', $id)
			->update(array('type'=> $nouveauTypeDeCompte));

			echo "<script>alert('Dans la fonction updateLeCompte de Administration.php la modification du type de compte a réussi)</script>"; //DEBUG CODEE
			return true;

		} catch (Exception $e) {
			throw new exception('Erreur lors de l insertion dans la base de données');

			echo "<script>alert('Dans la fonction updateLeCompte de Administration.php la modification du type de compte a échouée)</script>"; //DEBUG CODE

			return false;
		}
		
	}

	public static function suppressionCompte($id, $emailAdmin, $pseudoAdmin, $raisonDeSuppression)
	{
		echo "<script>alert('Dans la fonction suppressionCompte de Administration.php')</script>"; //DEBUG CODE

		//try {
			
			$leUser = User::find($id);

			echo "<script>alert('<?php echo $leUser ?>')</script>"; //DEBUG CODE

			$addresseCourrielDuUserASupprimer = $leUser->email;

			echo "<script>alert('<?php echo $addresseCourrielDuUserASupprimer ?>')</script>"; //DEBUG CODE

			$nbLigneSupprimes = DB::table('users')->delete($id);

			if ($nbLigneSupprimes == 1) {
				echo "<script>alert('On rentre dans le if de la fonction suppressionCompte de Administration.php la suppression a eu lieu)</script>"; //DEBUG CODE

				Administration::envoieCourrielSuppressionCompte($addresseCourrielDuUserASupprimer, $emailAdmin, $pseudoAdmin, $raisonDeSuppression);	

				return true;
			}
			else
			{
				echo "<script>alert('On rentre dans le else de la fonction suppressionCompte de Administration.php la suppression n'a pas eu lieu)</script>"; //DEBUG CODE	
				return false;	
			}
		//} catch (Exception $e) {
		//	echo "<script>alert('On rentre dans le catch de la fonction suppressionCompte de Administration.php UNE ERREUR C EST PRODUITE')</script>"; //DEBUG CODE
		//}
	}


	public static function envoieCourrielSuppressionCompte($addresseCourrielDuUserASupprimer, $emailAdmin, $pseudoAdmin, $raisonDeSuppression)
	{
		echo "<script>alert('Dans la fonction envoieCourrielSuppressionCompte de Administration.php')</script>"; //DEBUG CODE

		try {
			$destinataire = $addresseCourrielDuUserASupprimer;
			$sujet = "Suppression de votre compte sur DelirEscaladeApp.info";
			$message = "xx";

			//Demander a Sebastien si le message lui convient!
			if(empty($raisonDeSuppression))
			{
				$message = "Bonjour, votre compte a été supprimé par l'administrateur " + $pseudoAdmin + " pour la raison suivante: " + $raisonDeSuppression + "\r\nPour plus de renseignements veuillez contacter l'administrateur à l'adresse admin@delirescaladeapp.info";

				echo "<script>alert('La raison est vide')</script>"; //DEBUG CODE
			}
			else
			{
				$message = "Bonjour, votre compte a été supprimé par l'administrateur " + $pseudoAdmin + " pour une raison inconnue. " + "\r\nPour plus de renseignements veuillez contacter l'administrateur à l'adresse admin@delirescaladeapp.info";	

				echo "<script>alert('La raison n est pas vide')</script>"; //DEBUG CODE
			}
			
			echo "<script>alert('<?php echo $message; ?>')</script>"; //DEBUG CODE

			$message = wordwrap($message, 70, "\r\n"); //On coupe chacune des lignes a 70 caractères [DIXIT: php.net/manual/fr/function.mail.php]
			//$headers = "From: admin@delirescaladeapp.info" . "Reply-To: admin@delirescaladeapp.info" . "\r\n" . "X-Mailer: PHP/" . phpversion();

			//mail($destinataire, $sujet, $headers);

			//DECOMMENTER LA LIGNE D'EN DESSOUS SINON LE MAIL NE PARTIRA PAS (QUAND ON EST EN LOCAL : LAISSER EN COMMENTAIRE PCQ )
			//mail($destinataire, $sujet, $message);

			return true;
		} catch (Exception $e) {
			throw new exception('Erreur lors de l envoi du courriel');
			echo "<script>alert('On est dans le cathc de la fonction envoieCourrielSuppressionCompte. L'envoie du email a echouée!)</script>"; //DEBUG CODE
			return false;
		}
		
	}
}
