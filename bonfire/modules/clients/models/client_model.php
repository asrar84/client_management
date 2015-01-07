<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends BF_Model
{

	public $valid_search_field = array('client_name');
	
	protected $table = 'clients';
	protected $key = 'id';
	protected $soft_deletes = FALSE;
	protected $date_format = 'datetime';
	protected $set_created = FALSE;
	protected $set_modified = FALSE;

	public function add($input){
		$user_data = array(
			'email' => $input['email'],
			'password' => $input['password'],
			'pass_confirm' => $input['pass_confirm'],
		);
		
		$client_data = array(
			'date_added'		=> isset($input['date_added'])?$input['date_added']:date(),
			'company_name'		=> isset($input['company_name'])?$input['company_name']:'',
			'client_name'		=> isset($input['client_name'])?$input['client_name']:'',
			'country_id'		=> isset($input['country_id'])?$input['country_id']:0,
			'state_id'			=> isset($input['state_id'])?$input['state_id']:0,
			'city_id'			=> isset($input['city_id'])?$input['city_id']:0,
			'zip_code'			=> isset($input['zip_code'])?$input['zip_code']:0,
			'street_address'	=> isset($input['street_address'])?$input['street_address']:'',
			'mobile_number'		=> isset($input['mobile_number'])?$input['mobile_number']:0,
			'fax_number'		=> isset($input['fax_number'])?$input['fax_number']:0,
			'gender'			=> isset($input['gender'])?$input['gender']:'',
			'dob'				=> isset($input['dob_month'])&&isset($input['dob_date'])?'1970-'.$input['dob_month'].'-'.$input['dob_date']:date(),
			'services_taken'	=> isset($input['services_taken'])?implode(',',$input['services_taken']):'',
			'selected_products'	=> isset($input['selected_products'])?implode(',',$input['selected_products']):'',
			'remarks'			=> isset($input['remarks'])?$input['remarks']:''
		);
		
		$tel_number_code = isset($input['tel_number_code'])?$input['tel_number_code']:"";
		$tel_number_number = isset($input['tel_number_number'])?$input['tel_number_number']:"";
		$client_data['tel_number'] = $tel_number_code.$tel_number_number;

		$alt_tel_number_code = isset($input['alt_tel_number_code'])?$input['alt_tel_number_code']:"";
		$alt_tel_number_number = isset($input['alt_tel_number_number'])?$input['alt_tel_number_number']:"";
		$client_data['alt_tel_number'] = $alt_tel_number_code.$alt_tel_number_number;
		
		$this->load->model('users/user_model');
		$this->db->trans_begin();
		if ($user_id = $this->user_model->insert($user_data))
		{
			$client_data['user_id'] = $user_id;
			$id = parent::insert($client_data);
		}
		
		if ($this->db->trans_status() === FALSE)
		    $this->db->trans_rollback();
		else
		    $this->db->trans_commit();

		return $id;
	}
	
	public function edit($id,$input){
		$data = array(
			'name' => $input['name']
		);
		return parent::update($id, $data);
	}
	
	public function search_list($search_filters = array()){
		foreach ($search_filters as $key => $value)
		{
			if(in_array($key, $this->valid_search_field))
			{
				if ($key=="client_name")
				{
					parent::where("client_name like ","%".$value."%");
				}
				else 
				{
					parent::where($key,$value);
				}
			}
		}
		return parent::find_all();
	}
	
	public function get_list(){
		return parent::find_all();
	}
	//--------------------------------------------------------------------

}//end class
