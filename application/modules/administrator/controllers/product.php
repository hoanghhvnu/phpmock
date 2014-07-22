
<?php
/**
 * @author easyvn.net
 * @copyright 2014
 */

class product extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("product_model");
        $this->load->model("bran_model");
        $this->load->model("country_model");
        $this->load->library("pagination");
        $this->load->helper("url");

        session_start();
    }
    public function index(){
        // $this->load->view("product/productList");
        redirect(base_url("administrator/product/listproduct"));
    }
    
//    public function listAll(){
//        $data['listproduct'] = $this->product_model->getAll();
//        $this->load->view("product/productList",$data);
//    }
    
    // Writen by DucTM
    public function listproduct(){
            $sort_type = "";
        
        if ($this->input->post('btnSubmit')){
          //  echo $this->input->post('btnSubmit');
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
        $_SESSION['show_all'] = isset($_SESSION['show_all']) ? $_SESSION['show_all'] : "";

        $config['per_page'] = $_SESSION['per_page'];
        $sort_type= ($_SESSION['sort_type'] != "none") ? $_SESSION['sort_type'] : "";
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

        $config['base_url'] = base_url("administrator/product/listproduct");
        $config['total_rows'] = $this->product_model->countAll();
        if($config['per_page'] > $config['total_rows'] || $_SESSION['show_all'] == 'show'){
            $config['per_page'] = $config['total_rows'];
            $page = 1;
        }

        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 4;
        $config['next_link'] = "Next";
        $config['prev_link'] = "Prev";
        $this->pagination->initialize($config); 

        $start = ($page - 1) * $config['per_page'];
        $data['listproduct'] = $this->product_model->get_order($sort_type,$start,$config['per_page']);

        $data['link'] = $this->pagination->create_links();
        $data['per'] = $config['per_page'];
        $data['sort_type'] = $_SESSION['sort_type'];
        $data['show_all'] = $_SESSION['show_all'];

        $this->load->view("product/listproduct",$data);

    } // end listproduct()

    // writen by HoangHH
    public function delete(){
        $pro_id = $this->uri->segment(4);
        $this->product_model->deleteProduct($pro_id);
        
        redirect(base_url("administrator/product/listproduct"));
    } // end delete()

    // Writen by HoangHH
    public function searchProduct(){
        
        $data['ListBrand'] = $this->bran_model->getAll();
        $data['ListCountry'] = $this->country_model->getAll();

        

        if($this->input->post('btnok')){
            // echo 'button submit press';
            $dataWhere = array(
                'pro_id'         => $this->input->post('pro_id'),
                'pro_name'       => $this->input->post('pro_name'),
                'pro_price'      => $this->input->post('pro_price'),
                'pro_price_sale' => $this->input->post('pro_price_sale'),
                'pro_images'     => $this->input->post('pro_images'),
                'pro_desc'       => $this->input->post('pro_desc'),
                'pro_info'       => $this->input->post('pro_info'),
                'pro_status'     => $this->input->post('pro_status'),
                'bran_id'        => $this->input->post('bran_id'),
                'country_id'     => $this->input->post('coun_id')
                );

            $dataWhereClean = array();
            foreach ($dataWhere as $key => $value) {
                if($value){
                    $dataWhereClean[$key] = $value;
                }
            } // end foreach
            if(empty($dataWhereClean)){
                $data['error'] = "Vui lòng nhập ít nhất một thông tin để tìm kiếm!";
                $data['template'] = "product/SearchProduct";
            } else{
                $_SESSION['DataWhereCleanForSearchProduct'] = $dataWhereClean;
                // $data['SearchResult'] = $this->product_model->getSearch($_SESSION['DataWhereCleanForSearchProduct'],5,0);
                // $data['template'] = "product/SearchResult";
                redirect(base_url("administrator/product/searchResult"));

            } // end else
        }else{
            $data['template'] = "product/SearchProduct";
            
        } // end check btnok

        $this->load->view("layout/layout",$data);
    } // end searchProduct()

    // writen by HoangHH
    public function searchResult(){


        if ($this->input->post('btnok')){
            if ($this->input->post('show_all')){
                $_SESSION['show_all'] = $this->input->post('show_all');
            } else{
                if(isset($_SESSION['show_all'])) unset($_SESSION['show_all']);
                if ($this->input->post('per_page')){
                    $_SESSION['PerPageSearchProduct'] = $this->input->post('per_page');
                }
            } // end else show all
        } // end if btnok
        // echo $_SESSION['PerPageSearchProduct'];
        $_SESSION['PerPageSearchProduct']  = isset($_SESSION['PerPageSearchProduct']) ? $_SESSION['PerPageSearchProduct'] : 5;
        $_SESSION['show_all']  = isset($_SESSION['show_all']) ? $_SESSION['show_all'] : "no";

        $config['per_page'] = $_SESSION['PerPageSearchProduct'];
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

        $config['base_url']   = base_url("administrator/product/searchResult/");
        $config['total_rows'] = $this->product_model->count_all();
        if($config['per_page'] > $config['total_rows'] || $_SESSION['show_all'] == 'show'){
            $config['per_page'] = $config['total_rows'];
            $page = 1;
            // echo "page = 1";
        }

        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 4;
        $config['next_link'] = "Sau";
        $config['prev_link'] = "Trước";
        $this->pagination->initialize($config); 

        $start = ($page - 1) * $config['per_page'];

        $data['link'] = $this->pagination->create_links();
        $data['per'] = $config['per_page'];
        $data['show_all'] = $_SESSION['show_all'];
        $data['SearchResult'] = $this->product_model->getSearch($_SESSION['DataWhereCleanForSearchProduct'],$start,$config['per_page']);
        // $date['SearchResult']['bran_id'] = $this->bran_model->getOnce($data['SearchResult']['bran_id']);
        // echo $data['SearchResult']['bran_id'];
        // echo "<pre>";
        // print_r($data['SearchResult']);
        // $bran_name = $this->bran_model->getOnce($data['SearchResult']['bran_id']);
        $data['template'] = "product/SearchResult";
        $this->load->view("layout/layout",$data);
    } // end searchResult()
} // end class product
    

?>