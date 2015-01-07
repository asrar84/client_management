<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers get a jumpstart their development of CodeIgniter applications
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2012, Bonfire Dev Team
 * @license   http://guides.cibonfire.com/license.html
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Activities
 *
 * Provides a simple and consistent way to record and display user-related activities
 * in both core- and custom-modules.
 *
 * @package    Bonfire
 * @subpackage Modules_Activities
 * @category   Models
 * @author     Bonfire Dev Team
 * @link       http://guides.cibonfire.com/helpers/file_helpers.html
 *
 */
class Country_model extends BF_Model
{

	protected $table = 'countries';
	protected $key = 'id';
	protected $soft_deletes = FALSE;
	protected $date_format = 'datetime';
	protected $set_created = FALSE;
	protected $set_modified = FALSE;

	public function add($input){
		$data = array(
			'name' => $input['name']
		);
		return parent::insert($data);
	}
	
	public function edit($id,$input){
		$data = array(
			'name' => $input['name']
		);
		return parent::update($id, $data);
	}
	
	public function get_list(){
		return parent::find_all();
	}
	//--------------------------------------------------------------------

}//end class
