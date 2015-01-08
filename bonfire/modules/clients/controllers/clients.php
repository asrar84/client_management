<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Clients extends Front_Controller
{

	//--------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->load->model('client_model');
		$this->load->library('form_validation');
		$this->load->library('users/auth');
		parent::__construct();
	}//end __construct()

	public function index(){
		$this->auth->restrict('Site.Admin.View', site_url('clients/registration'));
		
		$search_filters = array();
		if($_POST)
		{
			if (isset($_POST['seach_client_name']) && $_POST['seach_client_name']!='')
				$search_filters['client_name'] = $_POST['seach_client_name'];
			
		}
		$clients = $this->client_model->search_list($search_filters);
		Template::set('clients',$clients);
		Template::render();
	}
	
	public function registration(){
		$this->load->model('states/state_model');
		$this->load->model('cities/city_model');
		$state_dd = array(''=>' -Select- ');
		$city_dd = array(''=>' -Select- ');
		
		if($_POST){
			//var_dump($_POST);die();
			$this->form_validation->set_rules($this->get_validation_rule("add"));
	
			if ($this->form_validation->run())
			{
				if ($this->client_model->add($_POST)){
					$this->load->library('emailer/emailer');
					
					$mail_data = array(
						'to' => $_POST['email'],
						'subject' => 'Registered successfully with Dquip',
						'message' => 'Dear '.$_POST['client_name'].',
									Thank you for registering with Dquip'
					);
					$this->emailer->send($mail_data);
					//TODO integrate sms api and send sms.
					Template::set_message('Client registered successfully','success');
					Template::redirect("login");
				}
			}
			
			if (!empty($_POST['country_id']))
			{
				$states = $this->state_model->get_list_by_country($_POST['country_id']);
				if ($states)
				{
					foreach ($states as $state)
						$state_dd[$state->id] = $state->name;
				}
			}
			if (!empty($_POST['state_id']))
			{
				$cities = $this->city_model->get_list_by_state($_POST['state_id']);
				if ($cities)
				{
					foreach ($cities as $city)
						$city_dd[$city->id] = $city->name;
				}
			}
		}
		
		$this->load->model('countries/country_model');
		$countries = $this->country_model->get_list();
		$country_dd = array('' => ' -Select- ');
		foreach ($countries as $country)
			$country_dd[$country->id] = $country->name;
		
		Template::set('country_dd',$country_dd);
		Template::set('state_dd',$state_dd);
		Template::set('city_dd',$city_dd);
		Template::render();
	}
	
	/*public function edit($id=""){
		
	}
	
	public function delete(){
	
	}*/
	
	public function get_validation_rule($validation){
		$config = array(
			'add' => array(
             	array(
						'field' => 'date_added',
                        'label' => 'Date Added',
                        'rules' => 'trim|required'
                      ),
             	array(
						'field' => 'company_name',
                        'label' => 'Company Name',
                        'rules' => 'trim|required|alpha_numeric|max_length[170]'
                      ),
             	array(
						'field' => 'client_name',
                        'label' => 'Client Name',
                        'rules' => 'trim|required|alpha|max_length[150]'
                      ),
             	array(
						'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email|max_length[120]|is_unique[users.email]'
                      ),
             	array(
						'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|required|max_length[40]'
                      ),
             	array(
						'field' => 'pass_confirm',
                        'label' => 'Confirm Password',
                        'rules' => 'trim|required|max_length[40]|matches[password]'
                      ),
             	array(
						'field' => 'country_id',
                        'label' => 'Country',
                        'rules' => 'trim|required|integer'
                      ),
             	array(
						'field' => 'state_id',
                        'label' => 'State',
                        'rules' => 'trim|required|integer'
                      ),
             	array(
						'field' => 'city_id',
                        'label' => 'City',
                        'rules' => 'trim|required|integer'
                      ),
             	array(
						'field' => 'zip_code',
                        'label' => 'Zip Code',
                        'rules' => 'trim|required|max_length[11]|integer'
                      ),
             	array(
						'field' => 'street_address',
                        'label' => 'Street Address',
                        'rules' => 'trim|required|max_length[150]'
                      ),
             	array(
						'field' => 'tel_number_code',
                        'label' => 'Telephone Code',
                        'rules' => 'trim|required|max_length[4]|integer'
                      ),
             	array(
						'field' => 'tel_number_number',
                        'label' => 'Telephone Number',
                        'rules' => 'trim|required|max_length[10]|integer'
                      ),
             	array(
						'field' => 'alt_tel_number_code',
                        'label' => 'Alternate Telephone Code',
                        'rules' => 'trim|max_length[10]|integer'
                      ),
             	array(
						'field' => 'alt_tel_number_number',
                        'label' => 'Alternate Telephone Number',
                        'rules' => 'trim|max_length[10]|integer'
                      ),
             	array(
						'field' => 'mobile_number',
                        'label' => 'Mobile Number',
                        'rules' => 'trim|required|max_length[10]|integer'
                      ),
             	array(
						'field' => 'fax_number',
                        'label' => 'Fax Number',
                        'rules' => 'trim|max_length[14]|integer'
                      ),
             	array(
						'field' => 'dob_month',
                        'label' => 'DOB Month',
                        'rules' => 'trim|required'
                      ),
             	array(
						'field' => 'dob_date',
                        'label' => 'DOB Date',
                        'rules' => 'trim|required'
                      ),
             	array(
						'field' => 'gender',
                        'label' => 'Gender',
                        'rules' => 'trim|required'
                      ),
             	array(
						'field' => 'services_taken',
                        'label' => 'Services',
                        'rules' => ''
                      ),
             	array(
						'field' => 'selected_products',
                        'label' => 'Products',
                        'rules' => ''
                      ),
             	array(
						'field' => 'remarks',
                        'label' => 'Remarks',
                        'rules' => 'trim'
                      ),
				),
			'edit' => array(
             	array(
						'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|callback_check_unique_on_edit'
                      ),
				),
			);
			if ($validation == "edit")
				$this->form_validation->set_message('check_unique_on_edit','Country name already exist');
			return $config[$validation];
	}
	//--------------------------------------------------------------------

	public function check_unique_on_edit($str){
		$id = $_POST["id"];
		$this->country_model->where("id <>",$id);
		$this->country_model->where("name",$str);
		$countries = $this->country_model->find_all();
		
		if($countries)
			return false;
		else 
			return true;
	}

}//end class
