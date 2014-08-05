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
		$configInfo = $this->config_model->getAllPerpage ();
		if (isset ( $configInfo ) && ! empty($configInfo)) {
			$data ['PerpageDefault'] = $configInfo['perpage_default'];
			$data ['PerpageAdmin'] = $configInfo['perpage_admin'];
			// print_r($data);
		}
		
		if ($this->input->post ( "ok" )) {
			$this->form_validation->set_rules ( "PerpageDefault", "Perpage in Default", "trim|required|is_natural" );
			$this->form_validation->set_rules ( "PerpageAdmin", "Perpage in Admin", "trim|required|is_natural" );
			
			$this->form_validation->set_message ( "required", "%s không được bỏ trống" );
			$this->form_validation->set_message ( "is_natural", "%s phải là số tự nhiên" );
			$this->form_validation->set_error_delimiters ( "<span class='error'>", "</span>" );

			if ($this->form_validation->run ()) {
				$DataUpdate = array(
					'perpage_default' => $this->input->post('PerpageDefault'),
					'perpage_admin' => $this->input->post('PerpageAdmin')
					);
				$data ['PerpageDefault'] = $this->input->post('PerpageDefault');
				$data ['PerpageAdmin'] = $this->input->post('PerpageAdmin');
				$this->config_model->update ($DataUpdate);
			}
		} // end if isset submit

		$data ['template'] = "config/update";
		$this->load->view ( "layout/layout", $data );
	}
}