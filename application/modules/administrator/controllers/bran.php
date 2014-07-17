<?php
class bran extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("form_validation");

    } // end __construct

    public function index(){
        $this->page();

    } // end index()

    public function listbran(){
        $this->load->model("bran_model");

        $data['listbran'] = $this->bran_model->getAll();
        // $data['count_all'] = $this->bran_model->count_all();
        
        $this->load->view("bran/listbran",$data);
    } // end listbran()

    public function page(){
        // echo $this->input->ge
        // $page = 0;
        // $config['per_page'] = isset($this->input->post('per_page')) ? $this->input->post('per_page') : 5;
        // echo $this->input->post('btnok');
        if ($this->input->post('btnok')){
            if ($this->input->post('per_page')){
                $config['per_page'] = $this->input->post('per_page');

            } else{
                $config['per_page'] = 5;
            }
            
        }else{
            $config['per_page'] = 5;
        }
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
        // echo $page;
        // echo $config['per_page'];
        $this->load->model("bran_model");
        $this->load->library('pagination');
        $config['base_url'] = base_url("administrator/bran/page");
        $config['total_rows'] = $this->bran_model->count_all();
        // echo $config['total_rows'];
        // $config['per_page'] = 6;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 5;
        $config['next_link'] = "Sau";
        $config['prev_link'] = "Trước";
        $this->pagination->initialize($config); 

        $start = ($page - 1) * $config['per_page'];
        $data['listbran'] = $this->bran_model->get_page($config['per_page'],$start);
        $data['link'] = $this->pagination->create_links();
        $data['per'] = $config['per_page'];
        // echo $data['per'];
        $this->load->view("bran/listbran",$data);

    }
} // end class bran
// end file bran.php