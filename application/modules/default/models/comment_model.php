<?php
class comment_model extends CI_Model{
	protected $_table = 'tbl_comment';
	
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	
	}
	
	public function insert($data){
		$this->db->insert($this->_table,$data);
	}
	public function getAll($id){
		$this->db->where("pro_id = $id");
		return $this->db->get($this->_table)->result_array();
	}
	public function getOnce($id){
		$this->db->where("pro_id = $id");
		return $this->db->get($this->_table)->row_array();
	}
}