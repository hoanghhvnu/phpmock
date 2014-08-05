<?php
class product_model extends CI_Model {
	protected $_table = "tbl_product";
	public function __construct() {
		parent::__construct ();
		$this->load->database ();
	}
	public function listProduct() {
		return $this->db->get ( $this->_table )->result_array ();
	}
	public function detailProduct($id) {
		$this->db->where ( "pro_id = $id" );
		return $this->db->get ( $this->_table )->row_array ();
	}
	public function countTable() {
		return $this->db->get ( $this->_table )->num_rows ();
	}
	
	function list_all($limit, $start, $SortType = "", $Field = "") {
		if($SortType !="" && $Field){
			$this->db->order_by("{$Field}", "{$SortType}");
		}
		if($limit){
			$this->db->limit($limit,$start);
		}
		return $this->db->get ( $this->_table)->result_array ();
	}
	function count_all() {
		return $this->db->count_all ( $this->_table );
	}

    /**
     * writen by HoangHH
     * 
     */
    public function getSlider(){
        // $this->db->select("pro_id,pro_images");
        // $this->db->where("isSlider = 1");
        return $this->db->get("slider")->result_array();
    }

    /**
     * Huan DT
     */
    public function getAll(){
       $list = $this->db->get($this->_table);
       return $list->result_array();
   }

   public function countAll(){
        return $this->db->count_all_results($this->_table);
    }

    public function get_page($limit, $start){
        $this->db->limit($limit,$start);
        return $this->db->get($this->_table)->result_array();
    } // end get_page()

    public function detail($name)
    {
        $this->db->where('pro_name = "'.$name.'"');
        return $this->db->get($this->_table)->row_array();
    }
	public function detailid($id)
    {
        $this->db->where("pro_id = $id");
        return $this->db->get($this->_table)->row_array();
    }
    
}