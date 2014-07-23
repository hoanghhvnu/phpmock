<?php
class category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("category_model");
        $this->load->library("form_validation");
    }
    public function index()
    {

    }
    public function insert()
    {
         
        if($this->input->post("ok")){
            $this->form_validation->set_rules("cate_name","Ten thanh vien ","trim|required");
            
            $this->form_validation->set_rules("cate_parent","Cate parent ","trim|required|numeric");
            $this->form_validation->set_rules("cate_order","Cate order ","trim|required|numeric");

            $this->form_validation->set_message("required","%s khong duoc bo trong");
            $this->form_validation->set_message("min_length","%s khong duoc nho hon %d ky tu");
            $this->form_validation->set_message("matches","%s khong dung");
            $this->form_validation->set_message("valid_email","%s khong dung dinh dang");
            $this->form_validation->set_message("numeric","%s phai la so");
            $this->form_validation->set_error_delimiters("<span class='error'>","</span>");
            if($this->form_validation->run()){
                $datacategory = array(
                                "cate_name"=>$this->input->post("cate_name"),
                                "cate_parent"=>$this->input->post("cate_parent"),
                                "cate_order"=>$this->input->post("cate_order"),
                               
                            );
                $this->category_model->insert($datacategory);
                redirect(base_url("/Day1/administrator/category/listcategory"));
            }
            
        }
        $data = array();
        $this->load->view("administrator/category/insert",$data);
    }
    public function update()
    
    {
      
        $id = $this->uri->segment(4);
        $data['categoryInfo'] = $this->category_model->detail($id);
        $rows = $this->category_model->detail($id);
      
        
        $data['showCategory'] = $this->getDataInsertCategory(0);
      
        if($this->input->post("ok")){
            $this->form_validation->set_rules("cate_name","Tên category","trim|required");
            
            $this->form_validation->set_rules("cate_parent","Tên category cha","trim|required|numeric");
            $this->form_validation->set_rules("cate_order","Thứ tự category ","trim|required|numeric");

            $this->form_validation->set_message("required","%s không được bỏ trống");

            $this->form_validation->set_message("numeric","%s phải là số so");
            $this->form_validation->set_error_delimiters("<span class='error'>","</span>");
            if($this->form_validation->run()){
                $parentname=$this->input->post("cate_parent");
                $cate_name=$this->input->post("cate_name");
                $listall=$this->category_model->getAll();
                
                foreach ($listall as $row) {
                if (in_array(trim($cate_name),$row)&& $row['cate_id']!=$id) $data['errorName']="Đã tồn tại";
                if ($row['cate_parent']==$id &&$this->check($id,$parentname)==1) $data['errorTrung']="Không được chọn con của nó"; 
                //check bi lap vo tan

                }   
                if ($parentname==$rows['cate_id']) $data['errorTrung']="Không được chọn";
   
                if (!isset($data['errorTrung'])&& !isset($data['errorName'])) {
                
                $datacategory = array(
                                "cate_name"=>$this->input->post("cate_name"),
                                "cate_parent"=>$this->input->post("cate_parent"),
                                "cate_order"=>$this->input->post("cate_order")
                            );
                
                $this->category_model->update($datacategory,$id);
                redirect(base_url("/Day1/administrator/category/listcategory"));
                 }
                 }
            
        }
        $this->load->view("administrator/category/update",$data);
        
    }
    public function listcategory()
    
    {
			$this->load->library('pagination');
			$this->load->helper('url');
			$this->load->library('table');
			
			// cấu hình phân trang
			$config['base_url'] = base_url('Day1/administrator/category/listcategory'); // xác định trang phân trang
			$config['total_rows'] = $this->category_model->count_all(); // xác định tổng số record
			$config['per_page'] = 5; // xác định số record ở mỗi trang
			$config['uri_segment'] = 4; // xác định segment chứa page number
			$this->pagination->initialize($config);
			
			// tạo table
			/*$this->table->set_heading('id','name');*/
			$data['listcategory'] = $this->category_model->list_all($config['per_page'],$this->uri->segment(4));

        $this->load->view("administrator/category/listcategory",$data);
    }
    public function delete()
    {
        $id = $this->uri->segment(4);
        $this->category_model->deletecategory($id);
        redirect(base_url("/Day1/administrator/category/listcategory"));
    }
    private function getDataInsertCategory($parent = 0,$gach = '-  ',$data = NULL)
    {
        if(!$data) $data = array();  
        $sql = $this->category_model->detailparent($parent);
        foreach($sql as $key=>$value){
            $data[] = array(
                        'cate_id'    =>$value['cate_id'],
                        'cate_name'  =>$gach.$value['cate_name'],
                        'cate_parent'=>$value['cate_parent']
                        );
            $data = $this->getDataInsertCategory($value['cate_id'],$gach.'---   ',$data);
        }    
        return $data;
    }


    
    public function check($parent,$child) {
      
      
      $info=$this->category_model->infoparent($child);

       $parentid=$info['cate_parent'];
       if ($parent==0) return 1;
       if ($parentid==$parent) {return 1; }
       else if ($parentid!=0)
           return $this->check($parent,$parentid);
       else if ($parentid==0) return 0;
    }
    
}