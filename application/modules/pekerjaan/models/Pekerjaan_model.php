<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  pekerjaan Model
*
* Version: 0.1
*
*/

class Pekerjaan_model extends CI_Model
{
	protected static $last;
	function __construct() {
		parent::__construct();
	}
	function get_all_pekerjaan() {
		$all_pekerjaan = $this->db->query("SELECT * FROM pekerjaan")->result();
		self::$last =& $all_pekerjaan;
		return self::$last;
	}
	function get_pekerjaan_by_id($id) {
		$all_pekerjaan = $this->db->query("SELECT * FROM pekerjaan WHERE id=?", array($id))->row();
		self::$last =& $all_pekerjaan;
		return self::$last;	
	}
	function get_pekerjaan_by($field, $id) {
		$all_pekerjaan = $this->db->query("SELECT * FROM pekerjaan WHERE $field=?", array($id))->result();
		self::$last =& $all_pekerjaan;
		return self::$last;	
	}
	function update($id, $data) {
		$all_pekerjaan = $this->db->where('id', $id)->update('pekerjaan', $data);
		
		return $all_pekerjaan;
	}
	function insert($data) {
		$all_pekerjaan = $this->db->insert('pekerjaan', $data);
		return $all_pekerjaan;		
	}
	function delete($id) {
		if (trim($id) != '' && is_numeric($id)) {
			return $this->db->delete('pekerjaan', array('id' => $id));
		} else {
			return false;
		}
		
	}
	function get_id_only() {
		$all_pekerjaan = $this->db->query("SELECT id FROM pekerjaan");
		$res = array();
		if($all_pekerjaan->num_rows()) {
			$all_pekerjaan = $all_pekerjaan->result();
			foreach ($all_pekerjaan as $value) {
				$res[] = $value->id;
			}
		}
		return $res;
	}
}