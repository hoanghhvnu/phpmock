<?php
class config_model extends CI_Model {
	protected $_table = 'tbl_config';
	protected $_primary = 'perpage';
	public function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	public function getPerpage() {
		$raw = $this->db->get ( $this->_table )->row_array ();
		return $raw['perpage'];
	}
}
