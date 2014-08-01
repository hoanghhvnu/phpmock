<?php
class checkout_model extends CI_Model {
	public function __construct() {
		$this->load->database ();
	}
	public function insert_order_detail($data) {
		$this->db->insert ( 'tbl_orderdetail', $data );
	}
	public function insert_order($data) {
		$this->db->insert ( 'tbl_order', $data );
		
		$id = $this->db->insert_id ();
		
		return (isset ( $id )) ? $id : FALSE;
	}
}