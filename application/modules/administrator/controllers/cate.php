<?php
class cate extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("form_validation");
        $this->load->model("cate_model");
        session_start();

    } // end __construct

    public function index(){
        $this->listcate();

    } // end index()

    public function listcate(){
        // $this->load->view("main/mainhead");
        $data = $this->cate_model->getAll();
        // echo "<pre>";
        // print_r($data);
        $_SESSION['listedByID'] = array();

        foreach ($data as $key => $cateDetail) {
            // echo "<div id = 'center'>";
            echo "<ul>";
            $cate_id     = $cateDetail['cate_id'];
            $cate_name   = $cateDetail['cate_name'];
            $cate_parent = $cateDetail['cate_parent'];
            $cate_order  = $cateDetail['cate_order'];
            echo "<li>";
            // echo "<pre>" . "listedByID: ";
            // print_r($listedByID);
            // echo "cate_id: " . $cate_id;
            if(!in_array($cate_id, $_SESSION['listedByID'])){
                echo $cate_name;
                $_SESSION['listedByID'][] = $cate_id;
            }
            
            
            $this->recursive($cate_id,$data);
            echo "</li>";
            echo "</ul>";

        } // end foreach
        // echo "<pre>";
        // print_r($listedByID);
        // echo "</div>"; // end div center
        // $this->load->view("main/mainfoot");
    } // end listcate()

    private function recursive($cate_id_parent,$data){
        foreach ($data as $key => $cateDetail) {
            $cate_id     = $cateDetail['cate_id'];
            $cate_name   = $cateDetail['cate_name'];
            $cate_parent = $cateDetail['cate_parent'];
            $cate_order  = $cateDetail['cate_order'];
            if($cate_parent == $cate_id_parent){
                // echo "<pre>" . "listedByID: ";
                // print_r($listedByID);
                // echo "cate_id: " . $cate_id;
                if(!in_array($cate_id, $_SESSION['listedByID'])){
                    // echo "inarray" .  in_array($cate_id, $listedByID);
                    echo "<ul>";
                    echo "<li>";
                    echo $cate_name;
                    $_SESSION['listedByID'][] = $cate_id;
                    $this->recursive($cate_id,$data);
                    echo "</li>";
                    echo "</ul>";
                }
                
                
            } // end if $cate_parent
        }
    } // end class recursive

    /*public function listcate(){
        $this->load->model("cate_model");
        $this->load->library('pagination');

        $sort_type = "";
        
        if ($this->input->post('btnok')){
            if ($this->input->post('show_all')){
                $_SESSION['show_all'] = $this->input->post('show_all');
            } else{
                unset($_SESSION['show_all']);
                if ($this->input->post('per_page')){
                    $_SESSION['per_page'] = $this->input->post('per_page');
                }
            }
            
            if($this->input->post('sort')){
                $_SESSION['sort_type'] = $this->input->post('sort');
            }
            
        }
        $_SESSION['per_page']  = isset($_SESSION['per_page']) ? $_SESSION['per_page'] : 5;
        $_SESSION['sort_type'] = isset($_SESSION['sort_type']) ? $_SESSION['sort_type'] : "";
        $_SESSION['show_all']  = isset($_SESSION['show_all']) ? $_SESSION['show_all'] : "";

        $config['per_page'] = $_SESSION['per_page'];
        $sort_type          = ($_SESSION['sort_type'] != "none") ? $_SESSION['sort_type'] : "";
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

        $config['base_url']   = base_url("administrator/cate/listcate");
        $config['total_rows'] = $this->cate_model->count_all();
        if($config['per_page'] > $config['total_rows'] || $_SESSION['show_all'] == 'show'){
            $config['per_page'] = $config['total_rows'];
            $page = 1;
        }

        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 4;
        $config['next_link'] = "Sau";
        $config['prev_link'] = "Trước";
        $this->pagination->initialize($config); 

        $start = ($page - 1) * $config['per_page'];

        // echo "sort_type " . $sort_type . "<br/>";
        // echo "start: " . $start . "<br/>";
        // echo "per_page" . $config['per_page'] . "<br/>";
        // echo "page: " . $page;
        $data['listcate'] = $this->cate_model->get_order($sort_type,$start,$config['per_page']);

        $data['link'] = $this->pagination->create_links();
        $data['per'] = $config['per_page'];
        $data['sort_type'] = $_SESSION['sort_type'];
        $data['show_all'] = $_SESSION['show_all'];

        $this->load->view("cate/listcate",$data);
        // $this->load->view("main/main");

    } // end list_cate()*/
} // end class cate
// end file cate.php