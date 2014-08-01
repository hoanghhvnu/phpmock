<?php
class country_model extends CI_Model{

    protected $_table = 'tbl_country';
    protected $_primary = 'coun_id';


    public function __construct(){
        parent::__construct();
        $this->load->database();

    } // end __construct()

    public function getAll(){
        return $this->db->get($this->_table)->result_array();
    } // end listUser();

} // end class
// end file country_model.php