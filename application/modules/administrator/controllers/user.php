<?php
class user extends AdminBaseController{
    function __construct(){
        parent::__construct();
        $this->load->helper("url");
        $this->load->library("form_validation");
        $this->load->model("user_model");
        $this->load->library('pagination');
        $this->load->model("config_model");
        // session_start();

    } // end __construct

    public function index(){
            redirect(base_url("administrator/user/listuser"));

    } // end index()




    public function listuser(){
        
        $sortType = ($this->uri->segment(5)) ? $this->uri->segment(5) : 'asc';
        $column = ($this->uri->segment(4)) ? $this->uri->segment(4) : 'usr_id';

        $config['per_page'] = $this->config_model->getPerpage();
        $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 1;
        $config['base_url']   = base_url("administrator/user/listuser/$column/$sortType/");

        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 6;
        $config['next_link'] = "Sau";
        $config['prev_link'] = "Trước";
        $this->pagination->initialize($config); 

        $start = ($page - 1) * $config['per_page'];

        $data['listuser'] = $this->user_model->get_order($column,$sortType,$start,$config['per_page']);

        $data['link'] = $this->pagination->create_links();
        $data['per'] = $config['per_page'];
        $data['sortType'] = $sortType;
        // $data['show_all'] = $_SESSION['show_all'];
        $data['column'] = $column;

        $data['template'] = "user/listuser";
        $this->load->view("layout/layout",$data);
        // $this->load->view("main/main");

    } // end class list user

    public function insertUser(){

        $dataUser = array();
        if ($this->input->post('btnok')){
            $this->form_validation->set_rules('usr_password','Password', 'required|min_length[6]|matches[usr_retype_password]');
            $this->form_validation->set_rules('usr_retype_password','Retype-Password', 'required');

            $this->checkFormInput();

            if($this->form_validation->run()){
                if($this->user_model->checkUserName($this->input->post('usr_name'))
                && $this->user_model->checkEmail($this->input->post('usr_email'))
                ){
                    // echo md5($this->input->post('usr_password'));
                    $dataUser = array(
                        'usr_name'            => $this->input->post('usr_name'),
                        'usr_password'        => md5($this->input->post('usr_password')),
                        'usr_email'           => $this->input->post('usr_email'),
                        'usr_address'         => $this->input->post('usr_address'),
                        'usr_phone'           => $this->input->post('usr_phone'),
                        'usr_gender'          => $this->input->post('usr_gender'),
                        'usr_level'           => $this->input->post('usr_level')
                        ); // end array
                
                $this->user_model->update($dataUser);
                redirect(base_url("administrator/user/listuser"));
                } // end if check User
                if( ! $this->user_model->checkUserName($this->input->post('usr_name'))){
                    $data['errorUser'] = "Username đã tồn tại, vui lòng chọn tên khác!";
                }

                if( ! $this->user_model->checkEmail($this->input->post('usr_email'))){
                    $data['errorEmail'] = "Email đã tồn tại, vui lòng chọn email khác";
                }
            } // end if val

        } // end isset btnok

        $data['dataUser'] = $dataUser;
        $data['template'] = 'user/insertuser';
        $this->load->view("layout/layout",$data);
    } // end insertUser()

    // writen by VietDQ
    /**
     * [delete description]
     * @return [type]
     */
    public function delete(){

        $id = $this->uri->segment(4);
        $this->user_model->deleteUser($id);
        // redirect(base_url("/administrator/user/listuser"));
        redirect(base_url("administrator/user/listuser"));
    }

    // Huan
    public function update(){

        $usr_id = $this->uri->segment(4);
        $data['userInfo'] = $this->user_model->getOnce($usr_id);
        if($this->input->post("ok")){

            $this->checkFormInput();

            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
            if($this->form_validation->run()){
                 $dataUser = array(
                                "usr_name"     =>$this->input->post("usr_name"),
                                "usr_password" =>$this->input->post("usr_password"),
                                "usr_email"    =>$this->input->post("usr_email"),
                                "usr_address"  =>$this->input->post("usr_address"),
                                "usr_phone"    =>$this->input->post("usr_phone"),
                                "usr_gender"   =>$this->input->post("usr_gender"),
                                "usr_level"    =>$this->input->post("usr_level")
                            );
                $this->user_model->update($dataUser,$usr_id);
                //redirect(base_url("administrator/users/listusers"));
                redirect(base_url("administrator/user/listuser"));
            }
        }
        $data['template'] = "user/update";
        $this->load->view("layout/layout", $data);
    } // update()

    // DucTM
    public function login(){
        
        if($this->input->post("btnLogin")){
        
            $this->form_validation->set_rules('txtUser','Username','trim|required');
            $this->form_validation->set_rules('txtPass','Password','trim|required|min_length[5]|max_length[12]');
    
            
            $this->form_validation->set_message("required","%s không được bỏ trống");
            $this->form_validation->set_error_delimiters('<div class="error">','</div>'); 
            if($this->form_validation->run()){
                $dataUser =array(
                    "username"=>$this->input->post("txtUser"),
                    "password"=>md5($this->input->post("txtPass"))
                );
                $check = $this->user_model->is_Validate($dataUser);
                // echo $check;
                if($check){
                   // $this->session->set_userdata('user',$check);
                    $_SESSION['user'] = $check;
                    redirect(base_url('administrator/user/listuser'));
                }else{
                    $this->_check = false;
                }
            } // end if run
        } // end if btLogin

        $this->load->view("user/loginView");
    } // end login()
    
    public function logout(){
        // $this->session->unset_userdata('user');
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
        }
         // $this->load->view("user/loginView");
        // $this->login();
        redirect(base_url('administrator/user/index'));
        //$obj = new user;
        //$obj->login();
    }
    public function checkFormInput(){
        $this->form_validation->set_rules('usr_name','Username', 'required|alpha_numeric|min_length[6]');
        // $this->form_validation->set_rules('usr_password','Password', 'required|min_length[6]|matches[usr_retype_password]');
        // $this->form_validation->set_rules('usr_retype_password','Retype-Password', 'required');
        $this->form_validation->set_rules('usr_email','Email', 'required|valid_email');
        $this->form_validation->set_rules('usr_address','Address', 'required');
        $this->form_validation->set_rules('usr_phone','Phone', 'required|numeric|min_length[9]|max_length[11]');
        $this->form_validation->set_rules('usr_gender','Gender', 'required');

        $this->form_validation->set_message("required","%s không được bỏ trống");
        $this->form_validation->set_message("alpha_numeric","%s chỉ được chứa chữ cái và số");
        $this->form_validation->set_message("min_length","%s không được nhỏ hơn %d ký tự");
        $this->form_validation->set_message("max_length","%s không được lớn hơn %d ký tự");
        $this->form_validation->set_message("matches","%s không khớp");
        $this->form_validation->set_message("valid_email","%s không đúng định dạng");
        $this->form_validation->set_message("numeric","%s phải là số");
        $this->form_validation->set_error_delimiters("<span class='error'>","</span>");
    }
}
// end class user
// end file controller/user.php
