<?php
/**
 * All admin controller have to extends this controller
 */
session_start();
class AdminBaseController extends CI_controller{
	public function __construct(){
		parent::__construct();
		/**
		 * Check if user not have login
		 */
		
		if( ! isset($_SESSION['user'])){
		    redirect(base_url("administrator/user/login"));
		} // end if
	} // end __construct
} // end class AdminBaseController