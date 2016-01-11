<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  penduduk Model
*
* Version: 0.1
*
*/

class Penduduk_model extends CI_Model
{
	protected static $last;
	function __construct() {
		parent::__construct();
	}
	function get_all_penduduk() {
		$all_penduduk = $this->db->query("SELECT * FROM `data-penduduk`")->result();
		self::$last =& $all_penduduk;
		return self::$last;
	}
	function get_penduduk_by_id($id) {
		$all_penduduk = $this->db->query("SELECT * FROM `data-penduduk` WHERE id=?", array($id))->row();
		self::$last =& $all_penduduk;
		return self::$last;	
	}
	function get_penduduk_by($field, $id) {
		$all_penduduk = $this->db->query("SELECT * FROM `data-penduduk` WHERE $field=?", array($id))->result();
		self::$last =& $all_penduduk;
		return self::$last;	
	}
	function update($id, $data) {
		$all_penduduk = $this->db->where('id', $id)->update('data-penduduk', $data);
		
		return $all_penduduk;
	}
	function insert($data) {
		$all_penduduk = $this->db->insert('data-penduduk', $data);
		return $all_penduduk;		
	}
	function delete($id) {
		if (trim($id) != '' && is_numeric($id)) {
			return $this->db->delete('data-penduduk', array('id' => $id));
		} else {
			return false;
		}
		
	}
	function get_id_only() {
		$all_penduduk = $this->db->query("SELECT id FROM `data-penduduk`");
		$res = array();
		if($all_penduduk->num_rows()) {
			$all_penduduk = $all_penduduk->result();
			foreach ($all_penduduk as $value) {
				$res[] = $value->id;
			}
		}
		return $res;
	}
}