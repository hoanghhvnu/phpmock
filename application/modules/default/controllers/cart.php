<?php
class cart extends CI_Controller {
	public function __construct() {
		parent::__construct ();

		$this->load->library ( 'cart' );
		$this->load->helper ( 'form' );
		$this->load->helper ( "url" );
	}
	public function index() {
		$data = array ();
		$data ['title'] = 'Shopping carts';
		
		if (! $this->cart->contents ()) {
			$data ['message'] = '<p>Chưa có sản phẩm nào trong giỏ hàng !</p>';
		} else {
			$data ['message'] = $this->session->flashdata ( 'message' );
		}
		
		// ///////////////////////////////////
		$grand_total = 0;
		foreach ( $this->cart->contents () as $value ) {
			$grand_total = $grand_total + $value ['subtotal'];
		}
		
		$data ['total'] = $this->cart->total_items ();
		$data ['money'] = $grand_total;
		// tong so san pham da mua
		$data ['template'] = "cart/cart";
		$this->load->view ( 'layout/layout', $data );
		// lay ra tong cong cac item
		$totalitem = 0;
		foreach ( $this->cart->contents () as $value ) {
			$totalitem = $totalitem + $value ['qty'];
		}
		
		// ///////////////////////////////////////////////
	}
	public function add() {
		$check = 1;
		
		foreach ( $this->cart->contents () as $value ) {
			if ($value ['id'] == $this->input->post ( 'id' )) {
				$qty = $value ['qty'] + 1;
				$itemInfo = array (
						'id' => $this->input->post ( 'id' ),
						'name' => $this->input->post ( 'name' ),
						'price' => $this->input->post ( 'price' ),
						'qty' => $qty 
				);
				$check = 2;
			}
		}
		if ($check == 1)
			$itemInfo = array (
					'id' => $this->input->post ( 'id' ),
					'name' => $this->input->post ( 'name' ),
					'price' => $this->input->post ( 'price' ),
					'qty' => 1 
			);
		
		$this->cart->insert ( $itemInfo );
		
		redirect ( base_url ('default/cart') );
	}
	function remove($rowid) {
		if ($rowid == "all") {
			$this->cart->destroy ();
		} else {
			$data = array (
					'rowid' => $rowid,
					'qty' => 0 
			);
			
			$this->cart->update ( $data );
		}
		
		redirect ( base_url ('default/cart') );
	}
	function update_cart() {
		foreach ( $_POST ['cart'] as $id => $cart ) {
			$price = $cart ['price'];
			$amount = $price * $cart ['qty'];			
			$data = array (
					'rowid' => $cart ['rowid'],
					'qty' => $cart ['qty'],
					'price' => $price,
					'amount' => $amount
			);
			$this->cart->update ( $data );
			
		}
		
		redirect ( base_url ('default/cart') );
	}
}