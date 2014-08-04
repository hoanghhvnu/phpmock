<?php
/**
 * All action for Category
 */
// if(session_id() == '') {
//     session_start();
// }
class cate extends AdminBaseController{
    protected $_OrderedCategory;
    function __construct(){
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("form_validation");
        $this->load->model("cate_model");
        
        

    } // end __construct

    public function index(){
        $this->listcate();

    } // end index()

    /**
     * written by HoangHH
     * Show all category in order by cate_order
     * use rucursive to do
     * @return [type]
     */
    public function listcate(){
        $SortedList = $this->getCategory();
            if( ! empty($SortedList)){
                $data['orderList'] = $SortedList;
                $data['template'] = "cate/listcategory";
                $this->load->view('layout/layout',$data);
            } // end if empty SortedList
    } // end listcategory

    

    

    // Insert Category (account 5)
    // Writen by HoangHH
    public function insertCategory(){
        $data['ListInsert'] = $this->getCategory();
        $data['template'] = "cate/insertcategory";
        
        $DataCate = array();
        if ($this->input->post('btnok')){
            $this->form_validation->set_rules('cate_name','Tên Category', 'required');
            
            $this->form_validation->set_message("required","%s không được bỏ trống");
            $this->form_validation->set_error_delimiters("<span class='error'>","</span>");

            if($this->form_validation->run()){
                if($this->cate_model->checkCate($this->input->post('cate_name'))){
                    $DataCate = array(
                        'cate_name'   => $this->input->post('cate_name'),
                        'cate_parent' => $this->input->post('cate_parent'),
                        'cate_order'  => $this->input->post('cate_order')
                        ); // end array
                    // echo "<pre>";
                    // print_r($DataCate);
                    $this->cate_model->insert($DataCate);
                    redirect(base_url("administrator/cate/listcate"));
                }
                if( ! $this->cate_model->checkCate($this->input->post('cate_name'))){
                    $data['errorCate'] = "Tên Category đã tồn tại, vui lòng chọn tên khác";
                }
            } // end from_validation->run()

        } // end isset btnok

        $this->load->view("layout/layout",$data);
    } // end insertCategory()


    // VietDq
    public function update()
    
    {
      
        $id = $this->uri->segment(4);
        $data['categoryInfo'] = $this->cate_model->detail($id);
        $rows = $this->cate_model->detail($id);
      
        /**
         * line bellow written by VietDQ
         */
        // $data['showCategory'] = $this->getDataInsertCategory(0);

        /**
         * Rewritten by HoangHH
         */
        $data['showCategory'] = $this->getCategory();
      
        if($this->input->post("ok")){
            $this->form_validation->set_rules("cate_name","Tên category","trim|required");
            
            $this->form_validation->set_rules("cate_parent","Tên category cha","trim|required|numeric");
            $this->form_validation->set_rules("cate_order","Thứ tự category ","trim|required|numeric");

            $this->form_validation->set_message("required","%s không được bỏ trống");

            $this->form_validation->set_message("numeric","%s phải là số so");
            $this->form_validation->set_error_delimiters("<span class='error'>","</span>");
            if($this->form_validation->run()){
                $parentname = $this->input->post("cate_parent");
                $cate_name  = $this->input->post("cate_name");
                $listall    = $this->cate_model->getAll();
                
                foreach ($listall as $row) {
                if (in_array(trim($cate_name),$row)&& $row['cate_id']!=$id) $data['errorName']="Đã tồn tại";
                if ($row['cate_parent']==$id &&$this->check($id,$parentname)==1) $data['errorTrung']="Không được chọn con của nó"; 
                //check bi lap vo tan

                }   
                if ($parentname==$rows['cate_id']) $data['errorTrung']="Không được chọn";
    
                if (!isset($data['errorTrung'])&& !isset($data['errorName'])) {
                
                    $datacategory = array(
                                    "cate_name"   =>$this->input->post("cate_name"),
                                    "cate_parent" =>$this->input->post("cate_parent"),
                                    "cate_order"  =>$this->input->post("cate_order")
                                );
                    
                    $this->cate_model->update($datacategory,$id);
                    redirect(base_url("administrator/cate/listcate"));
                 }
            }
            
        }
        $data['template'] = "cate/update";
        $this->load->view("layout/layout",$data);
        
    } // end update()


    /**
     * Written by VietDQ
     * @param  integer $parent
     * @param  string  $gach
     * @param  [type]  $data
     * @return [type]
     */
    
    /**
     * Comment out because rewrite by HoangHH with getCatogory method better
     */
    
    // private function getDataInsertCategory($parent = 0,$gach = '-  ',$data = NULL)
    // {
    //     if(!$data) $data = array();  
    //     // Truy cap den CSDL qua nhieu
    //     $sql = $this->cate_model->detailparent($parent);
    //     foreach($sql as $key=>$value){
    //         $data[] = array(
    //                     'cate_id'    =>$value['cate_id'],
    //                     'cate_name'  =>$gach.$value['cate_name'],
    //                     'cate_parent'=>$value['cate_parent']
    //                     );
    //         $data = $this->getDataInsertCategory($value['cate_id'],$gach.'---   ',$data);
    //     }    
    //     return $data;
    // }

    public function check($parent,$child) {
      
      
      $info=$this->cate_model->infoparent($child);

       $parentid=$info['cate_parent'];
       if ($parent==0) return 1;
       if ($parentid==$parent) {return 1; }
       else if ($parentid!=0)
           return $this->check($parent,$parentid);
       else if ($parentid==0) return 0;
    }

    // Huan DT
    public function delete(){
        $cate_id = $this->uri->segment(4);
        $data = $this->cate_model->getAll();
        $detail = $this->cate_model->getOnce($cate_id);
       // print_r($detail);
        foreach($data as $value){
           if($value['cate_parent'] == $cate_id){
                $value['cate_parent'] = $detail['cate_parent'];
                $dta = array(
                'cate_parent' => $value['cate_parent']
            );
                echo $dta['cate_parent'];
            $this->cate_model->update($dta, $value['cate_id']);
           }


        }

        $this->cate_model->delete($cate_id);
            
        redirect(base_url("administrator/cate/listcate"));
    } // end deleteU
    

    // DucTM
    public function move(){
        $data = isset($_POST['data'])?$_POST['data']:"";
        $data = json_decode($data,true);
        print_r($data);
        
        $this->cate_model->updateCategory($data,0);
        
       
    }

    // DucTM
    /**
     * Written by DucTM
     * @return [type]
     */
    public function moveCategory()  
    
    {
            $this->load->library('pagination');
            $this->load->helper('url');
            $this->load->library('table');
            
            // cấu hình phân trang
            $config['base_url'] = base_url('phpmock/administrator/cate/moveCategory'); // xác định trang phân trang
            $config['total_rows'] = $this->cate_model->count_all(); // xác định tổng số record
            $config['per_page'] = 100; // xác định số record ở mỗi trang
            $config['uri_segment'] = 4; // xác định segment chứa page number
            $this->pagination->initialize($config);
            
            // tạo table
            /*$this->table->set_heading('id','name');*/
            $data['listcategory'] = $this->cate_model->list_all($config['per_page'],$this->uri->segment(4));

        $data['template'] = "cate/moveCategory";
        $this->load->view("layout/layout",$data);
    }

    /**
     * Written by HoangHH
     * getCategory in order acording cate_order
     * @return [type]
     */
    private function getCategory($LevelSign = ""){
        $SequenceList = $this->cate_model->getAll();
        if( empty($SequenceList)){
            echo "Have no category!";
        } else{
            // get Category level 0, ParentId = 0;
            $strLevel = "";
            $SortedList = $this->recursive(0, $SequenceList, $strLevel);
            return $SortedList;
        } // end if empty
    } // end getCategory


    /**
     * written by HoangHH
     * Use to get sub-level category, support for listcate() method
     * @param  [type] $ParentId
     * @param  [type] $List
     * @param  [type] $strLevel
     * @return [type]
     */
    private function recursive($ParentId, &$List, $strLevel){
        if( ! empty($List)){
            if( $ParentId != 0 ){
                $strLevel .= "____";
            } else{
                // $strLevel = "";
            }

            $LevelList = array();
            
            foreach ($List as $key => $CateDetail) {
                if($ParentId == $CateDetail['cate_parent']){
                    $temp = array(
                        'cate_id' => $CateDetail ['cate_id'],
                        'cate_name' => $strLevel . $CateDetail ['cate_name'],
                        'cate_parent' => $CateDetail ['cate_parent'],
                        'cate_order' => $strLevel . $CateDetail ['cate_order']
                        );
                    $LevelList[$key] = $temp;
                    // $LevelList[$key] = $CateDetail;
                    unset($List[$key]);
                } // end if ParentId
            } // end foreach $List

            

            if( ! empty($LevelList)){
                $LevelSortByOrder = array();
                foreach ($LevelList as $key => $LevelCateDetail) {
                    $LevelKeyOrder[$key] = $LevelCateDetail['cate_order'];
                }

                asort($LevelKeyOrder);

                $LevelSorted = array();
                foreach ($LevelKeyOrder as $key => $CateOrder) {
                    $LevelSorted[$key] = $LevelList[$key];
                }

                $LevelAndSub = array();
                foreach ($LevelSorted as $key => $LevelCateDetail) {
                    $LevelAndSub[] = $LevelCateDetail;
                    $SubLevel = $this->recursive($LevelCateDetail['cate_id'], $List, $strLevel);
                    if ( ! empty($SubLevel)){
                        foreach ($SubLevel as $key => $SubLevelCateDetail) {
                            $LevelAndSub[] = $SubLevelCateDetail;
                        }
                    } // end if SubLevel
                } // end foreach LevelSorted
                return $LevelAndSub;
            } // end if empty $Level
        } // end if ! empty()
    } // end recursive()

} // end class cate
// end file cate.php