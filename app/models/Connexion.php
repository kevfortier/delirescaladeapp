<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Connexion extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	
	
	public static function verifyCredentials($email, $pw)
	{
		try
		{
			//Encryption en "sha1" du mot de passe
			$pwEncrypté = sha1($pw);
		
			$user = DB::table('users')->where('email', $email)
			->where('password', $pwEncrypté)->get();
			//var_dump($user);
			if(count($user) == 0)
			{
				return null;
			}
			else
			{
				return $user;
			}
			
		}
		catch(Exception $e)
		{
			return "error";
		}

	}

}
