<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  agama Model
*
* Version: 0.1
*
*/

class Agama_model extends CI_Model
{
	protected static $last;
	function __construct() {
		parent::__construct();
	}
	function get_all_agama() {
		$all_agama = $this->db->query("SELECT * FROM agama")->result();
		self::$last =& $all_agama;
		return self::$last;
	}
	function get_agama_by_id($id) {
		$all_agama = $this->db->query("SELECT * FROM agama WHERE id=?", array($id))->row();
		self::$last =& $all_agama;
		return self::$last;	
	}
	function get_agama_by($field, $id) {
		$all_agama = $this->db->query("SELECT * FROM agama WHERE $field=?", array($id))->result();
		self::$last =& $all_agama;
		return self::$last;	
	}
	function update($id, $data) {
		$all_agama = $this->db->where('id', $id)->update('agama', $data);
		
		return $all_agama;
	}
	function insert($data) {
		$all_agama = $this->db->insert('agama', $data);
		return $all_agama;		
	}
	function delete($id) {
		if (trim($id) != '' && is_numeric($id)) {
			return $this->db->delete('agama', array('id' => $id));
		} else {
			return false;
		}
		
	}
	function get_id_only() {
		$all_agama = $this->db->query("SELECT id FROM agama");
		$res = array();
		if($all_agama->num_rows()) {
			$all_agama = $all_agama->result();
			foreach ($all_agama as $value) {
				$res[] = $value->id;
			}
		}
		return $res;
	}
}