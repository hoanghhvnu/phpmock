<?php
class order extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("order_model");
        $this->load->model("product_model");
        $this->load->library("pagination");
        $this->load->helper("url");
        $this->load->library("form_validation");

        session_start();
        if( ! isset($_SESSION['user'])){
            redirect(base_url("administrator/user/login"));
        } // end if Session
    } // end construct

    /**
     * 
     * HoangHH
     * @return [type]
     */
    public function listOrder(){
        if( ! isset($_SESSION['user'])){
            redirect(base_url("administrator/user/login"));
        }

        $sortType = ($this->uri->segment(5)) ? $this->uri->segment(5) : 'desc';
        $column = ($this->uri->segment(4)) ? $this->uri->segment(4) : 'order_status';

        
        if ($this->input->post('btnok')){
            if ($this->input->post('show_all')){
                $_SESSION['show_all'] = $this->input->post('show_all');
            } else{
                if(isset($_SESSION['show_all'])) unset($_SESSION['show_all']);
                if ($this->input->post('per_page')){
                    $_SESSION['PerPageListOrder'] = $this->input->post('per_page');
                }
            }

            
        }

        $_SESSION['PerPageListOrder']  = isset($_SESSION['PerPageListOrder']) ? $_SESSION['PerPageListOrder'] : 5;
        $_SESSION['show_all']  = isset($_SESSION['show_all']) ? $_SESSION['show_all'] : "no";
        $config['per_page'] = $_SESSION['PerPageListOrder'];
        $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 1;
        // if( ! is_int($page)){
        //     echo "Trang web không tồn tại!";
        //     return FALSE;
        // }

        if($this->input->post('SearchById')){
            $page = 1;
        }

        $config['base_url']   = base_url("administrator/order/listorder/$column/$sortType/");
        $config['total_rows'] = $this->order_model->count_all();
        if($config['per_page'] > $config['total_rows'] || $_SESSION['show_all'] == 'show'){
            $config['per_page'] = $config['total_rows'];
            $page = 1;
        }

        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 6;
        $config['next_link'] = "Sau";
        $config['prev_link'] = "Trước";
        $this->pagination->initialize($config); 

        $start = ($page - 1) * $config['per_page'];

        // echo "sortType " . $sortType . "<br/>";
        // echo "start: " . $start . "<br/>";
        // echo "per_page" . $config['per_page'] . "<br/>";
        // echo "page: " . $page;
        // $data['listuser'] = $this->order_model->get_order($column,$sortType,$start,$config['per_page']);

        $data['link'] = $this->pagination->create_links();
        $data['per'] = $config['per_page'];
        $data['sortType'] = $sortType;
        $data['show_all'] = $_SESSION['show_all'];
        $data['column'] = $column;
        // echo "<pre>";
        // print_r($RawList);
        $data['template'] = "order/listorder";
        if( ! $this->input->post('SearchById')){
            $data['ListOrder'] = $this->order_model->get_order($column,$sortType,$start,$config['per_page']);
        } else{
            $order_id = $this->input->post('SearchById');
            // echo $order_id;
            $data['ListOrder'] = $this->order_model->getSearch($column,$sortType,"order_id = {$order_id}" ,$start,$config['per_page']);
        }
        
        $this->load->view("layout/layout",$data);
    } // end listOrder()

    /**
     * orderDetail
     * @return [type]
     */
    public function orderDetail($order_id){
        $OrderId = ($this->uri->segment(4)) ? $this->uri->segment(4) : "";
        $Action = ($this->uri->segment(5)) ? $this->uri->segment(5) : "";
        if(isset($Action) && $Action != ""){
            if($Action == "approve"){
                // Change order_status to active
                $this->order_model->confirmOrder($OrderId);
            } else if ($Action == "cancel"){
                // Delete Order
                $this->order_model->deleteOrder($OrderId);
            }
            redirect(base_url("administrator/order/listorder"));
        }
        // echo "order id = " . $OrderId;
        if( ! is_numeric($OrderId)){

            echo "<span class = 'error'>Trang web không tồn tại!</span>";
            return FALSE;
        }else{
            $Order = $this->order_model->getOnceById($OrderId);
            // $Order = $this->order_model->getSearch("","","order_id = {$OrderId}","","");
            // echo "<pre>";
            // print_r($Order);
            if(count($Order) < 1){
                echo "<span class = 'error'>Không tìm thấy đơn hàng nào phù hợp</span>";
            }else{
                $OrderInfo = array(
                                'order_id'    => $Order['order_id'],
                                'cus_name'    => $Order['cus_name'],
                                'cus_email'   => $Order['cus_email'],
                                'cus_address' => $Order['cus_address'],
                                'cus_phone'   => $Order['cus_phone'],
                                'cus_gender'  => $Order['cus_gender'],
                                'order_date' => $Order['order_date'],
                                'order_status' => $Order['order_status']
                                );
                $OrderDetail = $this->order_model->getOrderDetail($OrderId);
                // echo "<pre>";
                // print_r($OrderDetail);
                if(count($OrderDetail) < 1){
                    echo "Đơn hàng chưa có sản phẩm nào!";
                }else{
                    $data['OrderInfo'] = $OrderInfo;
                    $data['OrderDetail'] = $OrderDetail;
                    $data['template'] = "order/orderdetail";
                    $this->load->view("layout/layout",$data);
                }

            } // end if count($order)
        } // end if is_int
    } // end orderDetail()

    public function insertOrder(){
        $data['template'] = "order/InsertOrder";
        $this->load->view("layout/layout",$data);
    } // end insertOrder
} // end class order
