<?php
/**
 * All default controller have to extends this controller
 */
session_start ();
class DefaultBaseController extends MX_controller {
	public function __construct() {
		parent::__construct ();
	} // end __construct
	public function loadView($url, $data = array()) {
		$this->load->library ( 'cart' );
		$grand_total = 0;
		foreach ( $this->cart->contents () as $value ) {
			$grand_total = $grand_total + $value ['subtotal'];
		}
		$data ['total'] = $this->cart->total_items ();
		$data ['money'] = $grand_total;
		$this->load->view ( $url, $data );
	}
} // end class AdminBaseControllerSltZZz