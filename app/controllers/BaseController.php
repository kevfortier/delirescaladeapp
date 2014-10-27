<?php

class BaseController extends Controller {

	protected $layout = 'layouts.base';
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			Session::put('s_nbNouvelNotif', Notification::getNotificationView());
			$this->layout = View::make($this->layout);
		}
	}
}
