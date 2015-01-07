<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class States extends Front_Controller
{

	//--------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->load->model('countries/country_model');
		$this->load->model('state_model');
		$this->load->library('form_validation');
		$this->load->library('users/auth');
		
		parent::__construct();
	}//end __construct()

	public function index(){
		
		$this->auth->restrict('Site.Admin.View', site_url('login'));
		
		$states = $this->state_model->get_list();
		Template::set('states',$states);
		Template::render();
	}
	
	public function add(){
		
		$this->auth->restrict('Site.Admin.View', site_url('login'));
		
		if($_POST){
			$this->form_validation->set_rules($this->get_validation_rule("add"));
	
			if ($this->form_validation->run())
			{
				if ($this->state_model->add($_POST)){
					Template::set_message('State added successfully','success');
					Template::redirect("states");
				}
			}
		}
		
		$countries_dd = $this->get_company_drop_down_array();
		if (!$countries_dd)
		{
			Template::set_message('No counrty is available. Please first add the country.','error');
			Template::redirect("states");
		}
		
		Template::set('countries_dd',$countries_dd);
		Template::render();
	}
	
	public function edit($id=""){
		
		$this->auth->restrict('Site.Admin.View', site_url('login'));
		
		if ($id){
			if($_POST){
				$_POST["id"]=$id;
				$this->load->library('form_validation');
				$this->form_validation->set_rules($this->get_validation_rule("edit"));
		
				if ($this->form_validation->run())
				{
					if ($this->state_model->edit($id, $_POST)){
						Template::set_message('State edited successfully','success');
						Template::redirect("states");
					}
				}
			}
			
			$state = $this->state_model->find($id);
			if (!$state)
			{
				Template::set_message('State you are trying to edit is not in the record','error');
				Template::redirect("states");
			}
			
			$countries_dd = $this->get_company_drop_down_array();
			if (!$countries_dd)
			{
				Template::set_message('No counrty is available. Please first add the country.','error');
				Template::redirect("states");
			}
			
			Template::set('countries_dd',$countries_dd);
			Template::set("state",$state);
			Template::render();
		}else{
			show_404();
		}
	}
	
	public function delete(){
	
	}
	
	public function get_validation_rule($validation){
		$config = array(
			'add' => array(
             	array(
						'field' => 'country_id',
                        'label' => 'Country',
                        'rules' => 'trim|required|integer|callback_check_valid_country'
                      ),
             	array(
						'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|callback_check_unique'
                      ),
				),
			'edit' => array(
				array(
						'field' => 'country_id',
                        'label' => 'Country',
                        'rules' => 'trim|required|integer|callback_check_valid_country'
                      ),
             	array(
						'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|callback_check_unique_on_edit'
                      ),
				),
			);
			
			$this->form_validation->set_message('check_valid_country','Not a valid Country');
			$this->form_validation->set_message('check_unique','State with the same name already exist in this Country');
			$this->form_validation->set_message('check_unique_on_edit','State with the same name already exist in this Country');
			
			return $config[$validation];
	}
	//--------------------------------------------------------------------

	public function check_unique($str){
		$country_id = $_POST["country_id"];
		$this->state_model->where("country_id",$country_id);
		$this->state_model->where("name",$str);
		$states = $this->state_model->find_all();
		
		if($states)
			return false;
		else 
			return true;
	}

	public function check_unique_on_edit($str){
		$id = $_POST["id"];
		$country_id = $_POST["country_id"];
		$this->state_model->where("id <>",$id);
		$this->state_model->where("country_id",$country_id);
		$this->state_model->where("name",$str);
		$states = $this->state_model->find_all();
		
		if($states)
			return false;
		else 
			return true;
	}

	public function check_valid_country($str){
		
		$this->country_model->where("id",$str);
		$countries = $this->country_model->find_all();
		
		if($countries)
			return true;
		else 
			return false;
	}
	
	private function get_company_drop_down_array()
	{
		$countries = $this->country_model->get_list();
		if ($countries)
		{
			$countries_dd = array();
			$countries_dd[''] = ' -Select Country- ';
			foreach ($countries as $country)
			{
				$countries_dd[$country->id] = $country->name;
			}
			return $countries_dd;
		}
		else {
			return false;
		}
	}
	
	public function get_list_by_country($country_id)
	{
		$states = $this->state_model->get_list_by_country($country_id);
		$state_dd = array();
		if ($states)
		{
			foreach ($states as $state)
				array_push($state_dd,array('id'=>$state->id,'name'=>$state->name));
		}
		
		echo json_encode($state_dd);
	}

}//end class
