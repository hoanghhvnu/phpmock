<?php
class checkout extends DefaultBaseController {
	public function __construct() {
		parent::__construct ();
		
		$this->load->model ( 'checkout_model' );
		$this->load->library ( 'cart' );
		$this->load->helper ( 'form' );
		$this->load->library ( "form_validation" );
		$this->load->helper ( "url" );
		$this->load->model("cate_model");
		$this->load->model("cateproduct_model");
	}
	public function index() {
		if ($this->input->post ( 'btnok' )) {
			$this->form_validation->set_rules ( "name", "Tên ", "trim|required" );
			$this->form_validation->set_rules ( "email", "Email", "trim|required|valid_email" );
			$this->form_validation->set_rules ( "address", "Địa chỉ ", "trim|required" );
			$this->form_validation->set_rules ( "phone", "Số điện thoại", "trim|required|numeric" );
			$this->form_validation->set_rules ( "gender", "Giới tính", "trim|required" );
			$this->form_validation->set_message ( "required", "%s không được bỏ trống" );
			
			$this->form_validation->set_message ( "required", "%s không được bỏ trống" );
			$this->form_validation->set_message ( "valid_email", "%s không đúng định dạng" );
			$this->form_validation->set_message ( "numeric", "%s phải là số" );
			$this->form_validation->set_error_delimiters ( "<span class='error'>", "</span>" );
			if ($this->form_validation->run () && $this->cart->contents ()) {
				
				$order = array (
						'cus_name' => $this->input->post ( 'name' ),
						'cus_gender'=> $this->input->post ( 'gender' ),
						'cus_email' => $this->input->post ( 'email' ),
						'cus_address' => $this->input->post ( 'address' ),
						'cus_phone' => $this->input->post ( 'phone' ),
						'order_date' => date ( 'Y-m-d-h-m-s' ) 
				);
				
				$ord_id = $this->checkout_model->insert_order ( $order );
				
				if ($cart = $this->cart->contents ()) {
					// echo "<pre>";
					// print_r($cart);
					foreach ( $cart as $item ) {
						$order_detail = array (
								
								'pro_name' => $item ['name'],
								'pro_price' => $item ['price'],
								'pro_id' => $item['id'],
								'pro_quantity' => $item ['qty'],
								'order_id' => $ord_id 
						);
						
						$this->checkout_model->insert_order_detail ( $order_detail );
					}
				}
				
				
				$this->cart->destroy ();
				$this->load->view("cart/successful",$data=array());
			}
		}
		$data = array ();

		$data ['title'] = 'checkout';
		

		//Huandt 1h56 8/01
		$SortedList = $this->getCategory();
		$data['html'] = $this->createMenu($SortedList);
		//Huandt 1h56 8/01

		$data ['template'] = "cart/checkout";
		$this->loadView("layout/layout",$data);
	}
	
	// 8/01/2014 1h50pm HuanDT
	public function createMenu($listArr=array(),$parent = 0, $level=0)
	{
		$html = '';
		if($listArr=='') return '';
		$html .= ($level==0 ? "<div id='menu'>" : "");
		$have_child = false;
		foreach($listArr as $value)
		{
			if($value['cate_parent']==$parent)
			{
				$have_child = true;
				break;
			}
		}
		if($have_child) $html .= "<ul>";
		foreach($listArr as $key=>$value)
		{
			if($value['cate_parent']==$parent)
			{
				$html .= "<li><a href='#'>".$value['cate_name']."(".$this->cateproduct_model->countProduct($value['cate_id']).")"."</a>";
				unset($listArr[$key]);
				$html .= $this->createMenu($listArr,$value['cate_id'],$level+1);
				$html .= "</li>";
			}
		}
		if($have_child) $html .= "</ul>";
		$html .= $level==0 ? "</div>" : "";
		return $html;
	}
	
	private function getCategory($LevelSign = "") {
		$SequenceList = $this->cate_model->getAll ();
		if (empty ( $SequenceList )) {
			echo "Have no category!";
		} else {
			// get Category level 0, ParentId = 0;
			$strLevel = "";
			$SortedList = $this->recursive ( 0, $SequenceList, $strLevel );
			return $SortedList;
		} // end if empty
	} // end getCategory
	
	private function recursive($ParentId, &$List, $strLevel) {
		if (! empty ( $List )) {
			if ($ParentId != 0) {
				$strLevel .= "";
			} else {
				// $strLevel = "";
			}
	
			$LevelList = array ();
	
			foreach ( $List as $key => $CateDetail ) {
				if ($ParentId == $CateDetail ['cate_parent']) {
					$temp = array (
							'cate_id' => $CateDetail ['cate_id'],
							'cate_name' => $strLevel . $CateDetail ['cate_name'],
							'cate_parent' => $CateDetail ['cate_parent'],
							'cate_order' => $CateDetail ['cate_order']
					);
					$LevelList [$key] = $temp;
					// $LevelList[$key] = $CateDetail;
					unset ( $List [$key] );
				} // end if ParentId
			} // end foreach $List
	
			if (! empty ( $LevelList )) {
				$LevelSortByOrder = array ();
				foreach ( $LevelList as $key => $LevelCateDetail ) {
					$LevelKeyOrder [$key] = $LevelCateDetail ['cate_order'];
				}
	
				asort ( $LevelKeyOrder );
	
				$LevelSorted = array ();
				foreach ( $LevelKeyOrder as $key => $CateOrder ) {
					$LevelSorted [$key] = $LevelList [$key];
				}
	
				$LevelAndSub = array ();
				foreach ( $LevelSorted as $key => $LevelCateDetail ) {
					$LevelAndSub [] = $LevelCateDetail;
					$SubLevel = $this->recursive ( $LevelCateDetail ['cate_id'], $List, $strLevel );
					if (! empty ( $SubLevel )) {
						foreach ( $SubLevel as $key => $SubLevelCateDetail ) {
							$LevelAndSub [] = $SubLevelCateDetail;
						}
					} // end if SubLevel
				} // end foreach LevelSorted
				return $LevelAndSub;
			} // end if empty $Level
		} // end if ! empty()
	} // end recursive()
	// 8/01/2014 1h50pm HuanDT

}