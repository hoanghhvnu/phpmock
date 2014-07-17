<?php
class news extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("news_model");
        $this->load->library("form_validation");
    }
    public function index()
    {
        echo __METHOD__;
    }
    public function insert()
    {
         
        if($this->input->post("ok")){
            $this->form_validation->set_rules("name","Ten thanh vien ","trim|required");
            $this->form_validation->set_rules("email","Email ","trim|required|valid_email");
            $this->form_validation->set_rules("address","Dia chi ","trim|required");
            $this->form_validation->set_rules("phone","So dien thoai ","trim|required");
            
            $this->form_validation->set_message("required","%s khong duoc bo trong");
            $this->form_validation->set_message("min_length","%s khong duoc nho hon %d ky tu");
            $this->form_validation->set_message("matches","%s khong dung");
            $this->form_validation->set_message("valid_email","%s khong dung dinh dang");
            $this->form_validation->set_message("numeric","%s phai la so");
            $this->form_validation->set_error_delimiters("<span class='error'>","</span>");
            if($this->form_validation->run()){
                $dataUser = array(
                                "name"=>$this->input->post("name"),
                                "email"=>$this->input->post("email"),
                                "address"=>$this->input->post("address"),
                                "phone"=>$this->input->post("phone")
                            );
                $this->news_model->insert($dataUser);
                redirect(base_url("/Day1/news/listnew"));
            }
            
        }
        $data = array();
        $this->load->view("news/insert",$data);
    }
    public function update()
    {
        $id = $this->uri->segment(3);
        $data['userInfo'] = $this->news_model->detail($id);
        if($this->input->post("ok")){
            $this->form_validation->set_rules("name","Ten thanh vien ","trim|required");
            $this->form_validation->set_rules("email","Email ","trim|required|valid_email");
            $this->form_validation->set_rules("address","Dia chi ","trim|required");
            $this->form_validation->set_rules("phone","So dien thoai ","trim|required");
            
            $this->form_validation->set_message("required","%s khong duoc bo trong");
            $this->form_validation->set_message("min_length","%s khong duoc nho hon %d ky tu");
            $this->form_validation->set_message("matches","%s khong dung");
            $this->form_validation->set_message("valid_email","%s khong dung dinh dang");
            $this->form_validation->set_message("numeric","%s phai la so");
            $this->form_validation->set_error_delimiters("<span class='error'>","</span>");
            if($this->form_validation->run()){
                $dataUser = array(
                                "name"=>$this->input->post("name"),
                                "email"=>$this->input->post("email"),
                                "address"=>$this->input->post("address"),
                                "phone"=>$this->input->post("phone")
                            );
                $this->news_model->update($dataUser,$id);
                redirect(base_url("/Day1/news/listnew"));
            }
        }
        $this->load->view("news/update",$data);
        
    }
    public function listnew()
    {
        $data['listuser'] = $this->news_model->getAll();
        $data['name'] = "htkhoi";
        $this->load->view("news/listnew",$data);
    }
    public function delete()
    {
        $id = $this->uri->segment(3);
        $this->news_model->deleteUser($id);
        redirect(base_url("/Day1/news/listnew"));
    }
    
}