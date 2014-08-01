<?php
class checkout extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
		$this->load->model ( 'checkout_model' );
		$this->load->library ( 'cart' );
		$this->load->helper ( 'form' );
		$this->load->library ( "form_validation" );
		$this->load->helper ( "url" );
	}
	public function index() {
		if ($this->input->post ( 'btnok' )) {
			$this->form_validation->set_rules ( "name", "Tên ", "trim|required" );
			$this->form_validation->set_rules ( "email", "Email", "trim|required|valid_email" );
			$this->form_validation->set_rules ( "address", "Địa chỉ ", "trim|required" );
			$this->form_validation->set_rules ( "phone", "Số điện thoại", "trim|required|numeric" );
			$this->form_validation->set_message ( "required", "%s không được bỏ trống" );
			
			$this->form_validation->set_message ( "required", "%s không được bỏ trống" );
			$this->form_validation->set_message ( "valid_email", "%s không đúng định dạng" );
			$this->form_validation->set_message ( "numeric", "%s phải là số" );
			$this->form_validation->set_error_delimiters ( "<span class='error'>", "</span>" );
			if ($this->form_validation->run () && $this->cart->contents ()) {
				
				$order = array (
						'cus_name' => $this->input->post ( 'name' ),
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
				
				echo "Cảm ơn bạn ! Đơn hàng đã được chấp nhận !<br />";
				$this->cart->destroy ();
				echo "<a href=" . base_url () . "default/product/listproduct>Trờ lại</a>";
				redirect ( base_url ( "default/product/listproduct" ) );
			}
		}
		$data = array ();
		$grand_total = 0;
		
		if ($cart = $this->cart->contents ()) {
			foreach ( $cart as $item ) {
				$grand_total = $grand_total + $item ['subtotal'];
			}
		}
		$data ['grand_total'] = $grand_total;
		$data ['title'] = 'checkout';
		
		// ///////////////////////////////////
		$grand_total = 0;
		foreach ( $this->cart->contents () as $value ) {
			$grand_total = $grand_total + $value ['subtotal'];
		}
		
		$data ['total'] = $this->cart->total_items ();
		$data ['money'] = $grand_total;
		// tong so san pham da mua
		$data ['template'] = "cart/checkout";
		$this->load->view ( 'layout/layout', $data );
	}

}