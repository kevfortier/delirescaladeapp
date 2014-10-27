<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Notification extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;


	protected $fillable = array('isView','user_id','message','typeNotification',
		'instance_id','created_at','updated_at');
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'notifications';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	public static function deleteNotifBySpecifiedId($data){
		try{
			for ($i=0; $i < count($data); $i++) { 
				$result = DB::table('notifications')
				->where('id', '=', $data[$i])
				->delete();
			}
			return $data;
		}
		catch(Exception $e){
			return "error";
		}
	}

	public static function getNotificationByUserId($id)
	{
		try
		{
			$userBase = DB::table('users')->where('id',$id)->get();
			
			$notifications = DB::table('notifications')
			->where('user_id',$id)
			->orderBy('created_at','DESC')
			->paginate(24);
			$return = array($userBase,$notifications);
			return $return;
		}
		catch(Exception $e)
		{
			return "error";
		}
	}

	public static function getNotificationView()
	{
		try
		{
			$notifications = DB::table('notifications')
			->where('user_id',$_SESSION['user']->id)
			->where('isView', 0)
			->count();
			$return = $notifications;
			return $return;
		}
		catch(Exception $e)
		{
			return "error";
		}
	}

	public static function getAllNotification()
	{
		try
		{
			$notifications = DB::table('notifications')->get();

			return $notifications;
		}
		catch(Exception $e)
		{
			return "error";
		}
	}

 	public function sender()
    {
        return $this->hasOne('Users','sender_id');
    }

    public function user()
    {
        return $this->hasOne('Users','user_id');
    }
}