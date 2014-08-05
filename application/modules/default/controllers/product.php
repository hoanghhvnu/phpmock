<?php
class product extends DefaultBaseController {
	public function __construct() {
		parent::__construct ();
		$this->load->helper("form");
		$this->load->model("cate_model");
		$this->load->model("images_model");
		$this->load->model("bran_model");
		$this->load->model("country_model");
		$this->load->model("cateproduct_model");
		$this->load->model("comment_model");
		$this->load->model ( 'product_model' );
		$this->load->model ( 'config_model' );
		$this->load->helper ( 'form' );
		$this->load->library ( 'pagination' );
		$this->load->library ( 'cart' );
		$this->load->helper ( "url" );
		$this->load->model("menu_model");
	}
	public function listproduct() {
        $SortedList = $this->getCategory();
		$data = array ();
		$configInfo = $this->config_model->getPerpage ();
		if (isset ( $configInfo )) {
			$perpage = $configInfo;
		}
		
		if (! $this->cart->contents ()) {
			$data ['message'] = '<p>Your cart is empty!</p>';
		} else {
			$data ['message'] = $this->session->flashdata ( 'message' );
		}
		
		// $data ['products'] = $this->product_model->listProduct ();
		$config ['base_url'] = base_url ( 'default/product/listproduct' ); // xÃ¡c Ä‘á»‹nh trang phÃ¢n trang
		
		$config ['per_page'] = $perpage;
		$config ['use_page_numbers'] = TRUE;
		$config ['uri_segment'] = 4;
		$config ['next_link'] = "Next";
		$config ['prev_link'] = "Previous";
		/////////////////phan trang co css///
		$config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = 'TrÆ°á»›c';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Sau';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="current"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['first_link'] = 'Ä�áº§u';
		$config['last_link'] = 'Cuá»‘i';
		///////////////////////
		$page = ($this->uri->segment ( 4 )) ? $this->uri->segment ( 4 ) : 1;
		
		$start = ($page - 1) * $config ['per_page'];
		
		$this->pagination->initialize ( $config );
		// $data ['products'] = $this->product_model->list_all ( $config ['per_page'], $start );
		$SortField = 'pro_name';
		$SortType = 'asc';
		$data ['products'] = $this->product_model->list_all ( $config ['per_page'], $start,  $SortType, $SortField);
        $config ['total_rows'] = count($data['products']); // xÃ¡c Ä‘á»‹nh tá»•ng sá»‘ record
        if ($config ['per_page'] > $config ['total_rows']) {
            $config ['per_page'] = $config ['total_rows'];
            $page = 1;
        }
		/////////////////////////////////////



		$data ['total_page'] = ceil($config['total_rows'] / $config['per_page']);
		// tong so san pham da mua
		$data['CurrentPage'] = $page;
		$data ['template'] = "product/listproduct";
		$this->loadView("layout/layout",$data);
        // return $this->load->view("product/listproduct",$data,true);
	}

	/**
	 * HoanHH
	 */
	public function receiveAjax(){
		if(isset($_POST['SortField'])){
			$SortField = $_POST['SortField'];
		}else{
			$SortField = 'pro_name';
		}

		if(isset($_POST['SortType'])){
			$SortType = $_POST['SortType'];
		}else{
			$SortType = 'asc';
		}

		if(isset($_POST['Page'])){
			$page = $_POST['Page'];
		}else{
			$page = '1';
		}

		
		
        $ConfigPerpage = $this->config_model->getPerpage();
        // echo $ConfigPerpage;
        if ( ! isset($ConfigPerpage)){
            $config['per_page'] = 5;
        } else{
            $config['per_page'] = $ConfigPerpage;
        }
		$start = ($page - 1) * $config['per_page'];
		// echo $SortType . $SortField;
		$NewProduct = $this->product_model->list_all ($config ['per_page'],$start , $SortType, $SortField);
		// echo $page;
		// echo json_encode($NewProduct);
		// $data['products'] = $NewProduct;
		// 
		$config ['total_rows'] = $this->product_model->count_all (); // xÃ¡c Ä‘á»‹nh tá»•ng sá»‘ record
		$data ['total_page'] = ceil($config['total_rows'] / $config['per_page']);
        $data['CurrentPage'] = $page;
		$data['products'] = $NewProduct;
		$newView = $this->load->view ( 'product/product',$data, true);
		echo $newView;
	 
	}

	/**
	 * HuanDT
	 */
	
	public function detailproduct(){
    	$SortedList = $this->getCategory();
    	$id = $this->uri->segment(4);
    	//$getImageById = array();
    	$getProductById = $this->getProductById($id);
    	$branId = $getProductById['bran_id'];
    	$counId = $getProductById['country_id'];
    	$getImageById = $this->getImgName($id);
    	$getImageAllById = $this->getImageByProId($id);
    	$getImageThumbs = $this->getImgThumbs($id);
    	$comment = $this->getCommentByProId($id);
//     	echo "<pre>";
//     	print_r($comment);
//     	die();
    	$data = array();
    	$mega = array();
    	//$value = array();
    	if(!empty ($SortedList)){
    		$data['orderList'] = $SortedList;
    		foreach ($SortedList as $value){
    			$dt = array(
    					"cate_id" => $value['cate_id'],
    					"cate_name" => $value['cate_name'],
    					"cate_parent" => $value['cate_parent'],
    					"cate_order" => $value['cate_order']
    			);
    			$meta[] = $dt;
    		}
//     		echo "<pre>";
//     		print_r($meta);die();
    		$data['info'] = $SortedList;
    		$data['image'] = $getImageById['pro_images'];
			$data['images'] = $getImageAllById;
// 			echo "<pre>";print_r($data['images']);die();
    		$data['thumbs'] = $getImageThumbs;
    		
    		
// 			echo "<pre>";
// 			print_r($meta);die();
    		
    		$data['product'] = $getProductById;
    		$data['comment'] = $comment;
    		//echo "<pre>"; print_r($data['comment']);die();
    		$data['bran'] = $this->getBranById($branId);
    		$data['country'] = $this->getCountryById($counId);
    		$data['template'] = "product/detailproduct";
    		$this->loadView("layout/layout",$data);
    	}
    }

    public function getCommentByProId($id){
    	return $this->comment_model->getAll($id);
    }
    public function getBranById($branId){
    	return $this->bran_model->getOnce($branId);
    }
    public function getProductById($id){
    	return $this->product_model->detailid($id);
    }
    public function getImageByProId($id){
    	return $this->images_model->getAllById($id);
    }
    public function getImgName($id){
    	return $this->product_model->detailid($id);
    	
    }
    
    public function getCountryById($id){
    	return $this->country_model->getOnce($id);
    }
    public function getImgThumbs($id){
    	return $this->images_model->detailByProId($id);
    }


} // end class product