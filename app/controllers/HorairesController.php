<?php

class HorairesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$result = Partenaire::getAllPartenaireHoraireFormatedForFullList();
		$this->layout->content = View::make('Partenaires.PartenairesHoraire',array('result'=> $result));
	}
}
