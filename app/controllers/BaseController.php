<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
        public $view_data = array('banner' => true);
        //public $langs = array('en','fr','es');
        
        public function __construct() {
            $lang = Session::get('lang');
            App::setLocale($lang);
        }
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
