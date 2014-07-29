
<?php
/**
 * Class slider

 */
class slider extends CI_Controller{
 	public function __construct(){
 		parent::__construct();
 	}

 	public function index(){
 		// echo __METHOD__;
 		$data['template'] = "slider";
 		$this->load->view("layout/layout",$data);
 	}
 }
