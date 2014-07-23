<?php
class cate extends CI_Controller{
    protected $_OrderedCategory;
    function __construct(){
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("form_validation");
        $this->load->model("cate_model");
        session_start();

    } // end __construct

    public function index(){
        $this->listcate();

    } // end index()

    // List Category
    // Writen by HoangHH
    public function listcate(){
            $rawList = $this->cate_model->getAll();
            $orderList = array();

            $_SESSION['listedByID'] = array();

            foreach ($rawList as $key => $cateDetail) {
                // echo "<div id = 'center'>";
                // echo $key;
                $cate_id     = $cateDetail['cate_id'];
                $cate_name   = $cateDetail['cate_name'];
                $cate_parent = $cateDetail['cate_parent'];
                $cate_order  = $cateDetail['cate_order'];
                
                $strLevel = "";
                if(!in_array($cate_id, $_SESSION['listedByID'])){
                    $_SESSION['listedByID'][] = $cate_id;

                    $orderList[] = array(
                        'cate_id' => $cate_id,
                        'cate_name' => $strLevel . $cate_name,
                        'cate_parent' => $cate_parent,
                        'cate_order' => $cate_order
                        );
                    $this->recursive($cate_id,$rawList,$strLevel,$orderList);

                } // end if (!inarray)
                

            } // end foreach
            // echo "</table>";

            $data['orderList'] = array_merge($orderList);

            $data['template'] = "cate/listcategory";
            $this->load->view('layout/layout',$data);
            
        } // end listcate()

    private function recursive($cate_id_parent,$rawList,$strLevel,&$orderList){
            $strLevel .= "----   ";
            // $a = 'b';
            // $UnOrdered = array();
            foreach ($rawList as $key => $cateDetail) {
                $cate_id     = $cateDetail['cate_id'];
                $cate_name   = $cateDetail['cate_name'];
                $cate_parent = $cateDetail['cate_parent'];
                $cate_order  = $cateDetail['cate_order'];

                if($cate_parent == $cate_id_parent){
      
                    if(!in_array($cate_id, $_SESSION['listedByID'])){

                        $temp = array(
                        'cate_id' => $cate_id,
                        'cate_name' => $strLevel . $cate_name,
                        'cate_parent' => $cate_parent,
                        'cate_order' => $cate_order
                        );

                        $orderList[] = $temp;
                        // $UnOrdered[] = $temp;
                        $_SESSION['listedByID'][] = $cate_id;

                        $this->recursive($cate_id,$rawList,$strLevel,$orderList);

                    } // end if
                    
                    
                } // end if $cate_parent
            } // end foreach
            
        } // end class recursive

    // Insert Category (account 5)
    // Writen by HoangHH
    public function insertCategory(){

        // get information exist category
        $rawList = $this->cate_model->getAll();
        $orderList = array();
        $_SESSION['listedByID'] = array();

        foreach ($rawList as $key => $cateDetail) {
            $cate_id     = $cateDetail['cate_id'];
            $cate_name   = $cateDetail['cate_name'];
            $cate_parent = $cateDetail['cate_parent'];
            $cate_order  = $cateDetail['cate_order'];
            
            $strLevel = "";
            if(!in_array($cate_id, $_SESSION['listedByID'])){
                $_SESSION['listedByID'][] = $cate_id;

                $orderList[] = array(
                    'cate_id' => $cate_id,
                    'cate_name' => $strLevel . $cate_name,
                    'cate_parent' => $cate_parent,
                    'cate_order' => $cate_order
                    );
                $this->recursive($cate_id,$rawList,$strLevel,$orderList);

            } // end if (!inarray)
        } // end foreach

        // list Category name for insert
        $ListInsert = array();
        foreach ($orderList as $key => $value) {
            // $CateID = $value['cate_id'];
            $ListInsert[] = array(
                'cate_id' => $value['cate_id'],
                'cate_name' => $value['cate_name']
                );
        } // 

        // echo "<pre>";
        // print_r($ListInsert);
        $data['ListInsert'] = array_merge($ListInsert);
        $data['template'] = "cate/insertcategory";
        
        $DataCate = array();
        if ($this->input->post('btnok')){
            $this->form_validation->set_rules('cate_name','Tên Category', 'required');
            // $this->form_validation->set_rules('cate_order','Thứ tự');
            
            $this->form_validation->set_message("required","%s không được bỏ trống");
            $this->form_validation->set_error_delimiters("<span class='error'>","</span>");

            if($this->form_validation->run()){
                $DataCate = array(
                        'cate_name'           => $this->input->post('cate_name'),
                        'cate_parent'          => $this->input->post('cate_parent'),
                        'cate_order'           => $this->input->post('cate_order')
                        ); // end array
                // echo "<pre>";
                // print_r($DataCate);
                $this->cate_model->insert($DataCate);
                redirect(base_url("administrator/cate/listcate"));
            } // end from_validation->run()

        } // end isset btnok

        $this->load->view("layout/layout",$data);
    } // end insertCategory()


    // recursive for list Category (account 2)
    // writen by HoangHH
    

} // end class cate
// end file cate.php