<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  keluarga Model
*
* Version: 0.1
*
*/

class Keluarga_model extends CI_Model
{
	protected static $last;
	function __construct() {
		parent::__construct();
	}
	function get_all_keluarga() {
		$all_keluarga = $this->db->query("SELECT * FROM keluarga")->result();
		self::$last =& $all_keluarga;
		return self::$last;
	}
	function get_keluarga_by_id($id) {
		$all_keluarga = $this->db->query("SELECT * FROM keluarga WHERE id=?", array($id))->row();
		self::$last =& $all_keluarga;
		return self::$last;	
	}
	function get_keluarga_by($field, $id) {
		$all_keluarga = $this->db->query("SELECT * FROM keluarga WHERE $field=?", array($id))->result();
		self::$last =& $all_keluarga;
		return self::$last;	
	}
	function update($id, $data) {
		$all_keluarga = $this->db->where('id', $id)->update('keluarga', $data);
		
		return $all_keluarga;
	}
	function insert($data) {
		$all_keluarga = $this->db->insert('keluarga', $data);
		return $all_keluarga;		
	}
	function delete($id) {
		if (trim($id) != '' && is_numeric($id)) {
			return $this->db->delete('keluarga', array('id' => $id));
		} else {
			return false;
		}
		
	}
	function get_id_only() {
		$all_keluarga = $this->db->query("SELECT id FROM keluarga");
		$res = array();
		if($all_keluarga->num_rows()) {
			$all_keluarga = $all_keluarga->result();
			foreach ($all_keluarga as $value) {
				$res[] = $value->id;
			}
		}
		return $res;
	}
}