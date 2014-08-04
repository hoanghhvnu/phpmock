<?php
class comment_model extends CI_Model{
	protected $_table = "tbl_comment";
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function getAll(){
		echo __METHOD__ . 'ADMIN' ;
		return $this->db->get($this->_table)->result_array();
	}
	
	public function detailComment($com_id)
	{
		$this->db->where('com_id = "'.$com_id.'"');
		return $this->db->get($this->_table)->row_array();
	}
	
	public function aprove($id){
		$data = array(
			'com_status' => 1
		);
		$this->db->where('com_id', $id);
		$this->db->update($this->_table, $data);
	}
	
	public function delete($id){
		$data = array(
			'com_status' => 0
		);
		$this->db->where('com_id', $id);
		$this->db->update($this->_table, $data);
	}
}