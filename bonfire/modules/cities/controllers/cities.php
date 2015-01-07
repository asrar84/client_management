<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cities extends Front_Controller
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
		$this->load->model('states/state_model');
		$this->load->model('city_model');
		$this->load->library('form_validation');
		$this->load->library('users/auth');
		
		parent::__construct();
	}//end __construct()

	public function index(){
		
		$this->auth->restrict('Site.Admin.View', site_url('login'));
		
		$cities = $this->city_model->get_list();
		Template::set('cities',$cities);
		Template::render();
	}
	
	public function add(){
		$this->auth->restrict('Site.Admin.View', site_url('login'));
		
		if($_POST){
			$this->form_validation->set_rules($this->get_validation_rule("add"));
	
			if ($this->form_validation->run())
			{
				if ($this->city_model->add($_POST)){
					Template::set_message('City added successfully','success');
					Template::redirect("cities");
				}
			}
		}
		
		$states_dd = $this->get_state_drop_down_array();
		if (!$states_dd)
		{
			Template::set_message('No state is available. Please first add the state.','error');
			Template::redirect("cities");
		}
		
		Template::set('states_dd',$states_dd);
		Template::render();
	}
	
	public function add_ajax($state_id,$city_name){
		if($this->state_model->find($state_id))
		{
			if (!empty($city_name)&&!$this->city_model->find_by('name',$city_name))
			{
				$city_id = $this->city_model->add(array('state_id'=>$state_id, 'name'=>$city_name));
				echo json_encode(array('id'=>$city_id,'name'=>$city_name));
				return;
			}
			echo json_encode(array('id'=>-1,'name'=>'City Name not Legal'));
			return;
		}
		echo json_encode(array('id'=>-1,'name'=>'State is not availvable'));
		return;
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
					if ($this->city_model->edit($id, $_POST)){
						Template::set_message('City edited successfully','success');
						Template::redirect("cities");
					}
				}
			}
			
			$city = $this->city_model->find($id);
			if (!$city)
			{
				Template::set_message('City you are trying to edit is not in the record','error');
				Template::redirect("cities");
			}
			
			$states_dd = $this->get_state_drop_down_array();
			if (!$states_dd)
			{
				Template::set_message('No state is available. Please first add the state.','error');
				Template::redirect("cities");
			}
			
			Template::set('states_dd',$states_dd);
			Template::set("city",$city);
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
						'field' => 'state_id',
                        'label' => 'State',
                        'rules' => 'trim|required|integer|callback_check_valid_state'
                      ),
             	array(
						'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|callback_check_unique'
                      ),
				),
			'edit' => array(
				array(
						'field' => 'state_id',
                        'label' => 'State',
                        'rules' => 'trim|required|integer|callback_check_valid_state'
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
		$state_id = $_POST["state_id"];
		$this->city_model->where("state_id",$state_id);
		$this->city_model->where("name",$str);
		$cities = $this->city_model->find_all();
		
		if($cities)
			return false;
		else 
			return true;
	}

	public function check_unique_on_edit($str){
		$id = $_POST["id"];
		$state_id = $_POST["state_id"];
		
		$this->city_model->where("id <>",$id);
		$this->city_model->where("state_id",$state_id);
		$this->city_model->where("name",$str);
		$cities = $this->city_model->find_all();
		
		if($cities)
			return false;
		else 
			return true;
	}

	public function check_valid_state($str){
		
		$this->state_model->where("id",$str);
		$states = $this->state_model->find_all();
		
		if($states)
			return true;
		else 
			return false;
	}
	
	private function get_state_drop_down_array()
	{
		$states = $this->state_model->get_list();
		if ($states)
		{
			$states_dd = array();
			$states_dd[''] = ' -Select State- ';
			foreach ($states as $state)
			{
				$states_dd[$state->id] = $state->name;
			}
			return $states_dd;
		}
		else {
			return false;
		}
	}
	
	public function get_list_by_state($state_id)
	{
		$cities = $this->city_model->get_list_by_state($state_id);
		$city_dd = array();
		if ($cities)
		{
			foreach ($cities as $city)
				array_push($city_dd,array('id'=>$city->id,'name'=>$city->name));
		}
		
		echo json_encode($city_dd);
	}

}//end class
