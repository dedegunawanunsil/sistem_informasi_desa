<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  status_nikah Model
*
* Version: 0.1
*
*/

class Status_nikah_model extends CI_Model
{
	protected static $last;
	function __construct() {
		parent::__construct();
	}
	function get_all_status_nikah() {
		$all_status_nikah = $this->db->query("SELECT * FROM status_nikah")->result();
		self::$last =& $all_status_nikah;
		return self::$last;
	}
	function get_status_nikah_by_id($id) {
		$all_status_nikah = $this->db->query("SELECT * FROM status_nikah WHERE id=?", array($id))->row();
		self::$last =& $all_status_nikah;
		return self::$last;	
	}
	function get_status_nikah_by($field, $id) {
		$all_status_nikah = $this->db->query("SELECT * FROM status_nikah WHERE $field=?", array($id))->result();
		self::$last =& $all_status_nikah;
		return self::$last;	
	}
	function update($id, $data) {
		$all_status_nikah = $this->db->where('id', $id)->update('status_nikah', $data);
		
		return $all_status_nikah;
	}
	function insert($data) {
		$all_status_nikah = $this->db->insert('status_nikah', $data);
		return $all_status_nikah;		
	}
	function delete($id) {
		if (trim($id) != '' && is_numeric($id)) {
			return $this->db->delete('status_nikah', array('id' => $id));
		} else {
			return false;
		}
		
	}
	function get_id_only() {
		$all_status_nikah = $this->db->query("SELECT id FROM status_nikah");
		$res = array();
		if($all_status_nikah->num_rows()) {
			$all_status_nikah = $all_status_nikah->result();
			foreach ($all_status_nikah as $value) {
				$res[] = $value->id;
			}
		}
		return $res;
	}
}