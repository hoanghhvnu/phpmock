<?php
/**
 * all controller in default modules extends from this class
 */
class generalcontroller extends CI_Controller{
	public function __construct(){
		parent::__construct();
		echo __CLASS__;
		$this->load->view("layout/header");
	}

	public function index(){
		$this->load->view("layout/test");
	}

	 // end __contruc
} // end class default