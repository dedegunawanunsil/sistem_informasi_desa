<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  kampung Model
*
* Version: 0.1
*
*/

class Kampung_model extends CI_Model
{
	protected static $last;
	function __construct() {
		parent::__construct();
	}
	function get_all_kampung() {
		$all_kampung = $this->db->query("SELECT * FROM `master-kampung`")->result();
		self::$last =& $all_kampung;
		return self::$last;
	}
	function get_kampung_by_id($id) {
		$all_kampung = $this->db->query("SELECT * FROM `master-kampung` WHERE id=?", array($id))->row();
		self::$last =& $all_kampung;
		return self::$last;	
	}
	function get_kampung_by($field, $id) {
		$all_kampung = $this->db->query("SELECT * FROM `master-kampung` WHERE $field=?", array($id))->result();
		self::$last =& $all_kampung;
		return self::$last;	
	}
	function update($id, $data) {
		$all_kampung = $this->db->where('id', $id)->update('master-kampung', $data);
		
		return $all_kampung;
	}
	function insert($data) {
		$all_kampung = $this->db->insert('master-kampung', $data);
		return $all_kampung;		
	}
	function delete($id) {
		if (trim($id) != '' && is_numeric($id)) {
			return $this->db->delete('master-kampung', array('id' => $id));
		} else {
			return false;
		}
		
	}
	function get_id_only() {
		$all_kampung = $this->db->query("SELECT id FROM `master-kampung`");
		$res = array();
		if($all_kampung->num_rows()) {
			$all_kampung = $all_kampung->result();
			foreach ($all_kampung as $value) {
				$res[] = $value->id;
			}
		}
		return $res;
	}
}