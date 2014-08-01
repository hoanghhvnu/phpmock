<?php
class cart extends CI_Controller {
	public function __construct() {
		parent::__construct ();

		$this->load->library ( 'cart' );
		$this->load->helper ( 'form' );
		$this->load->helper ( "url" );
		$this->load->model("cate_model");
		$this->load->model("cateproduct_model");
	}
	public function index() {
		$data = array ();
		$data ['title'] = 'Shopping carts';
		//Huandt 1h56 8/01
		$SortedList = $this->getCategory();
		$data['html'] = $this->createMenu($SortedList);
		//Huandt 1h56 8/01
		if (! $this->cart->contents ()) {
			$data ['message'] = '<p>Chưa có sản phẩm nào trong giỏ hàng !</p>';
		} else {
			$data ['message'] = "";
		}
		
		// ///////////////////////////////////
		$grand_total = 0;
		foreach ( $this->cart->contents () as $value ) {
			$grand_total = $grand_total + $value ['subtotal'];
		}
		
		$data ['total'] = $this->cart->total_items ();
		$data ['money'] = $grand_total;
		// tong so san pham da mua
		$data ['template'] = "cart/cart";
		$this->load->view ( 'layout/layout', $data );
		// lay ra tong cong cac item
		$totalitem = 0;
		foreach ( $this->cart->contents () as $value ) {
			$totalitem = $totalitem + $value ['qty'];
		}
		
		// ///////////////////////////////////////////////
	}
	public function add() {
		$check = 1;
		
		foreach ( $this->cart->contents () as $value ) {
			if ($value ['id'] == $this->input->post ( 'id' )) {
				$qty = $value ['qty'] + 1;
				$itemInfo = array (
						'id' => $this->input->post ( 'id' ),
						'name' => $this->input->post ( 'name' ),
						'price' => $this->input->post ( 'price' ),
						'qty' => $qty 
				);
				$check = 2;
			}
		}
		if ($check == 1)
			$itemInfo = array (
					'id' => $this->input->post ( 'id' ),
					'name' => $this->input->post ( 'name' ),
					'price' => $this->input->post ( 'price' ),
					'qty' => 1 
			);
		
		$this->cart->insert ( $itemInfo );
		
		redirect ( base_url ('default/cart') );
	}
	function remove($rowid) {
		if ($rowid == "all") {
			$this->cart->destroy ();
		} else {
			$data = array (
					'rowid' => $rowid,
					'qty' => 0 
			);
			
			$this->cart->update ( $data );
		}
		
		redirect ( base_url ('default/cart') );
	}
	function update_cart() {
		foreach ( $_POST ['cart'] as $id => $cart ) {
			$price = $cart ['price'];
			$amount = $price * $cart ['qty'];			
			$data = array (
					'rowid' => $cart ['rowid'],
					'qty' => $cart ['qty'],
					'price' => $price,
					'amount' => $amount
			);
			$this->cart->update ( $data );
			
		}
		
		redirect ( base_url ('default/cart') );
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