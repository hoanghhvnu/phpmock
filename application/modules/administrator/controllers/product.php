
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
        $this->load->library("upload");
        $this->load->model("images_model");
        $this->load->model("cateproduct_model");
        $this->load->model("cate_model");
        $this->load->library("form_validation");

        session_start();
        if( ! isset($_SESSION['user'])){
            redirect(base_url("administrator/user/login"));
        }
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

        $data['template'] = "product/listproduct";
        $this->load->view("layout/layout",$data);

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
                'pro_quantity'=> $this->input->post('pro_quantity'),
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
        // config laij total_rows
        // $config['total_rows'] = $this->product_model->count_all();
        $totalSearch = $this->product_model->getSearchAll($_SESSION['DataWhereCleanForSearchProduct']);
        // echo count($totalSearch);
        $config['total_rows'] = count($totalSearch);
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
        // echo count($data['SearchResult']);
        // echo "<pre>";
        // print_r($data['SearchResult']);
        $data['ListBrand'] = $this->bran_model->getAll();
        $data['ListCountry'] = $this->country_model->getAll();

        $data['template'] = "product/SearchResult";
        $this->load->view("layout/layout",$data);
    } // end searchResult()

    // vietDq
     public function update()
     {
         $id = $this->uri->segment(4);
         $data['productInfo'] = $this->product_model->detailid($id);
         $rows = $this->cate_model->detail($id);
         //lay ra danh sach category

         $cateIdArr =  $this->cateproduct_model->getCate($id);
         $cateArr = array();
         if(isset($cateIdArr) && $cateIdArr != null) {
             foreach($cateIdArr as $valCate) {
                 $cateArr[] = $valCate['cate_id'];
             }
         }
         $data['listCateid'] = $cateArr;      
         //get bran   
         $data['bran'] =$this->bran_model->getAll();
         //get country
         $data['country'] =$this->country_model->getAll();    
         // lay ra category
         $data['listCategory'] = $this->getDataInsertCategory(0);
         // lay ra anh
         $data['listImages'] = $this->images_model->listImages($id);
         $listImages= $this->images_model->listImages($id);
         // lay so luong anh
         $numberImages = $this->images_model->countImages($id);
         // Thuc hien viec update
          if($this->input->post("ok")){
            $this->form_validation->set_rules("pro_name","Ten product ","trim|required");        
             $this->form_validation->set_rules("pro_price","Gia goc ","trim|required|numeric");
             $this->form_validation->set_rules("pro_price_sale","Gia ban ","trim|required|numeric");
             $this->form_validation->set_rules("pro_desc","Mo ta san pham ","trim|required");
             $this->form_validation->set_rules("pro_info","Thong tin ","trim|required");
             $this->form_validation->set_rules("pro_status","Trang thai ","trim|required|numeric");
             $this->form_validation->set_rules("bran_id","Ten nhan","trim|required|numeric");
             $this->form_validation->set_rules("country_id","Gia ban ","trim|required|numeric");
             $this->form_validation->set_rules("pro_quantity","So luong ","trim|required|numeric");
             $this->form_validation->set_message("required","%s khong duoc bo trong");
             $this->form_validation->set_message("numeric","%s phai la so");
             $this->form_validation->set_error_delimiters("<span class='error'>","</span>");
             if($this->form_validation->run()){

                 $updateName=$this->input->post("pro_name");
                 $listall=$this->product_model->getAll();
                 foreach ($listall as $row) {
                 if (in_array(trim($updateName),$row)&& ($row['pro_id']!=$id)) $data['errorName']="Da ton tai";

                 }   
                 if ($_FILES['file']['error']==0&&$numberImages>=10) $data['errorImages'] = "Da du 10 anh";
                 else
                 if (!isset($data['errorName'])) {
                      $cate=array();
                      $cate=$this->input->post("category");
                      $this->cateproduct_model->deleteCate($id);
                      foreach($cate as $key=>$val) {
                        echo $val;
                        $datacate= array( 
                            "cate_id"=>$val,
                            "pro_id"=>$id,
                            "catepro_order"=>'1'   
                        );
                         $this->cateproduct_model->insertCate($datacate);     
                     } // end foreach
                 $dataProduct = array(
                     "pro_name"=>$this->input->post("pro_name"),
                     "pro_price"=>$this->input->post("pro_price"),
                     "pro_price_sale"=>$this->input->post("pro_price_sale"),
                     "pro_desc"=>$this->input->post("pro_desc"),
                     "pro_info"=>$this->input->post("pro_info"),
                     "pro_status"=>$this->input->post("pro_status"),
                     "bran_id"=>$this->input->post("bran_id"),
                     "country_id"=>$this->input->post("country_id"),
                     "pro_quantity"=>$this->input->post("pro_quantity")     
                     );     
                 $this->product_model->update($dataProduct,$id);                
                 $filename=$_FILES['pro_images']['name'];
                 if ($_FILES['pro_images']['error']==0) {                    
                 
                 $proImages = array (
                                "pro_images"=>$filename,
       
                 );
                 $this->upImage('pro_images');
                 $this->product_model->update($proImages,$id);
                 }
                 foreach($listImages as $val) {
                 
                 $img="image".$val['img_id'];
                 if (($_FILES[$img]['error'])==0)
                     {  
                         echo $val['img_id'];
                 
                         $image1=$_FILES[$img];

                         $filename=$_FILES[$img]['name'];
                    
                         $imageInfo = array (
                                "img_name"=>$filename,
                                "pro_id"=>$id,
                                
                 
                 );
                         $this->upImage($img);
                         $this->images_model->update($imageInfo,$val['img_id']);
                     }
                    } // end foreach
                 if ($numberImages<10) {

                     $filename=$_FILES['file']['name'];
                     if ($_FILES['file']['error']==0) {
                     echo $filename;
                     $imageInfo = array (
                                    "img_name"=>$filename,
                                    "pro_id"=>$id,
                                    
                     
                     );
                     $this->upImage('file');

                     $this->images_model->insert($imageInfo);
                     } // end if
                 } // if number
            
              
                 redirect(base_url("administrator/product/listproduct"));
                 }
                  
                 }
          }
         
         $data['template'] = "product/update";
         $this->load->view("layout/layout",$data);
     }
     //writen by vietdq
      public function upImage($file) {
         $config['overwrite'] = TRUE;
         $config['allowed_types'] = 'jpg|jpeg|gif|png';
         $config['max_size'] = 2000;
         $config['upload_path'] = 'uploads/product/';
         $this->load->library('upload', $config);
         $this->upload->initialize($config);
         $this->upload->do_upload($file);
     }

    //writen by vietdq
         private function getDataInsertCategory($parent = 0,$gach = '-  ',$data = NULL)
     {
         if(!$data) $data = array();  
         $sql = $this->cate_model->detailparent($parent);
         foreach($sql as $key=>$value){
             $data[] = array(
                         'cate_id'    =>$value['cate_id'],
                         'cate_name'  =>$gach.$value['cate_name'],
                         'cate_parent'=>$value['cate_parent']
                         );
             $data = $this->getDataInsertCategory($value['cate_id'],$gach.'---   ',$data);
         }    
         return $data;
     }
     //writen by vietdq
         public function deleteImages($id) {
         $id = $this->uri->segment(4);
         $infoImg = $this->images_model->getImg($id);
    
         $namedel=$infoImg['img_name'];
         $file = "uploads/product/".$namedel;
         $this->images_model->deleteImg($id); 
         

        
        if (!unlink($file))
             {
                // echo ("Error deleting $file");
             }
         else
             {
                 //echo ("Deleted $file");
             }


         
     }


    // end vietdq




} // end class product
    

?>