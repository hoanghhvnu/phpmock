<?php
class user_model extends CI_Model{
    
    public function listUser()
    {
        $data = array("name","email","address");
        return $data;    
    }
}