<?php
class ErreurController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Session::get('message')!='404' && Session::get('message')!='500')
		{
			$this->layout->content = View::make('erreur.403');
		}
		else
		{
			$this->layout->content = View::make('erreur.404');
		}
	}
}
?>
