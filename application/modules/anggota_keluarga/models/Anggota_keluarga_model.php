<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  anggota_keluarga Model
*
* Version: 0.1
*
*/

class anggota_keluarga_model extends CI_Model
{
	protected static $last;
	function __construct() {
		parent::__construct();
	}
	function get_all_anggota_keluarga() {
		$all_anggota_keluarga = $this->db->query("SELECT * FROM anggota_keluarga")->result();
		self::$last =& $all_anggota_keluarga;
		return self::$last;
	}
	function get_anggota_keluarga_by_id($id) {
		$all_anggota_keluarga = $this->db->query("SELECT * FROM anggota_keluarga WHERE id=?", array($id))->row();
		self::$last =& $all_anggota_keluarga;
		return self::$last;	
	}
	function get_anggota_keluarga_by($field, $id) {
		$all_anggota_keluarga = $this->db->query("SELECT * FROM anggota_keluarga WHERE $field=?", array($id))->result();
		self::$last =& $all_anggota_keluarga;
		return self::$last;	
	}
	function update($id, $data) {
		$all_anggota_keluarga = $this->db->where('id', $id)->update('anggota_keluarga', $data);
		
		return $all_anggota_keluarga;
	}
	function insert($data) {
		$all_anggota_keluarga = $this->db->insert('anggota_keluarga', $data);
		return $all_anggota_keluarga;		
	}
	function delete($id) {
		if (trim($id) != '' && is_numeric($id)) {
			return $this->db->delete('anggota_keluarga', array('id' => $id));
		} else {
			return false;
		}
		
	}
	function delete_by_id_keluarga($id) {
		if (trim($id) != '' && is_numeric($id)) {
			return $this->db->delete('anggota_keluarga', array('id_keluarga' => $id));
		} else {
			return false;
		}
		
	}
	function get_id_only() {
		$all_anggota_keluarga = $this->db->query("SELECT id FROM anggota_keluarga");
		$res = array();
		if($all_anggota_keluarga->num_rows()) {
			$all_anggota_keluarga = $all_anggota_keluarga->result();
			foreach ($all_anggota_keluarga as $value) {
				$res[] = $value->id;
			}
		}
		return $res;
	}
}