<?php
class cart extends DefaultBaseController {
	public function __construct() {
		parent::__construct ();
		
		$this->load->library ( 'cart' );
		$this->load->helper ( 'form' );
		$this->load->helper ( "url" );
		$this->load->model ( "cate_model" );
		$this->load->model ( "cateproduct_model" );
	}
	public function index() {
		$data = array ();
		$data ['title'] = 'Shopping carts';
		// Huandt 1h56 8/01
		$SortedList = $this->getCategory ();
		//$data ['html'] = $this->createMenu ( $SortedList );
		// Huandt 1h56 8/01
		if (! $this->cart->contents ()) {
			$data ['message'] = '<p>Chưa có sản phẩm nào trong giỏ hàng !</p>';
		} else {
			$data ['message'] = "";
		}
		
		$data ['template'] = "cart/cart";
		$this->loadView ( "layout/layout", $data );
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
		
		redirect ( base_url ( 'default/cart' ) );
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
		
		redirect ( base_url ( 'default/cart' ) );
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
		
		redirect ( base_url ( 'default/cart' ) );
	}
}