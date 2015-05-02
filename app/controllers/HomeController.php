<?php

class HomeController extends BaseController {

	
	public function index()
	{
            if(!Auth::check())
            {
                return $this->getLogin();
            }
            else
            {
                return View::make('Home.index',array())->with("view_data",  $this->view_data);
            }
	}
        
        

	public function getLogin()
	{
		return View::make('Home.login');
	}

	public function postLogin()
	{
		$input = Input::all();

		$rules = array('username' => 'required', 'epassword' => 'required');

		$v = Validator::make($input, $rules);

		if($v->fails())
		{

			return Redirect::to('login')->withErrors($v)->withInput(Input::except('password'));

		} else { 
                        $credentials = Input::only('username');
			//$credentials = array('username' => $input['username'], 'password' => $input['password']);
                        $credentials['password'] = Input::get('epassword');
                        $userTab = new User();
                        $user = $userTab->getUserProfileByUsername(Input::get('username'));
                        if(empty($user))
                        {
                            return Redirect::to('login')->withInput()->withErrors("Login Authentication failed.");
                        }
                        else
                        if($user->epassword == md5(Input::get('epassword'))) { // If their password is still MD5
                            $user->epassword = Hash::make(Input::get('epassword')); // Convert to new format
                            $user->save();
                        }
                        
			if(Auth::attempt($credentials))
			{
				return Redirect::intended('/');

			} else {

				return Redirect::to('login')->withInput()->withErrors("Login Authentication failed.");
			}
		}
	}

	public function lang()
	{
            $ref = $_SERVER["HTTP_REFERER"];
            $lang = Input::get('lang');
            Session::put('lang', $lang);
            App::setLocale($lang);
            
            return Redirect::to($ref);
	}
        
	public function logout()
	{
		Auth::logout();
		return Redirect::to('/')->with('message', 'Your are now logged out!');
	}

}
