<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  keluarga Model
*
* Version: 0.1
*
*/

class Laporan_penduduk_model extends CI_Model
{
	protected static $last;
	function __construct() {
		parent::__construct();
	}
	function get_all_keluarga() {
		$SQL = 'SELECT k.*, ak.`id_penduduk`, ak.`status`, p.`nama` AS nama_kk FROM keluarga k LEFT OUTER JOIN anggota_keluarga ak  ON k.`id` = ak.`id_keluarga` AND (ak.`status` = 1 OR ak.`status` = 2) LEFT OUTER JOIN `data-penduduk` p  ON ak.`id_penduduk` = p.`id` GROUP BY k.id ORDER BY k.`id` ASC, ak.status ASC ';
		return $this->db->query($SQL)->result();
	}
	function get_all_penduduk() {
		$SQL = 'SELECT p.id, p.nik, p.`nama`, p.`jenis_kelamin`, p.`tempat_lahir`, p.`tgl_lahir`,  ag.nama AS agama, p.`agama` AS ag, p.`status_nikah`, pnd.nama AS pendidikan, pkr.nama AS pekerjaan, ak.`id_keluarga`, sk.nama AS `status`, ak.ayah, ak.ibu FROM `data-penduduk` p LEFT JOIN `anggota_keluarga` ak ON p.`id` = ak.`id_penduduk` LEFT OUTER JOIN status_keluarga sk ON ak.`status` = sk.id LEFT OUTER JOIN agama ag ON p.`agama` = ag.id LEFT OUTER JOIN pendidikan pnd ON p.`pendidikan` = pnd.id LEFT OUTER JOIN pekerjaan pkr ON p.`pekerjaan` = pkr.id ';
		$hasil = $this->db->query($SQL)->result();
		$debt = array();
		foreach($hasil as $_val) {
			if(is_null($_val->id_keluarga)) {
				$debt['last'][] = $_val;
			}
			else {
				$debt[$_val->id_keluarga][] = $_val;
			}
		}
		return $debt;
	}
	function jk() {
		$SQL = "SELECT 
		SUM(LOWER(dp.jenis_kelamin) = 'l') AS lk, 
		SUM(LOWER(dp.jenis_kelamin) = 'p') AS pr,
		COUNT(DISTINCT(ak.id_keluarga)) AS jumlah_kk,
		COUNT(dp.id) AS jumlah_penduduk,
		SUM(
			dp.tgl_lahir < DATE_SUB(CURRENT_DATE(), INTERVAL 17 YEAR)
			OR dp.status_nikah = 1
		) AS potensial_pemilih
		FROM `data-penduduk` dp
		LEFT OUTER JOIN anggota_keluarga ak
		ON dp.id = ak.id_penduduk 
		";
		return $this->db->query($SQL)->row();
	}
	function get_count_agama($id) {
		return $this->db->where('agama', $id)->get('data-penduduk')->num_rows();
	}
	function get_count_status_nikah($id) {
		return $this->db->where('status_nikah', $id)->get('data-penduduk')->num_rows();
	}
	function get_count_pendidikan_terakhir($id) {
		return $this->db->where('pendidikan', $id)->get('data-penduduk')->num_rows();
	}
}