<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    
         
        public $errors;
        protected $primaryKey = "id";
 
	protected $table = 'syncdevice';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('epassword');
        
        
        public function setAttributeNames(array $attributes)
        {
            $this->customAttributes = $attributes;
            return $this;
        }

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->epassword;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
        
        public function getRememberToken()
        {
            return $this->remember_token;
        }

        public function setRememberToken($value)
        {
            $this->remember_token = $value;
        }

        public function getRememberTokenName()
        {
            return 'remember_token';
        }
        
        public function getMyProfile()
        {
            return User::whereIdUser(Auth::user()->id_user)->first();
        }
        
        public function getUserProfile($id_user)
        {
            return User::whereIdUser($id_user)->first();
        }
        
        public function getUserProfileByUsername($user_name)
        {
            return User::whereUsername($user_name)->first();
        }
        
        public function getUserProfileByEmail($user_email)
        {
            return User::whereEmail($user_email)->first();
        }
        
        public function business()
        {
            $business = $this->hasMany('Business', 'id_user', 'id_user');
            return $business;
        }
        public function vacancy()
        {
            $vacancy = $this->hasMany('Vacancy', 'id_user', 'id_user');
            return $vacancy;
        }
        
        public function professional()
        {
            $prof = $this->hasMany('Professional', 'id_user', 'id_user');
            return $prof;
        }
        
        public function registerUser($input)
        {
            $password = $input['password'];
            if(strlen($password)>0)
            $password = Hash::make($password);

            $user = new User();
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->password = $password;
            $user->save();

            $address = new Address();
            $address->id_city = 0;
            $address->save();
            $prof = new Professional();
            $prof->id_user = $user->id_user;
            $prof->id_address = $address->id_address;

            $address = new Address();
            $address->id_city = 0;
            $address->save();
            $vacancy = new Vacancy();
            $vacancy->id_user = $user->id_user;
            $vacancy->id_address = $address->id_address;
            $address = new Address();
            $address->id_city = 0;
            $address->save();
            $business = new Business();
            $business->id_user = $user->id_user;
            $business->id_address = $address->id_address;
            $prof->save();
            $vacancy->save();
            $business->save();
            return $user;
        }
        
        public function updateAccount()
        {
            $data['success'] = 0;
            $data['success_mess'] = "";
            $data['error_mess'] = "";
            $data['error'] = 0;
            $input = Input::all();
            $user = new User();
            $userPass = Input::get("user_password");
            $rules = array('full_name' => 'required');
            if(!empty($userPass))
            {
                $rules['user_password'] = 'required';
            }
            $user = $user->getMyProfile();
            if(Input::get("email_id")!= Auth::user()->email)
                $rules['email_id'] = 'required|unique:users,email|email';
            
            $v = Validator::make($input, $rules);
            if($v->passes())
            {
                $user->name = Input::get("full_name");
                $user->email = Input::get("email_id");
                if(!empty($userPass))
                {
                    $user->password = Hash::make($userPass);
                }
                $user->save();
                $data['success'] = 1;
                $data['success_mess'] = "Data updated successfully";
            }
            else
            {
                $data['error'] = 1;
                $data['error_mess'] = $v->messages();
            }
            return $data;
            
            
            
        }
        public function updateVacancy()
        {
            $data['success'] = 0;
            $data['success_mess'] = "";
            $data['error_mess'] = "";
            $data['error'] = 0;
            $input = Input::all();
            $vacancy = new Vacancy();
            
            $rules = array(
                        'vac_title' => 'required|alpha_spaces|max:100',
                        'vac_area'=>"required|alpha_spaces|max:100",
                        "vac_requirements"=>'required|alpha_spaces|max:400',
                        "vac_desirable_req"=> 'required|alpha_spaces|max:100',
                        "vac_other_info" => 'required|alpha_spaces|max:100',
                        "vac_about"=> 'required|alpha_spaces|max:100',
                        'vac_desc' => 'required|alpha_spaces|max:400',
                        'vac_phone'=>"numeric|max:999999999999999",
                        'vac_email' =>"email||max:200",
                        'vac_add_street' =>"alpha_spaces|max:200",
                        'vac_add_number' =>"numeric|max:999999999999999", 
                        'vac_add_comp' =>"alpha_spaces|max:100",
                        'vac_facebook' =>"url|max:300",
                        'vac_skype' =>"alpha_num|max:100",
                        'vac_twitter' =>"url|max:200",
                        'vac_linkedin' =>"url|max:200",
                        'vac_instagram' =>"url|max:200"
                    );
            
            $newnames = array(
                        'vac_title' => 'Title',
                        'vac_area'=>"Area",
                        "vac_requirements"=>'Requirements',
                        "vac_desirable_req"=> 'Desireable Requirements',
                        "vac_other_info" => 'Other Info',
                        "vac_about"=> 'About',
                        'vac_desc' => 'Description',
                        'vac_phone'=>"Phone number",
                        'vac_email' =>"Email",
                        'vac_add_street' =>"Address Street",
                        'vac_add_number' =>"Address number", 
                        'vac_add_comp' =>"Address complement",
                        'vac_facebook' =>"Facebook",
                        'vac_skype' =>"Skype",
                        'vac_twitter' =>"Twitter",
                        'vac_linkedin' =>"LinkedIn",
                        'vac_instagram' =>"Instagram"
                    );
            
            $vacancy = $vacancy->getUserVacancy($input['id']);
            $messages = array(
                            'required' => ':attribute is required.',
                            'email' => 'Please enter valid :attribute.',
                            'alpha' => ':attribute, only alphabets are allowed.',
                            'numeric' => 'Only numbers are allowed for :attribute.',
                            'alpha_num' => ':attribute, only alphabets and numbers are allowed.',
                            'max' => ':attribute max characters limit exceed (:max).',
                            'url' => ':attribute is not a valid URL.',
                            "alpha_spaces" => "The :attribute may only contain letters and spaces.",
                        );
            $v = Validator::make($input, $rules,$messages);
            $v->setAttributeNames($newnames); 
            if($v->passes())
            {
                $vacancy->title = Input::get("vac_title");
                $vacancy->area = Input::get("vac_area");
                $vacancy->requirements = Input::get("vac_requirements");
                $vacancy->description = Input::get("vac_desc");
                $vacancy->desirable_req = Input::get("vac_desirable_req");
                $vacancy->other_info = Input::get("vac_other_info");
                $vacancy->about = Input::get("vac_about");
                $vacancy->phone = Input::get("vac_phone");
                $vacancy->email = Input::get("vac_email");
                
                $vacancy->address->street = Input::get("vac_add_street");
                
                $vacancy->address->number = Input::get("vac_add_number");
                $vacancy->address->complement = Input::get("vac_add_comp");
                
                $vacancy->address->id_city = Input::get("vac_city");
                $vacancy->facebook = Input::get("vac_facebook");
                $vacancy->twitter = Input::get("vac_twitter");
                $vacancy->linkedin = Input::get("vac_linkedin");
                $vacancy->instagram = Input::get("vac_instagram");
                $vacancy->skype = Input::get("vac_skype");
                
                $vacancy->save();
                $vacancy->address->save();
                
                $data['success'] = 1;
                $data['success_mess'] = "Data updated successfully";
            }
            else
            {
                $data['error'] = 1;
                $data['error_mess'] = $v->messages();
            }
            return $data;
        }
        
        public function addVacancy()
        {
            $data['success'] = 0;
            $data['success_mess'] = "";
            $data['error_mess'] = "";
            $data['error'] = 0;
            
            $address = new Address();
            $address->id_city = 0;
            $address->save();
            $vacancy = new Vacancy();
            $vacancy->id_user = Auth::user()->id_user;
            $vacancy->id_address = $address->id_address;
            $vacancy->save();
            
            ob_start();
            $datan['states'] = State::where('name',"!=",'')->orderby("name" ,'asc')->lists('name','id_state');
            $datan['accord_open'] = 1;
            echo View::make('elements.vacancy_list',array('vacancy_lists' => $vacancy,'data' => $datan));
            $data['vacancy_form'] =  ob_get_contents ();
            ob_get_clean();
            
            $data['success'] = 1;
            $data['success_mess'] = "Data updated successfully";
            return $data;
        }
        
        public function addBusiness()
        {
            $data['success'] = 0;
            $data['success_mess'] = "";
            $data['error_mess'] = "";
            $data['error'] = 0;
            
            $address = new Address();
            $address->id_city = 0;
            $address->save();
            $business = new Business();
            $business->id_user = Auth::user()->id_user;
            $business->id_address = $address->id_address;
            $business->save();
            $business = $business->getUserBusiness($business->id_business);
            ob_start();
            $datan['states'] = State::where('name',"!=",'')->orderby("name" ,'asc')->lists('name','id_state');
            $datan['accord_open'] = 1;
            echo View::make('elements.business_list',array('business_lists' => $business,'data'=>$datan));
            $data['business_form'] =  ob_get_contents ();
            ob_get_clean();
            
            $data['success'] = 1;
            $data['success_mess'] = "Data updated successfully";
            
            return $data;
            
        }
        
        public function updateProfession()
        {
            $data['success'] = 0;
            $data['success_mess'] = "";
            $data['error_mess'] = "";
            $data['error'] = 0;
            $input = Input::all();
            $professional = new Professional();
            
            $rules = array(
                        'prof_profession' => 'required|alpha_spaces|max:100',
                        'prof_name'=>"required|alpha_spaces|max:100",
                        'prof_desc' => 'required|alpha_spaces|max:400',
                        'prof_phone'=>"numeric|max:999999999999999",
                        'prof_email' =>"email||max:200",
                        'prof_add_street' =>"alpha_spaces|max:200",
                        'prof_add_number' =>"numeric|max:999999999999999", 
                        'prof_add_comp' =>"alpha_spaces|max:100",
                        'prof_facebook' =>"url|max:300",
                        'prof_skype' =>"alpha_num|max:100",
                        'prof_twitter' =>"url|max:200",
                        'prof_linkedin' =>"url|max:200",
                        'prof_instagram' =>"url|max:200"
                    );
            
            $newnames = array(
                        'prof_profession' => 'Profession',
                        'prof_name'=>"Name of profession",
                        'prof_desc' => 'Description',
                        'prof_phone'=>"Phone number",
                        'prof_email' =>"Email",
                        'prof_add_street' =>"Address Street",
                        'prof_add_number' =>"Address number", 
                        'prof_add_comp' =>"Address complement",
                        'prof_facebook' =>"Facebook",
                        'prof_skype' =>"Skype",
                        'prof_twitter' =>"Twitter",
                        'prof_linkedin' =>"LinkedIn",
                        'prof_instagram' =>"Instagram"
                    );
            
            $professional = $professional->getUserProfessional($input['id']);
            $messages = array(
                            'required' => ':attribute is required.',
                            'email' => 'Please enter valid :attribute.',
                            'alpha' => ':attribute, only alphabets are allowed.',
                            'numeric' => 'Only numbers are allowed for :attribute.',
                            'alpha_num' => ':attribute, only alphabets and numbers are allowed.',
                            'max' => ':attribute max characters limit exceed (:max).',
                            'url' => ':attribute is not a valid URL.',
                            "alpha_spaces" => "The :attribute may only contain letters and spaces.",
                        );
            $v = Validator::make($input, $rules,$messages);
            $v->setAttributeNames($newnames); 
            if($v->passes())
            {
                $professional->profession = Input::get("prof_profession");
                $professional->name = Input::get("prof_name");
                $professional->description = Input::get("prof_desc");
                $professional->phone = Input::get("prof_phone");
                $professional->email = Input::get("prof_email");
                
                $professional->address->street = Input::get("prof_add_street");
                
                $professional->address->number = Input::get("prof_add_number");
                $professional->address->complement = Input::get("prof_add_comp");
                
                $professional->address->id_city = Input::get("prof_city");
                $professional->facebook = Input::get("prof_facebook");
                $professional->twitter = Input::get("prof_twitter");
                $professional->linkedin = Input::get("prof_linkedin");
                $professional->instagram = Input::get("prof_instagram");
                $professional->skype = Input::get("prof_skype");
                
                $professional->save();
                $professional->address->save();
                
                $data['success'] = 1;
                $data['success_mess'] = "Data updated successfully";
            }
            else
            {
                $data['error'] = 1;
                $data['error_mess'] = $v->messages();
            }
            return $data;
            
            
            
        }
        
        public function updateBusiness()
        {
            $data['success'] = 0;
            $data['success_mess'] = "";
            $data['error_mess'] = "";
            $data['error'] = 0;
            $input = Input::all();
            $business = new Business();
            
            $rules = array(
                        'busi_title' => 'required|alpha_spaces|max:100',
                        'busi_area'=>"required|alpha_spaces|max:100",
                        "busi_searchfor"=>'required|alpha_spaces|max:400',
                        "busi_other_info" => 'required|alpha_spaces|max:100',
                        'busi_desc' => 'required|alpha_spaces|max:400',
                        'busi_phone'=>"numeric|max:999999999999999",
                        'busi_email' =>"email||max:200",
                        'busi_add_street' =>"alpha_spaces|max:200",
                        'busi_add_number' =>"numeric|max:999999999999999", 
                        'busi_add_comp' =>"alpha_spaces|max:100",
                        'busi_facebook' =>"url|max:300",
                        'busi_skype' =>"alpha_num|max:100",
                        'busi_twitter' =>"url|max:200",
                        'busi_linkedin' =>"url|max:200",
                        'busi_instagram' =>"url|max:200"
                    );
            
            $newnames = array(
                        'busi_title' => 'Title',
                        'busi_area'=>"Area",
                        "busi_searchfor"=>'Search for',
                        "busi_other_info" => 'Other Info',
                        'busi_desc' => 'Description',
                        'busi_phone'=>"Phone number",
                        'busi_email' =>"Email",
                        'busi_add_street' =>"Address Street",
                        'busi_add_number' =>"Address number", 
                        'busi_add_comp' =>"Address complement",
                        'busi_facebook' =>"Facebook",
                        'busi_skype' =>"Skype",
                        'busi_twitter' =>"Twitter",
                        'busi_linkedin' =>"LinkedIn",
                        'busi_instagram' =>"Instagram"
                    );
            
            $business = $business->getUserBusiness($input['id']);
            $messages = array(
                            'required' => ':attribute is required.',
                            'email' => 'Please enter valid :attribute.',
                            'alpha' => ':attribute, only alphabets are allowed.',
                            'numeric' => 'Only numbers are allowed for :attribute.',
                            'alpha_num' => ':attribute, only alphabets and numbers are allowed.',
                            'max' => ':attribute max characters limit exceed (:max).',
                            'url' => ':attribute is not a valid URL.',
                            "alpha_spaces" => "The :attribute may only contain letters and spaces.",
                        );
            $v = Validator::make($input, $rules,$messages);
            $v->setAttributeNames($newnames); 
            if($v->passes())
            {
                $business->title = Input::get("busi_title");
                $business->area = Input::get("busi_area");
                $business->searchfor = Input::get("busi_searchfor");
                $business->description = Input::get("busi_desc");
                $business->other_info = Input::get("busi_other_info");
                $business->phone = Input::get("busi_phone");
                $business->email = Input::get("busi_email");
                
                $business->address->street = Input::get("busi_add_street");
                
                $business->address->number = Input::get("busi_add_number");
                $business->address->complement = Input::get("busi_add_comp");
                
                $business->address->id_city = Input::get("busi_city");
                $business->facebook = Input::get("busi_facebook");
                $business->twitter = Input::get("busi_twitter");
                $business->linkedin = Input::get("busi_linkedin");
                $business->instagram = Input::get("busi_instagram");
                $business->skype = Input::get("busi_skype");
                
                $business->save();
                $business->address->save();
                
                $data['success'] = 1;
                $data['success_mess'] = "Data updated successfully";
            }
            else
            {
                $data['error'] = 1;
                $data['error_mess'] = $v->messages();
            }
            return $data;
        }
        
        
        public function searchUser()
        {
            $curr_tab = Input::get("curr_tab");
            $searchText = Input::get("searchText");
            
            $data['success'] = 1;
            $data['success_mess'] = "loaded";
            $data['error_mess'] = "loaded";
            $data['error'] = 0;
            /*$this->where(
                    function ($query) {
                        $query->where('a', '=', 1)->orWhere('b', '=', 1);
                    })
                 ->where(
                    function ($query) {
                        $query->where('c', '=', 1)->orWhere('d', '=', 1);
                    });*/
            $data = null;
            if($curr_tab == "professional")
            {
                $professional = new Professional();
                $data['prof_users'] = $professional->where('profession','LIKE','%'.$searchText.'%')
                        ->orWhere('description','LIKE','%'.$searchText.'%')
                        ->paginate(15);
            }
            else
            if($curr_tab == "vacancy")
            {
                $vacancy = new Vacancy();
                $data['vacancy_users'] = $vacancy->where('title','LIKE','%'.$searchText.'%')
                        ->orWhere('area','LIKE','%'.$searchText.'%')
                        ->orWhere('description','LIKE','%'.$searchText.'%')
                        ->paginate(15);
            }
            else
            if($curr_tab == "business")
            {
                $business = new Business();
                $data['business_users'] = $business->where('title','LIKE','%'.$searchText.'%')
                        ->orWhere('area','LIKE','%'.$searchText.'%')
                        ->orWhere('description','LIKE','%'.$searchText.'%')
                        ->paginate(15);
            }
            return $data;
        }
        
        
}