<?php
class user extends CI_Controller
{
    public function  __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->load->view("user/default");
    }
    public function insert()
    {
        
        $this->load->model("user_model");
        $data['name'] = "htkhoi";
        $data['userInfo'] = $this->user_model->listUser();
        $this->load->view("user/default",$data);
        
    }
}