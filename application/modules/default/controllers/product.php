<?php
class product extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'product_model' );
		// $this->load->model ( 'config_model' );
		$this->load->helper ( 'form' );
		$this->load->library ( 'pagination' );
		// $this->load->model ( 'cart_model' );
		$this->load->library ( 'cart' );
		session_start();
	}
	public function listproduct() {
		// echo $this->input->post("SortField");
		// echo $this->input->post("SortType");
		$SortField = 'pro_name';
		$SortType = 'asc';
		if($this->input->post("btnok")){
			$_SESSION['SortType'] = $this->input->post("SortType");
			$_SESSION['SortField'] = $this->input->post("SortField");
		}
		

		if(isset($_SESSION['SortField']) && $_SESSION['SortField'] != ""){
			$SortField = $_SESSION['SortField'];
			// echo "ton tai sortfield";
			// var_dump($_SESSION['SortField']);

		}

		if(isset($_SESSION['SortType']) && $_SESSION['SortType'] != ""){
			$SortType = $_SESSION['SortType'];
		}

		// echo "field" . $SortField;
		// echo $SortType;
		$data = array ();
		// $configInfo = $this->config_model->getPerpage ();
		// $configInfo = array();
		// iff (isset ( $configInfo )) {
		// 	$perpage = $configInfo ['perpage'];
		// }
		$perpage = 5;

		if (! $this->cart->contents ()) {
			$data ['message'] = '<p>Your cart is empty!</p>';
		} else {
			$data ['message'] = $this->session->flashdata ( 'message' );
		}
		
		// $data ['products'] = $this->product_model->listProduct ();

		$config ['base_url'] = base_url ( 'default/product/listproduct' ); // xác định trang phân trang
		$config ['total_rows'] = $this->product_model->count_all (); // xác định tổng số record
		$config ['per_page'] = $perpage;
		$config ['use_page_numbers'] = TRUE;
		$config ['uri_segment'] = 4;
		$config ['next_link'] = "Next";
		$config ['prev_link'] = "Previous";
		
		$page = ($this->uri->segment ( 4 )) ? $this->uri->segment ( 4 ) : 1;
		if ($config ['per_page'] > $config ['total_rows']) {
			$config ['per_page'] = $config ['total_rows'];
			$page = 1;
		}
		$start = ($page - 1) * $config ['per_page'];
		
		$this->pagination->initialize ( $config );
		$data ['products'] = $this->product_model->list_all ( $config ['per_page'], $start , $SortType, $SortField);
		/////////////////////////////////////
		$grand_total = 0;
		foreach ( $this->cart->contents () as $value ) {
			$grand_total = $grand_total + $value ['subtotal'];
		}
		
		$data ['total'] = $this->cart->total_items ();
		$data ['money'] = $grand_total;
		// tong so san pham da mua
		
		$data ['template'] = "product/product";
		$this->load->view ( 'layout/layout', $data );
	}
}