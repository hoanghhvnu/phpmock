<?php
class user extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("form_validation");

    } // end __construct

    public function index(){
        // echo "admin modules";
        // echo __METHOD__;
        //echo base_url();
        // header("location:base_url('administrator/user/listUser')");
        // $ur =   base_url('administrator/user/listuser');
        // echo $ur;
        // redirect('/administrator/user/listuser','refresh');

    } // end index()

    public function listUser(){
        $this->load->model("user_model");

        $data['listuser'] = $this->user_model->getAll();
        
        $this->load->view("user/listuser",$data);
    } // 
    public function insertUser(){
        $this->load->model("user_model");
        $this->load->view('user/insertuser');
        if ($this->input->post('btnok')){
            $this->form_validation->set_rules('usr_name','Username', 'require | alpha_numeric | min_length[6]');
            $this->form_validation->set_rules('usr_password','Password', 'require | min_length[6] | matches[usr_retype_password]');
            $this->form_validation->set_rules('usr_retype_password','Retype-Password', 'require');
            $this->form_validation->set_rules('usr_email','Email', 'require | valid_email');
            $this->form_validation->set_rules('usr_address','Address', 'require');
            $this->form_validation->set_rules('usr_phone','Phone', 'require | numeric | min_length[9] | max_length[11]');
            $this->form_validation->set_rules('usr_gender','Gender', 'require');
            if($this->form_validation->run()){
                $dataUser = array(
                        'usr_name'            => $this->input->post('usr_name'),
                        'usr_password'        => $this->input->post('usr_password'),
                        'usr_email'           => $this->input->post('usr_email'),
                        'usr_address'         => $this->input->post('usr_address'),
                        'usr_phone'           => $this->input->post('usr_phone'),
                        'usr_gender'          => $this->input->post('usr_gender'),
                        'usr_level'           => $this->input->post('usr_level')
                        ); // end array
                /*echo "<pre>";
                print_r($dataUser);*/
                $this->user_model->insert($dataUser);
                redirect(base_url("administrator/user/listuser"));

            } // end from_validation->run()
        } // end isset btnok
    } // end insertUser()
}
// end class user
// end file controller/user.php
