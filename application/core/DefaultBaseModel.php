<?php
class DefaultBaseModel extends CI_Model{
	public function __construct()
	{
	    parent::__construct();
	     $this->load->database();   
	}

	public function getProductDetail($id){
		$this->db->where("pro_id = $id");
		return $this->db->get("tbl_product")->row_array();
	}
}