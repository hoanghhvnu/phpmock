<?php
class checkout extends DefaultBaseController {
	public function __construct() {
		parent::__construct ();
		
		$this->load->model ( 'checkout_model' );
		$this->load->library ( 'cart' );
		$this->load->helper ( 'form' );
		$this->load->library ( "form_validation" );
		$this->load->helper ( "url" );
		$this->load->model("cate_model");
		$this->load->model("cateproduct_model");
	}
	public function index() {
		if ($this->input->post ( 'btnok' )) {
			$this->form_validation->set_rules ( "name", "Tên ", "trim|required" );
			$this->form_validation->set_rules ( "email", "Email", "trim|required|valid_email" );
			$this->form_validation->set_rules ( "address", "Địa chỉ ", "trim|required" );
			$this->form_validation->set_rules ( "phone", "Số điện thoại", "trim|required|numeric" );
			$this->form_validation->set_rules ( "gender", "Giới tính", "trim|required" );
			$this->form_validation->set_message ( "required", "%s không được bỏ trống" );
			
			$this->form_validation->set_message ( "required", "%s không được bỏ trống" );
			$this->form_validation->set_message ( "valid_email", "%s không đúng định dạng" );
			$this->form_validation->set_message ( "numeric", "%s phải là số" );
			$this->form_validation->set_error_delimiters ( "<span class='error'>", "</span>" );
			if ($this->form_validation->run () && $this->cart->contents ()) {
				
				$order = array (
						'cus_name' => $this->input->post ( 'name' ),
						'cus_gender'=> $this->input->post ( 'gender' ),
						'cus_email' => $this->input->post ( 'email' ),
						'cus_address' => $this->input->post ( 'address' ),
						'cus_phone' => $this->input->post ( 'phone' ),
						'order_date' => date ( 'Y-m-d-h-m-s' ) 
				);
				
				$ord_id = $this->checkout_model->insert_order ( $order );
				
				if ($cart = $this->cart->contents ()) {
					// echo "<pre>";
					// print_r($cart);
					foreach ( $cart as $item ) {
						$order_detail = array (
								
								'pro_name' => $item ['name'],
								'pro_price' => $item ['price'],
								'pro_id' => $item['id'],
								'pro_quantity' => $item ['qty'],
								'order_id' => $ord_id 
						);
						
						$this->checkout_model->insert_order_detail ( $order_detail );
					}
				}
				
				
				$this->cart->destroy ();
				$this->load->view("cart/successful",$data=array());
			}
		}
		$data = array ();

		$data ['title'] = 'checkout';
		

		//Huandt 1h56 8/01
		$SortedList = $this->getCategory();
		$data['html'] = $this->createMenu($SortedList);
		//Huandt 1h56 8/01

		$data ['template'] = "cart/checkout";
		$this->loadView("layout/layout",$data);
	}

}