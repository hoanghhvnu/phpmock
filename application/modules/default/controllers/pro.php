<?php
class pro extends base_Controller{
	public function __construct(){
		parent::__construct();
		echo __CLASS__;
	}
	public function index(){
		// $this->load->view("layout/test");
	}

}