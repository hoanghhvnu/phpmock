<?php
class home extends DefaultBaseController
{
    public function  __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("product_model");
        $this->load->library("cart");
        $this->load->model("config_model");
        $this->load->helper("form");
    }
    public function index(){
        include("product.php");
       $rawOrder = $this->product_model->getSlider();
       if(! isset($rawOrder) || empty($rawOrder)){
          /**
           * load view has no slider
           */
          $this->load->view("layout/header");
          $this->load->view("layout/megamenu");
          
       } else{
          /**
           * load view has slider
           * @var array
           */
          $KeyOrder = array();

          foreach ($rawOrder as $key => $value) {
            $KeyOrder[$key] = $value['slide_order'];
          }

          if(isset($KeyOrder) && ! empty($KeyOrder)){
             asort($KeyOrder);

             foreach ($KeyOrder as $key => $value) {
               $Ordered[] = $rawOrder[$key];
             } // end foreach

             $data['slider'] = $Ordered;
             $this->load->view("layout/header",$data);
          } // end if isset $KeyOrder
       } // end if isset

       // $pr = new product();
       $this->load->view("layout/left_content");
       // echo $pr->listproduct();
       // $this->load->view('product/listproduct');
       /**
        * load product
        */
       $configInfo = $this->config_model->getPerpage ();
       if (isset ( $configInfo )) {
        $perpage = $configInfo;
       }
       if (! $this->cart->contents ()) {
        $data ['message'] = '<p>Your cart is empty!</p>';
       } else {
        $data ['message'] = $this->session->flashdata ( 'message' );
       }
       $data ['products'] = $this->product_model->listProduct ();
       $config ['total_rows'] = count($data['products']); // xÃ¡c Ä‘á»‹nh tá»•ng sá»‘ record
       $config ['per_page'] = $perpage;
       $page = 1;
       $start = ($page - 1) * $config ['per_page'];
       $SortField = 'pro_name';
       $SortType = 'asc';
       $data ['products'] = $this->product_model->list_all ( $config ['per_page'], $start,  $SortType, $SortField);
       $data ['total_page'] = ceil($config['total_rows'] / $config['per_page']);
       // tong so san pham da mua
       $data['CurrentPage'] = $page;
       $this->loadView("product/listproduct",$data);
       $this->loadView("layout/right_content",$data);
       $this->load->view("layout/footer");
    } // end index()
    public function detail()
    {
        $idProduct = $this->uri->segment(4);
        $data['infoProduct'] = $this->product_model->detailProduct($idProduct);
        $data['template'] = "product/detail";
        $this->load->view("home/layout",$data);
    }
    public function count()
    {
        echo $this->product_model->countTable();
    }
    public function insert()
    {
        $dataInsert = array(
                            'pro_name'=>'Sony Experia Z2 00000',
                            'pro_price'=>1500,
                            'pro_price_sale'=>1000,
                            'pro_desc'=>'Sony Experia Z2 00000',
                            'pro_info'=>'Sony Experia Z2 00000Sony Experia Z2 00000Sony Experia Z2 00000'
                      );
        $this->product_model->insertProduct($dataInsert);
    }
    public function update()
    {
        $dataUpdate = array(
            'pro_name'=>'Sony Experia Z1 (update)',
            'pro_price'=>1500,
            'pro_price_sale'=>1000,
            'pro_desc'=>'Sony Experia Z1 update',
            'pro_info'=>'Sony Experia Z1 update'
                      );
        $this->product_model->updateProduct($dataUpdate,$id=7);
    }
    public function delete()
    {
        $this->product_model->deleteProduct($id=7);
    }
    public function createLibrary()
    {
        $data = array("username","email","address");
        $this->load->library("test");
        $this->test->debug($data);
    }
    
    
    
    
    
}
