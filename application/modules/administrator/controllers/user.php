<?php
class user extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("form_validation");
        $this->load->model("user_model");


    } // end __construct

    public function index(){


    } // end index()

    public function listUser(){
        $this->load->model("user_model");

        $data['listuser'] = $this->user_model->getAll();
        
        $this->load->view("user/listuser",$data);
    } // 
    public function insertUser(){
        $this->load->model("user_model");
        $dataUser = array();
        if ($this->input->post('btnok')){
            $this->form_validation->set_rules('usr_name','Username', 'required|alpha_numeric|min_length[6]');
            $this->form_validation->set_rules('usr_password','Password', 'required|min_length[6]|matches[usr_retype_password]');
            $this->form_validation->set_rules('usr_retype_password','Retype-Password', 'required');
            $this->form_validation->set_rules('usr_email','Email', 'required|valid_email');
            $this->form_validation->set_rules('usr_address','Address', 'required');
            $this->form_validation->set_rules('usr_phone','Phone', 'required|numeric|min_length[9]|max_length[11]');
            $this->form_validation->set_rules('usr_gender','Gender', 'required');

            $this->form_validation->set_message("required","%s không được bỏ trống");
            $this->form_validation->set_message("min_length","%s không được nhỏ hơn %d ký tự");
            $this->form_validation->set_message("max_length","%s không được lớn hơn %d ký tự");
            $this->form_validation->set_message("matches","%s không khớp");
            $this->form_validation->set_message("valid_email","%s không đúng định dạng");
            $this->form_validation->set_message("numeric","%s phải là số");
            $this->form_validation->set_error_delimiters("<span class='error'>","</span>");
            // echo $this->input->post("usr_level");
            // if($this->input->post("usr_level")){
            //     $dataUser['usr_level'] = $this->input->post("usr_level");
            // }
            // echo $dataUser['usr_level'];
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
                
                $this->user_model->insert($dataUser);
                redirect(base_url("administrator/user/listuser"));
            } // end from_validation->run()

        } // end isset btnok
        $this->load->view('user/insertuser',$dataUser);
    } // end insertUser()

    // writen by VietDQ
    public function delete()
    {
        $id = $this->uri->segment(4);
        $this->user_model->deleteUser($id);
        // redirect(base_url("/administrator/user/listuser"));
        redirect(base_url("administrator/user/listuser"));
    }
}
// end class user
// end file controller/user.php
