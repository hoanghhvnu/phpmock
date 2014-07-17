<?php
class user extends CI_Controller{
    function __construct(){
        parent::__construct();

    } // end __construct

    public function index(){
        echo "admin modules";
        echo __METHOD__;
    } // end index()

    public function listUser(){
        $this->load->model("user_model");

        $data['listuser'] = $this->user_model->listUser();
        $this->load->view("user/listuser",$data);
    } // 
    public function insertUser(){
        $this->load->model("user_model");
        $this->load->view('user/insertuser');
        if ($this->input->post('btnok')){
            if($this->input->post('usr_password') == $this->input->post('usr_retype_password')){
                $dataUser = array(
                        'usr_name'            => $this->input->post('usr_name'),
                        'usr_password'        => $this->input->post('usr_password'),
                        'usr_email'           => $this->input->post('usr_email'),
                        'usr_address'         => $this->input->post('usr_address'),
                        'usr_phone'           => $this->input->post('usr_phone'),
                        'usr_gender'          => $this->input->post('usr_gender'),
                        'usr_level'           => $this->input->post('usr_level')
                        );
                /*echo "<pre>";
                print_r($dataUser);*/
                $this->user_model->insert($dataUser);
            }
        } // end isset btnok
    } // end insertUser()
}
// end class user
// end file controller/user.php
