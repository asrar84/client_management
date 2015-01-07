<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Countries extends Front_Controller
{

	//--------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->load->model('country_model');
		$this->load->library('form_validation');
		$this->load->library('users/auth');
		parent::__construct();
		
		$this->auth->restrict('Site.Admin.View', site_url('login'));
	}//end __construct()

	public function index(){
		$this->auth->restrict('Site.Admin.View', site_url('login'));
		$countries = $this->country_model->get_list();
		Template::set('countries',$countries);
		Template::render();
	}
	
	public function add(){
		$this->auth->restrict('Site.Admin.View', site_url('login'));
		if($_POST){
			$this->form_validation->set_rules($this->get_validation_rule("add"));
	
			if ($this->form_validation->run())
			{
				if ($this->country_model->add($_POST)){
					Template::set_message('Country added successfully','success');
					Template::redirect("countries");
				}
			}
		}
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
					if ($this->country_model->edit($id, $_POST)){
						Template::set_message('Country edited successfully','success');
						Template::redirect("countries");
					}
				}
			}
			
			$country = $this->country_model->find($id);
			if (!$country)
			{
				Template::set_message('Country you are trying to edit is not in the record','error');
				Template::redirect("countries");
			}
			Template::set("country",$country);
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
						'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'trim|required|is_unique[countries.name]'
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
	
	public function get_all_countries()
	{
		return $this->country_model->get_list();
	}

}//end class
