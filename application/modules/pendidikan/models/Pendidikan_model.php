<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  pendidikan Model
*
* Version: 0.1
*
*/

class Pendidikan_model extends CI_Model
{
	protected static $last;
	function __construct() {
		parent::__construct();
	}
	function get_all_pendidikan() {
		$all_pendidikan = $this->db->query("SELECT * FROM pendidikan")->result();
		self::$last =& $all_pendidikan;
		return self::$last;
	}
	function get_pendidikan_by_id($id) {
		$all_pendidikan = $this->db->query("SELECT * FROM pendidikan WHERE id=?", array($id))->row();
		self::$last =& $all_pendidikan;
		return self::$last;	
	}
	function get_pendidikan_by($field, $id) {
		$all_pendidikan = $this->db->query("SELECT * FROM pendidikan WHERE $field=?", array($id))->result();
		self::$last =& $all_pendidikan;
		return self::$last;	
	}
	function update($id, $data) {
		$all_pendidikan = $this->db->where('id', $id)->update('pendidikan', $data);
		
		return $all_pendidikan;
	}
	function insert($data) {
		$all_pendidikan = $this->db->insert('pendidikan', $data);
		return $all_pendidikan;		
	}
	function delete($id) {
		if (trim($id) != '' && is_numeric($id)) {
			return $this->db->delete('pendidikan', array('id' => $id));
		} else {
			return false;
		}
		
	}
	function get_id_only() {
		$all_pendidikan = $this->db->query("SELECT id FROM pendidikan");
		$res = array();
		if($all_pendidikan->num_rows()) {
			$all_pendidikan = $all_pendidikan->result();
			foreach ($all_pendidikan as $value) {
				$res[] = $value->id;
			}
		}
		return $res;
	}
}