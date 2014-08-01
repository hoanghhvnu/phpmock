<?php
/**
 * HoangHH
 * Jul 23, 2014
 */
class order_model extends CI_model{
	protected $_table = 'tbl_order';
	protected $_primary = 'order_id';
	protected $_name = 'cus_name';
	protected $_email = 'cus_email';
	protected $_phone = 'cus_phone';
	protected $_address = 'cus_address';
	protected $_gender = 'cus_gender';
	protected $_date = 'order_date';
	protected $_status = 'order_status';

	public function __construct(){
		parent::__construct();
		$this->load->database();
	} // end __construc

	public function getAll(){

	    return $this->db->get($this->_table)->result_array();
	} // end listUser();

	public function getOnceById($order_id){
		$this->db->where("{$this->_primary} = {$order_id}");
		return $this->db->get($this->_table)->row_array();
	} // end getOnce
	/**
	 * get orderdetail
	 */
	public function getOrderDetail($order_id){
		$this->db->select('od.pro_name,od.pro_price,od.pro_quantity,od.pro_id');
		$this->db->from("tbl_orderdetail as od");
		$this->db->join('tbl_product as p', "p.pro_id = od.pro_id", 'inner');
		$this->db->where("od.order_id = $order_id");

		// $this->db->where("pro_id = $id");
		return $this->db->get()->result_array();
	} // end getOrderDetail

	// Confirm order
	public function confirmOrder($order_id){
		$data = array(
			'order_status' => 1
			);
		$this->db->where('order_id', $order_id);
		$this->db->update($this->_table, $data); 
	} // end confirmOrder

	// Delete order
	public function deleteOrder($order_id){
		$this->db->where('order_id', $order_id);
		$this->db->delete($this->_table);
	} // end delete

	public function count_all(){
	    // $this->db->from($this->_table);
	    // return $this->db->count_all_results();
	    return $this->db->get($this->_table)->num_rows();
	}

	public function get_order($column, $sortType = '', $limit = '', $start = ''){
	    // $this->db->select("*");
	    // $this->db->from($this->_table);
	    // $this->db->order_by("bran_name");
	    // return $this->db->get($this->_table);
	    $sql = "SELECT * FROM {$this->_table}";
	    if($sortType) $sql .=" ORDER BY {$column} {$sortType}";
	    $sql .= " LIMIT {$limit},{$start}";
	    
	    // echo $sql;
	    $result = mysql_query($sql);
	    $data = array();
	    while($row = mysql_fetch_assoc($result)){
	        $data[] = $row; 
	    }
	    // echo "<pre>";
	    // print_r($data);
	    return $data;
	}


	// writen by HoangHH
	public function getSearch($column = "", $sortType = "", $where = "", $start = "", $limit = ""){
	    // return $this->db->get_where($this->_table, $where, $limit, $start) -> result_array();
	    if($where){
	    	$this->db->where($where);
	    }
	    if($column && $sortType){
	    	$this->db->order_by($column, $sortType); 
	    }
	    if($start && $limit){
	    	$this->db->limit($limit,$start);
	    }
	    
	    return $this->db->get($this->_table)->result_array();
	} // end getSearch()
} // end class order_model