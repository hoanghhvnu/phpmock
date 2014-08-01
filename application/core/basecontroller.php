<?php
/**
 * all controller in default modules extends from this class
 */
class basecontroller extends CI_Controller{
	public function __construct(){
		parent::__construct();
		// echo __CLASS__;
		// $this->load->database();
		// $this->load->model("DefaultBaseModel");
		// $data = $this->DefaultBaseModel->getProductDetail(18);
		// echo $data;
		// $this->load->view("layout/header");
	}

	// public function index(){
	// 	$this->load->view("layout/test");
	// }

	 // end __contruc
} // end class default