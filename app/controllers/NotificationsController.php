<?php

class NotificationsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{$result2 = "empty";
		$data = array();
		if(Input::get('effacer')){
			$data = Input::all();
			$data = array_keys($data);
			$arrayPass = array();
			for ($i=0; $i <count($data)-1; $i++) { 
				array_push($arrayPass,$data[$i+1]);
			}
			$result2 = Notification::deleteNotifBySpecifiedId($arrayPass);
		}
		$idUser = $_SESSION['user']->id;
		$result = Notification::getNotificationByUserId($idUser);

		$this->layout->content = View::make('Notifications.ListeNotifications', array('res'=>$result2,'result' => $result,'test'=>$data));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$notification = Notification::find($id);
		switch($notification->typeNotification){
			case NotificationType::DemandePartenaire:;
				$notification->isView = 1;
				$notification->save();
				return Redirect::action('PartenairesController@edit',array($notification->instance_id));
			break;
			default:
				$result = Notification::getNotificationByUserId($_SESSION['user']->id);
				$this->layout->content = View::make('Notifications.listeNotifications', array('result' => $result));
			break;
		}
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
