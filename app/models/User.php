<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	//liste des champs de la table users qui peut être remplit par une request User::create();
	protected $fillable = array('pseudo','nom','prenom','password','dateNaissance','email',
		'telephone','cellulaire','noCivique','rue','ville','codePostal');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static function getUserById($id)
	{
		try
		{
			$user = DB::table('users')->where('id', $id)->first();

			return $user;
		}
		catch(Exception $e)
		{
			return "error";
		}

	}


	public static function getAllUser()
	{
		try
		{
			$users = DB::table('users');
			
			if(Input::get('typeGrimpeur')){
	    		$users->where('type', '=', Input::get('typeGrimpeur'));
	    	}

			return $users->paginate(24);
		}
		catch(Exception $e)
		{
			return "error";
		}

	}

    public function notifications()
    {
        return $this->hasMany('Notification');
    }

}
