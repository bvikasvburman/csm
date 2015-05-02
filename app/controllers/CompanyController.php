<?php

class CompanyController extends BaseController {

	
	public function index()
	{
            $data = array();
            $this->view_data = array(   "js_array" => array(
                                                        "jquery.validate.min",
                                                        'custom/company/index',
                                                        
                                                        )
                                        );
            return View::make('Company.index',array('data'=> $data))->with("view_data",  $this->view_data);
        }
	
	
        public function listingAjax()
	{
            $company = new Company();
            $data = $company->companyListing();
            return json_encode($data);
        }
	
        public function addAjax()
        {
            $company = new Company();
            $edit_mode = Input::get('edit_mode');
            if($edit_mode)
                $data = $company->editAjax();
            else
                $data = $company->addAjax();
            return json_encode($data);
        }
        
        public function getCompanyData()
        {
            $company = new Company();
            $data_id = Input::get('data_id');
            $data = $company->getCompanyData($data_id);
            return json_encode($data);
        }
        
        public function moreData($id = "0")
        {
            $company = new Company();
            $data['company'] = $company->getCompanyData($id);
            
	    $this->view_data = array(   "js_array" => array(
                                                        "jquery.validate.min",
                                                        'custom/company/more_data',
                                                        
                                                        )
                );
	   
	    return View::make('Company.moreData',array('data'=> $data))->with("view_data",  $this->view_data);
        }
        
        
	public function vicData()
        {
            if(Request::isMethod('post')){
		
		$company = new Company();
		
		$id = $id = Input::get('id');
		$data['company'] = $company->getCompanyData($id);
		
		$this->view_data = array(   "js_array" => array(
                                                        "jquery.validate.min",
                                                        'custom/company/more_data',
                                                        )
                );
	   
		$vic =  View::make('Company.vicData',array('data'=> $data))->with("view_data",  $this->view_data);
		
		ob_start();
		echo  View::make('Company.vicData',array('data'=> $data))->with("view_data",  $this->view_data);
		$json_data['html'] = ob_get_contents();
		ob_get_clean();
	    
		$json_data['success'] = 1;
		$json_data['success_mess'] = "";
		$json_data['error_mess'] = "";
		$json_data['error'] = 0;
		
		echo json_encode($json_data);
		die;
	    }
	    
        }
        
	
	public function listingOtherAdd()
	{
            $company = new Company();
            $id = Input::get('comp_id');
            $data = $company->companyOtherAdd($id);
            return json_encode($data);
        }
        
        public function listingPerson()
	{
            $company = new Company();
            $id = Input::get('comp_id');
            $data = $company->companyPerson($id);
            return json_encode($data);
        }
        
        public function companyDelete()
	{
            $company = new Company();
            $data = $company->companyDelete();
            return json_encode($data);
        }
        
        public function deleteOtherAdd()
	{
            $company = new Company();
            $data = $company->deleteOtherAdd();
            return json_encode($data);
        }
        
        public function deletePerson()
	{
            $company = new Company();
            $data = $company->deletePerson();
            return json_encode($data);
        }
        public function saveOtherAdd()
	{
            $company = new Company();
            $id = Input::get('data_id');
            $data = $company->saveOtherAdd($id);
            return json_encode($data);
        }
        
        public function savePerson()
	{
            $company = new Company();
            $id = Input::get('data_id');
            $data = $company->savePerson($id);
            return json_encode($data);
        }
        
        public function savePersonCommu()
	{
            $company = new Company();
            $id = Input::get('data_id');
            $data = $company->savePersonCommu($id);
            return json_encode($data);
        }
        
        public function getPersonCommu()
	{
            $company = new Company();
            $data = $company->getPersonCommu();
            return json_encode($data);
        }
        
}
