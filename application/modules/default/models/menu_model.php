<?php
class menu_model extends CI_Model {
	protected $_table = 'tbl_cateproduct';
	public function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	
	public function count_product() {
		// kiem tra co category nao co san pham chua
		if ($this->db->count_all ( $this->_table ) == 0)
			return false;
			
			// lay danh sach cac category trong bang productcategory
		$this->db->distinct ();
		$this->db->select ( 'cate_id' );
		$this->db->order_by ( 'cate_id', 'asc' );
		$cate_id = $this->db->get ( $this->_table )->result_array ();
// 		echo "<pre>";
// 		print_r($cate_id);die();
		// dem so san pham cho moi category
		$this->db->order_by ( "cate_id", "asc" );
		$this->db->group_by ( "cate_id" );
		$this->db->select ( "count('pro_id') as pro_num" );
		$cate_count = $this->db->get ( $this->_table )->result_array ();
		
		foreach ( $cate_id as $value ) {
			$key [] = $value ['cate_id'];
		}
		foreach ( $cate_count as $value ) {
			$num [] = $value ['pro_num'];
		}
		// tao mang co key la category_id, va value la so product trong cate
		$arr = array_combine ( $key, $num );
// 		echo "<pre>";
// 		print_r($arr);die();
		if ($arr == '')
			return false;
		else
			return $arr;
	}
}