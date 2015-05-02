<?php

class Company extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $primaryKey = "id";
    protected $table = 'company';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public function getCompanies($comNo = false, $comName = false) {
        if ($comNo && $comName && strlen($comName) > 0)
            return $this->where("companyno", 'LIKE', "%" . $comNo . "%")->where("companyname", 'LIKE', "%" . $comName . "%")->paginate(10);
        else
        if ($comNo)
            return $this->where("companyno", 'LIKE', "%" . $comNo . "%")->paginate(10);
        else
        if ($comName && strlen($comName) > 0)
            return $this->where("companyname", 'LIKE', "%" . $comName . "%")->paginate(10);
        else
            return $this->paginate(10);
    }

    public function address() {
        $address = $this->hasMany('Address', 'id_address', 'id_address');
        return $address;
    }

    public function company_city($company_no = 0) {
        $address = Address::where("addresstypeno", "=", 0)->where('companyrefno', '=', $company_no)->first();
        return $address;
    }

    public function company_more_address($company_no = 0) {
        $address = Address::where("addresstypeno", "!=", 0)->where('companyrefno', '=', $company_no)->get();
        return $address;
    }

    public function company_more_address_paginate($company_no = 0) {
        $address = Address::where("addresstypeno", "!=", 0)->where('companyrefno', '=', $company_no)->paginate(10);
        return $address;
    }

    public function communications($company_no = 0) {
        $address = Communication::where('companyrefno', '=', $company_no)->where('personrefno', '=', NULL)->get();
        return $address;
    }

    public function persons($company_no = 0) {
        $address = Person::where('companyrefno', '=', $company_no)->get();
        return $address;
    }

    public function persons_paginate($company_no = 0) {
        $address = Person::where('companyrefno', '=', $company_no)->paginate(10);
        return $address;
    }

    public function business_type() {
        $businessType = $this->hasOne('BusinessType', 'businesstype', 'id');
        return $businessType;
    }

    public function companyListing() {
        $data['success'] = 1;
        $data['success_mess'] = trans("common.loaded");
        $data['error_mess'] = trans("common.loaded");
        $data['error'] = 0;

        $comNo = Input::get('comNo');
        $comName = Input::get('comName');
        $companies = $this->getCompanies($comNo, $comName);

        ob_start();
        echo View::make('Company.listing', array("data" => $companies,));
        $data['html'] = ob_get_contents();
        ob_get_clean();
        return $data;
    }

    public function addAjax() {
        $data['success'] = 0;
        $data['success_mess'] = "";
        $data['error_mess'] = "";
        $data['error'] = 0;
        $input = Input::all();
        $company = new Company();

        $rules = array(
            'com_no' => 'required|alpha_comma_num_spaces|min:2|max:255',
            'com_name' => 'required|alpha_comma_num_spaces|min:2|max:255',
            'com_type' => 'required|alpha_comma_num_spaces|max:1000',
            'add_street' => 'required|alpha_comma_num_spaces|max:1000',
            'add_postal' => 'required|alpha_comma_num_spaces|max:1000',
            'add_city' => 'required|alpha_comma_num_spaces|max:1000',
            'add_country' => 'required|alpha_comma_num_spaces|max:1000',
        );

        $newnames = array(
            'com_no' => trans('company.company_no'),
            'com_name' => trans('company.company_name'),
            "com_type" => trans('company.company_type'),
            "add_street" => trans('company.add_street_no_name'),
            "add_postal" => trans('company.postal_code'),
            "add_city" => trans('company.city'),
            "add_country" => trans('company.country'),
        );


        $messages = array(
            'required' => trans('validation.required'),
            'email' => trans('validation.email'),
            'alpha' => trans('validation.alpha'),
            'max' => ':attribute max characters limit exceed (:max).',
            "alpha_num_spaces" => "The :attribute may only contain letters and spaces.",
            "alpha_comma_num_spaces" => "The :attribute may only contain letters, number and spaces.",
        );
        $v = Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            $company->companyno = Input::get('com_no');
            $company->companyname = Input::get('com_name');
            $company->businesstype = Input::get('com_type');
            $company->save();
            
            $address = new Address();
            $address->companyrefno = Input::get('com_no');
            $address->street = Input::get('add_street');
            $address->postalcode = Input::get('add_postal');
            $address->city = Input::get('add_city');
            $address->country = Input::get('add_country');
            $address->addresstypeno = 0;
            $address->save();
            
            foreach ($input['com_inp'] as $key => $comm_inp) {
                if ($key != 0 && $key % 3 != 0)
                    continue;
                $commu = new Communication();
                $commu->communicationno = "comp" . Input::get('com_no') . "-" . $input['com_inp'][$key];
                $commu->companyrefno = Input::get('com_no');
                $commu->type = $input['com_inp'][$key];
                $commu->data = $input['com_inp'][$key + 1];
                $commu->save();
            }

            $data['success'] = 1;
            $data['success_mess'] = "Successfully saved data for company";
        }
        else {
            $data['error'] = 1;
            $data['error_mess'] = $v->messages();
        }

        return $data;
    }

    public function editAjax() {
        $data['success'] = 0;
        $data['success_mess'] = "";
        $data['error_mess'] = "";
        $data['error'] = 0;
        $input = Input::all();
        $company = new Company();

        $rules = array(
            'com_no' => 'required|alpha_comma_num_spaces|min:2|max:255',
            'com_name' => 'required|alpha_comma_num_spaces|min:2|max:255',
            'com_type' => 'required|alpha_comma_num_spaces|max:1000',
            'add_street' => 'required|alpha_comma_num_spaces|max:1000',
            'add_postal' => 'required|alpha_comma_num_spaces|max:1000',
            'add_city' => 'required|alpha_comma_num_spaces|max:1000',
            'add_country' => 'required|alpha_comma_num_spaces|max:1000',
        );

        $newnames = array(
            'com_no' => 'Company No',
            'com_name' => "Company Name",
            "com_type" => 'Company Type',
            "add_street" => 'Address Street Number/Name',
            "add_postal" => 'Postal Code',
            "add_city" => 'City',
            "add_country" => 'Country',
        );


        $messages = array(
            'required' => ':attribute is required.',
            'email' => 'Please enter valid :attribute.',
            'alpha' => ':attribute, only alphabets are allowed.',
            'max' => ':attribute max characters limit exceed (:max).',
            "alpha_num_spaces" => "The :attribute may only contain letters and spaces.",
            "alpha_comma_num_spaces" => "The :attribute may only contain letters, number and spaces.",
        );
        $v = Validator::make($input, $rules, $messages);
        $v->setAttributeNames($newnames);
        if ($v->passes()) {
            $comp_id = Input::get('comp_id');
            $company = $company->where("id", "=", $comp_id)->first();
            $company->companyname = Input::get('com_name');
            $company->businesstype = Input::get('com_type');
            $company->update();
            $address = new Address();
            $is_empty_comp_add = $company_add = $company->company_city($company->companyno);

            if (empty($company_add)) {
                $company_add = $address;
                $company_add->companyrefno = $company->companyno;
            }

            $company_add->street = Input::get('add_street');
            $company_add->postalcode = Input::get('add_postal');
            $company_add->city = Input::get('add_city');
            $company_add->country = Input::get('add_country');
            $company_add->addresstypeno = 0;
            if (empty($is_empty_comp_add)) {
                $company_add->save();
            } else {
                $company_add->update();
            }
            $comm_real = $input['com_inp'];
            
            $commu = $company->communications($company->companyno);
            $commu_arr = array();
            if (!$commu->isEmpty()) {
                foreach ($commu as $commu_da) {
                    $commu_arr[$commu_da->id] = $commu_da->id;
                }
            }
            
            foreach ($input['com_inp'] as $key => $comm_inp) {
                if ($key != 0 && $key % 3 != 0)
                    continue;
                $commu = new Communication();
                $count = ($key);
                $count1 = ($key + 1);
                $count2 = ($key + 2);
                if(isset($comm_real[$count2]) && $comm_real[$count2] > 0 && in_array($comm_real[$count2],$commu_arr))
                {
                    unset($commu_arr[$comm_real[$count2]]);
                }
                
                if (isset($comm_real[$count2]) && $comm_real[$count2] > 0) {
                    $commu = $commu->where("id", '=', $comm_real[$count2])->first();
                }
                $commu->communicationno = "comp" . $company->companyno . "-" . $comm_real[$key];
                $commu->type = $comm_real[$count];
                $commu->data = $comm_real[$count1];
                if (isset($comm_real[$count2]) && $comm_real[$count2] > 0)
                    $commu->update();
                else {
                    $commu->companyrefno = $company->companyno;
                    $commu->save();
                }
            }
            if(!empty($commu_arr))
            Communication::whereIn("id",$commu_arr)->delete();
            
            $data['success'] = 1;
            $data['success_mess'] = "Successfully saved data for company";
        } else {
            $data['error'] = 1;
            $data['error_mess'] = $v->messages();
        }

        return $data;
    }

    public function companyOtherAdd($data_id) {
        $data['success'] = 0;
        $data['success_mess'] = "";
        $data['error_mess'] = "";
        $data['error'] = 0;
        $company = new Company();
        $company_d = $company->where("id", "=", $data_id)->first();
        if (!$company_d->first()) {
            $data['error'] = 1;
            $data['error_mess'] = "No record found";
        } else {
            $data['success'] = 1;
            $company_add = $company_d->company_more_address_paginate($company_d->companyno);
            ob_start();
            echo View::make('Company.companyOtherAddress', array("content" => $company_add));
            $data['html'] = ob_get_contents();
            ob_get_clean();
        }
        return $data;
    }

    public function companyPerson($data_id) {
        $data['success'] = 0;
        $data['success_mess'] = "";
        $data['error_mess'] = "";
        $data['error'] = 0;
        $company = new Company();
        $company_d = $company->where("id", "=", $data_id)->first();
        if (!$company_d->first()) {
            $data['error'] = 1;
            $data['error_mess'] = "No record found";
        } else {
            $data['success'] = 1;
            $person_pagi = $company_d->persons_paginate($company_d->companyno);
            ob_start();
            echo View::make('Company.companyPerson', array("content" => $person_pagi));
            $data['html'] = ob_get_contents();
            ob_get_clean();
        }
        return $data;
    }

    public function getCompanyData($data_id) {
        $data['success'] = 1;
        $data['success_mess'] = "";
        $data['error_mess'] = "";
        $data['error'] = 0;
        $company = new Company();
        $company_d = $company->where("id", "=", $data_id)->first();
        if (!$company_d->first()) {
            $data['error'] = 1;
            $data['error_mess'] = "No record found";
        } else {
            $data['success'] = 1;

            $company_add = $company_d->company_city($company_d->companyno);
            $commu = $company_d->communications($company_d->companyno);
            $data['content'] = array(
                'comp_id' => $company_d->id,
                'comp_no' => $company_d->companyno,
                'comp_name' => $company_d->companyname,
                'comp_type' => $company_d->businesstype,
            );
            if (empty($company_add)) {
                $data['error'] = 1;
                $data['error_mess'] = "No record found";
                return $data;
            }

            if ($company_add->first()) {
                $data['content']['add_street'] = $company_add->street;
                $data['content']['add_postal'] = $company_add->postalcode;
                $data['content']['add_city'] = $company_add->city;
                $data['content']['add_country'] = $company_add->country;
            }
            $data['content']['commu'] = array();
            if (!$commu->isEmpty()) {
                foreach ($commu as $commu_da) {
                    $commu_arr = array();
                    $commu_arr['id'] = $commu_da->id;
                    $commu_arr['type'] = $commu_da->type;
                    $commu_arr['value'] = $commu_da->data;
                    array_push($data['content']['commu'], $commu_arr);
                }
            }
        }
        return $data;
    }

    public function saveOtherAdd($add_id) {
        $data['success'] = 0;
        $data['success_mess'] = "";
        $data['error_mess'] = "";
        $data['error'] = 0;
        $input = Input::all();
        $company = new Company();
        //print_r($input['com_inp']);
        //die;
        $address = new Address();
        if ($add_id != "new") {
            $address = $address->where("id", "=", $add_id)->first();
            if (empty($address) || !($address->first())) {
                $data['error'] = 1;
                $data['error_mess'] = "Not valid address data";
                return $data;
            }

            $address->companyrefno = Input::get('comp_no');
            $address->street = Input::get('add_street');
            $address->postalcode = Input::get('add_postal');
            $address->city = Input::get('add_city');
            $address->country = Input::get('add_country');
            $address->addresstypeno = Input::get('add_type');
            $address->update();
        } else {
            $address->companyrefno = Input::get('comp_no');
            $address->street = Input::get('add_street');
            $address->postalcode = Input::get('add_postal');
            $address->city = Input::get('add_city');
            $address->country = Input::get('add_country');
            $address->addresstypeno = Input::get('add_type');
            $address->save();
        }
        $data['success'] = 1;
        $data['success_mess'] = "Successfully saved data for company";
        return $data;
    }

    public function savePerson($person_id) {
        $data['success'] = 0;
        $data['success_mess'] = "";
        $data['error_mess'] = "";
        $data['error'] = 0;
        $input = Input::all();
        $company = new Company();
        $person = new Person();
        if ($person_id != "new") {
            $person = $person->where("id", "=", $person_id)->first();
            if (empty($person) || !($person->first())) {
                $data['error'] = 1;
                $data['error_mess'] = "Not valid person data";
                return $data;
            }
            $person->companyrefno = Input::get('comp_no');
            $person->surname = Input::get('add_surname');
            $person->firstname = Input::get('add_name');
            $person->title = Input::get('add_title');
            $person->position = Input::get('add_position');
            $person->update();
        } else {
            $person->personno = CommonHelper::random_guid();
            $person->companyrefno = Input::get('comp_no');
            $person->surname = Input::get('add_surname');
            $person->firstname = Input::get('add_name');
            $person->title = Input::get('add_title');
            $person->position = Input::get('add_position');
            $person->save();
        }
        $data['success'] = 1;
        $data['success_mess'] = "Successfully saved data for company";
        return $data;
    }

    function deleteOtherAdd() {
        $checkval = explode(",", Input::get('checkval'));

        $data['success'] = 0;
        $data['success_mess'] = "";
        $data['error_mess'] = "";
        $data['error'] = 0;
        if (!empty($checkval)) {
            foreach ($checkval as $id) {
                $address = new Address();
                $add_delete = $address->where("id", "=", $id)->first();
                $add_delete->delete();
            }
            $data['success'] = 1;
            $data['success_mess'] = "Deleted Successfully";
        } else {
            $data['error_mess'] = "delete error";
            $data['error'] = 1;
        }
        return $data;
    }

    function companyDelete() {
        $checkval = explode(",", Input::get('checkval'));

        $data['success'] = 0;
        $data['success_mess'] = "";
        $data['error_mess'] = "";
        $data['error'] = 0;
        if (!empty($checkval)) {
            foreach ($checkval as $id) {
                $company = new Company();
                $company = $company->where("id", "=", $id)->first();

                $address = new Address();
                $address->where("companyrefno", "=", $company->companyno)->delete();
                $person = new Person();
                $person->where("companyrefno", "=", $company->companyno)->delete();
                $commu = new Communication();
                $commu->where("companyrefno", "=", $company->companyno)->delete();
                $company->delete();
            }
            $data['success'] = 1;
            $data['success_mess'] = "Deleted Successfully";
        } else {
            $data['error_mess'] = "delete error";
            $data['error'] = 1;
        }
        return $data;
    }

    function deletePerson() {
        $checkval = explode(",", Input::get('checkval'));

        $data['success'] = 0;
        $data['success_mess'] = "";
        $data['error_mess'] = "";
        $data['error'] = 0;
        if (!empty($checkval)) {
            foreach ($checkval as $id) {
                $person = new Person();
                $person_delete = $person->where("id", "=", $id)->first();
                $person_delete->delete();
            }
            $data['success'] = 1;
            $data['success_mess'] = "Deleted Successfully";
        } else {
            $data['error_mess'] = "delete error";
            $data['error'] = 1;
        }
        return $data;
    }

    function deletePersonCommu() {
        $checkval = explode(",", Input::get('checkval'));

        $data['success'] = 0;
        $data['success_mess'] = "";
        $data['error_mess'] = "";
        $data['error'] = 0;
        if (!empty($checkval)) {
            foreach ($checkval as $id) {
                $personCommu = new Communication();
                $person_delete = $personCommu->where("id", "=", $id)->first();
                $person_delete->delete();
            }
            $data['success'] = 1;
            $data['success_mess'] = "Deleted Successfully";
        } else {
            $data['error_mess'] = "delete error";
            $data['error'] = 1;
        }
        return $data;
    }

    public function getPersonCommu() {
        $data['success'] = 0;
        $data['success_mess'] = "";
        $data['error_mess'] = "";
        $data['error'] = 0;
        $commu = new Communication();
        $comp_no = Input::get("comp_no");
        $person_ref_no = Input::get("person_ref_no");
        $commu = $commu->where("companyrefno", "=", $comp_no)->where("personrefno", "=", $person_ref_no)->paginate(10); {
            $data['success'] = 1;
            ob_start();
            echo View::make('Company.personCommunication', array("content" => $commu));
            $data['html'] = ob_get_contents();
            ob_get_clean();
        }
        return $data;
    }

    public function savePersonCommu($person_commu_id) {
        $data['success'] = 0;
        $data['success_mess'] = "";
        $data['error_mess'] = "";
        $data['error'] = 0;
        $input = Input::all();
        //print_r($input['com_inp']);
        //die;
        $commu = new Communication();
        if ($person_commu_id != "new") {
            $commu = $commu->where("id", "=", $person_id)->first();
            if (empty($commu) || !($commu->first())) {
                $data['error'] = 1;
                $data['error_mess'] = "Not valid person data";
                return $data;
            }

            $commu->companyrefno = Input::get('comp_no');
            $commu->personrefno = Input::get('person_ref_no');
            $commu->type = Input::get('commu_type');
            $commu->data = Input::get('commu_value');
            $commu->update();
        } else {
            $commu->communicationno = CommonHelper::random_guid();
            $commu->companyrefno = Input::get('comp_no');
            $commu->personrefno = Input::get('person_ref_no');
            $commu->type = Input::get('commu_type');
            $commu->data = Input::get('commu_value');
            $commu->save();
        }
        $data['success'] = 1;
        $data['success_mess'] = "Successfully saved data for company";
        return $data;
    }

}