<?php
/**
 * All admin controller have to extends this controller
 */
session_start();
class AdminBaseController extends MX_controller{
	public function __construct(){
		parent::__construct();
		/**
		 * Check if user not have login
		 */
		$action = $this->uri->segment(3);
		if( ! isset($_SESSION['user']) && $action != "login"){
		    redirect(base_url("administrator/user/login"));
		} // end if
		$this->load->model("default/comment_model");
		$cut = $this->comment_model->getAll(2);
		echo "<pre>";
		print_r($cut);
	} // end __construct
} // end class AdminBaseControllerSltZZz