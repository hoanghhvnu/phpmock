<?php
class user_model extends CI_Model{

    protected $_table = 'tbl_user';
    protected $_primary = 'usr_id';


    public function __construct(){
        parent::__construct();
        $this->load->database();

    } // end __construct()

    public function getAll(){
        return $this->db->get($this->_table)->result_array();
    } // end listUser();
    public function insert($data){
        $this->db->insert($this->_table,$data);
    } // end insert()

    public function getOnce($id){
        $this->db->where("usr_id = $id");
        return $this->db->get($this->_table)->row_array(); 
    } // end getOnce

    
}
// end class CI_model
// end file model/user_model.php