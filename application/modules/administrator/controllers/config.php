<?php
class config extends AdminBaseController {
	function __construct() {
		parent::__construct ();
		$this->load->helper ( "url" );
		$this->load->library ( "form_validation" );
		$this->load->model ( "config_model" );
		
		// session_start ();
		
	} // end __construct
	public function index() {
		$configInfo = $this->config_model->getPerpage ();
		if (isset ( $configInfo )) {
			$data ['perpage'] = $configInfo;
		}
		
		if ($this->input->post ( "ok" )) {
			$this->form_validation->set_rules ( "perpage", "Số sản phẩm mỗi trang", "trim|required|is_natural" );
			
			$this->form_validation->set_message ( "required", "%s không được bỏ trống" );
			$this->form_validation->set_message ( "is_natural", "%s phải là số tự nhiên" );
			$this->form_validation->set_error_delimiters ( "<span class='error'>", "</span>" );

			if ($this->form_validation->run ()) {
				$data['perpage'] = $this->input->post ( "perpage" );
				$this->config_model->update ( array ("perpage" => $data['perpage']) );
			}
		} // end if isset submit

		$data ['template'] = "config/update";
		$this->load->view ( "layout/layout", $data );
	}
}