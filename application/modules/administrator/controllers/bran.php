<?php
class bran extends AdminBaseController{
    function __construct(){
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("form_validation");
        $this->load->model("bran_model");
        $this->load->library('pagination');
        $this->load->model ( "config_model" );
        // session_start();
        

    } // end __construct

    public function index(){
        $this->listbran();

    } // end index()

    public function listbran(){
        $InputSearch = '';
        if(isset($_POST['InputBrand']) && $_POST['InputBrand'] !== ''){
            $InputSearch = array('bran_name' => $_POST['InputBrand']);
        }
        $sortType = ($this->uri->segment(5)) ? $this->uri->segment(5) : 'asc';
        $column = ($this->uri->segment(4)) ? $this->uri->segment(4) : 'bran_id';
        $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 1;
        $page = trim($page);
        if(! ctype_digit($page)){
            echo "Trang không tồn tại!";
            return FALSE;
        }
        
        $config['base_url']   = base_url("administrator/bran/listbran/$column/$sortType/");
        $config['total_rows'] = $this->bran_model->count_all();
        $config['per_page'] = $this->config_model->getPerpage ();
        $NumberOfPage = ceil($config['total_rows'] / $config['per_page']);
        if($page > $NumberOfPage){
            echo "Trang không tồn tại!";
            return FALSE;
        }
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 6;

        $config['next_link'] = "Next";
        $config['prev_link'] = "Prev";

        $this->pagination->initialize($config); 

        $start = ($page - 1) * $config['per_page'];
        $data['listbran'] = $this->bran_model->get_order($column,$sortType,$start,$config['per_page'], $InputSearch);

        $data['link'] = $this->pagination->create_links();
        // $data['per'] = $config['
        // per_page'];
        $data['sortType'] = $sortType;

        $data['column'] = $column;

        $data['template'] = "bran/listbran";
        $this->load->view("layout/layout",$data);

    } // end class list bran

    // writen by VietDQ
    public function update(){
        $id = $this->uri->segment(4);
        $data['branInfo'] = $this->bran_model->detail($id);
        
        if($this->input->post("ok")){
            $this->form_validation->set_rules("InputBrand","Tên brand ","trim|required");          
            $this->form_validation->set_message("required","%s Không được bỏ trống");

            $this->form_validation->set_error_delimiters("<span class='error'>","</span>");
            $updateName=$this->input->post("InputBrand");
            
       
            if($this->form_validation->run()){
                $listall=$this->bran_model->get_order();
                
                foreach ($listall as $row) {
                    if (in_array(trim($updateName),$row) && ($row['bran_id']!=$id)) $data['errorName']="Đã tồn tại";

                }   
                 
                if (!isset($data['errorName'])){
                    $dataBran = array("bran_name" => $this->input->post("InputBrand"));
                    $this->bran_model->update($dataBran,$id);
                    redirect(base_url("administrator/bran/listbran"));
                }
            }
        } 
        $data['template'] = 'bran/update';
        $this->load->view("layout/layout",$data);
    }// end update

    // Huan
    // delete bran controller
    public function delete(){
            $bran_id = $this->uri->segment(4);
            $this->bran_model->delete($bran_id);
            
            redirect(base_url("administrator/bran/listbran"));
    } // end delete()


    // DucTM
    public function search(){
        if(isset($_POST["btnSearch"])){
            $search_term = $this->input->post("txtSearch");
            $SearchCondition = array('bran_name' => $search_term);
            $data['result'] = $this->bran_model->get_results($SearchCondition);
            $data['template'] = "bran/searchResult";
            $this->load->view("layout/layout",$data);
        }else{
            $data['template'] = "bran/searchView";
            $this->load->view("layout/layout",$data);

        }
    } // end search()
} // end class bran
// end file bran.php