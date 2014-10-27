<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Mdp extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	
	public static function updatePw($courriel, $newPw)
	{
		//echo "<script>alert('On rentre dans la fonction updatePw de MdpIndex.php')</script>"; //DEBUG CODE

		try {
			DB::table('users')
			->where('email', $courriel)
			->update(array('password'=> $newPw));


		} catch (Exception $e) {
			throw new exception('Erreur lors de l insertion dans la base de données');
		}
		
	}


	public static function changePassword($courriel, $pw)
	{
		//echo "<script>alert('On rentre dans la fonction changePassword de MdpIndex.php')</script>"; //DEBUG CODE

		try
		{
		
			$user = DB::table('users')->where('email', $courriel)->get();
			
			//var_dump($user); //======== Debug Code ========
			
			//Vérification si l'email saisi a été trouvé dans la bd
			if(count($user) == 0)
			{
				return false;
			}
			else
			{

				//echo "<script>alert('CHANGEMENT DU MOT DE PASSE DANS LA BD')</script>"; //DEBUG CODE

				//Changement du mot de passe dans la bd
				Mdp::updatePw($courriel, $pw);
				
				return true;
			}
			
		}
		catch(Exception $e)
		{
			//echo "<script>alert('On rentre dans le catch de la fonction changePassword de MdpIndex.php UNE ERREUR C EST PRODUITE')</script>"; //DEBUG CODE
			return "error";
		}

	}

}
