<?php
class pro extends basecontroller{
	public function __construct(){
		parent::__construct();
		// echo __CLASS__;
	}
	public function index(){
		$this->load->view("layout/header");
	}

}