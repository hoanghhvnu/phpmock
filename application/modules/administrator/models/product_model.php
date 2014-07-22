<?php

/**
 * @author easyvn.net
 * @copyright 2014
 */

class product_model extends CI_Model{
    protected $_table = 'tbl_product';
    protected $_primary = 'pro_id';
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    
  //  public function getAll(){
  //      $list = $this->db->get($this->_table);
  //      return $list->result_array();
  //  }
    
    public function countAll(){
        return $this->db->count_all_results($this->_table);
    }
    public function get_page($limit, $start){
        $this->db->limit($limit,$start);
        return $this->db->get($this->_table)->result_array();
    } // end get_page()
    
    public function get_order($type = '', $limit = '', $start = ''){
        $sql = "SELECT * FROM {$this->_table}";
        //if($type) $sql .=" ORDER BY bran_name {$type}";
        $sql .= " LIMIT {$limit},{$start}";
      //  echo $sql;
        $result = mysql_query($sql);

       // print_r($result);
        $data = array();
        while($row = mysql_fetch_assoc($result)){
            $data[] = $row; 
        }
        return $data;
    } // end get_order()

    // writen by HoangHH
    public function deleteProduct($id){
        $this->db->where("pro_id = $id");
        $this->db->delete($this->_table);
        $this->db->where("pro_id = $id");
        $this->db->delete("tbl_cateproduct");
    
    } // end deleteProduct

    // writen by HoangHH
    // public function getAllBrand(){
    //     $sql = "SELECT * FROM tbl_bran";
    //     $result = mysql_query($sql);
    //     $data = array();
    //     while($row = mysql_fetch_assoc($result)){
    //         $data[] = $row; 
    //     }
    //     return $data;
    // } // end getAllBrand

    // writen by HoangHH
    public function getAllCountry(){
        $sql = "SELECT * FROM tbl_country";
        $result = mysql_query($sql);
        $data = array();
        while($row = mysql_fetch_assoc($result)){
            $data[] = $row; 
        }
        return $data;
    } // end getAllCountry

    // writen by HoangHH
    public function getSearch($where,$limit,$start){
        // return $this->db->get_where($this->_table, $where, $limit, $start) -> result_array();
        $this->db->where($where);
        $this->db->limit($limit,$start);
        return $this->db->get($this->_table)->result_array();
        // // echo $query;
        // $data = array();
        // foreach ($query->result() as $row)
        // {
        //     $data[] = $row;
        // }
        // return $data;
        // while($row = mysql_fetch_assoc($query)){
        //     $data[] = $row; 
        // }
        // return $data;
    } // end getSearch()
} // end class product_model

?>