<?php
class cate extends CI_Controller{
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

    public function listcate(){
        $ref = 'a';
        // $this->load->view("main/mainhead");
        $rawList = $this->cate_model->getAll();
        $orderList = array();
        // echo "<pre>";
        // print_r($rawList);
        $_SESSION['listedByID'] = array();

        // echo "<table border = '1'>";
        // echo "<th>CategoryID</th>";
        // echo "<th>Category Name</th>";
        // echo "<th>Category Parent</th>";
        // echo "<th>Category Order</th>";
        // echo "<th>Edit</th>";
        // echo "<th>Delete</th>";
        foreach ($rawList as $key => $cateDetail) {
            // echo "<div id = 'center'>";
            // echo $key;
            $cate_id     = $cateDetail['cate_id'];
            $cate_name   = $cateDetail['cate_name'];
            $cate_parent = $cateDetail['cate_parent'];
            $cate_order  = $cateDetail['cate_order'];
            
            // echo $cate_name . "<br>";

            $strLevel = "";
            if(!in_array($cate_id, $_SESSION['listedByID'])){
                // echo "<ul>";
                // echo "<li>";
                // echo "<tr>";
                // echo "<td>" . $cate_id . "</td>";
                // echo "<td>" . $strLevel . $cate_name . "</td>";
                // echo "<td>" . $cate_parent . "</td>";
                // echo "<td>" . $cate_order . "</td>";
                // echo "<td><a href = '" . base_url("/administrator/cate/update/") . "/" . $cate_id . "'>Edit</a></td>";
                // echo "<td><a href = '" . base_url("/administrator/cate/delete/") . "/" . $cate_id . "'>Delete</a></td>";
                // echo "</tr>";
                // echo $cate_name;
                $_SESSION['listedByID'][] = $cate_id;
                /*$keyDelete = "'" . $key.  "'";
                echo $keyDelete . "= " . $rawList[$key]['cate_name'] . "ok";
                echo "<pre>";
                print_r($rawList);
                unset($rawList[$key]);*/
                $orderList[] = array(
                    'cate_id' => $cate_id,
                    'cate_name' => $strLevel . $cate_name,
                    'cate_parent' => $cate_parent,
                    'cate_order' => $cate_order
                    );
                $this->recursive($cate_id,$rawList,$strLevel,$orderList);
                // echo "</li>";
                // echo "</ul>";
            } // end if (!inarray)
            

        } // end foreach
        echo "</table>";
        // echo "<pre>";
        // print_r($orderList);
        $data['orderList'] = array_merge($orderList);
        // echo "<pre>";
        // print_r($data);
        // echo $a;
        $data['template'] = "cate/listcategory";
        $this->load->view('layout/layout',$data);
        
    } // end listcate()

    private function recursive($cate_id_parent,$rawList,$strLevel,&$orderList){
        $strLevel .= "--";
        // $a = 'b';
        foreach ($rawList as $key => $cateDetail) {
            $cate_id     = $cateDetail['cate_id'];
            $cate_name   = $cateDetail['cate_name'];
            $cate_parent = $cateDetail['cate_parent'];
            $cate_order  = $cateDetail['cate_order'];

            // echo $cate_name . "<br>";

            if($cate_parent == $cate_id_parent){
  
                if(!in_array($cate_id, $_SESSION['listedByID'])){
                    // echo "inarray" .  in_array($cate_id, $listedByID);
                    // echo "<tr>";
                    // echo "<td>" . $cate_id . "</td>";
                    // echo "<td>" . $strLevel . $cate_name . "</td>";
                    // echo "<td>" . $cate_parent . "</td>";
                    // echo "<td>" . $cate_order . "</td>";
                    // echo "<td><a href = '" . base_url("/administrator/cate/update") . "/" . $cate_id . "'>Edit</a></td>";
                    // echo "<td><a href = '" . base_url("/administrator/cate/delete") . "/" . $cate_id . "'>Delete</a></td>";
                    // echo "</tr>";
                    $orderList[] = array(
                    'cate_id' => $cate_id,
                    'cate_name' => $strLevel . $cate_name,
                    'cate_parent' => $cate_parent,
                    'cate_order' => $cate_order
                    );
                    $_SESSION['listedByID'][] = $cate_id;
                    /*$keyDelete = "'" . $key.  "'";
                    unset($rawList[$key]);*/
                    $this->recursive($cate_id,$rawList,$strLevel,$orderList);
                    // echo "</li>";
                    // echo "</ul>";
                } // end if
                
                
            } // end if $cate_parent
        }
    } // end class recursive

} // end class cate
// end file cate.php