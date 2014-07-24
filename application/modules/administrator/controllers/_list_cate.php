// List Category
    // Writen by HoangHH
    <?php
    public function listcate(){
            $ListConsequenFromSql = $this->cate_model->getAll();
            $LevelList = array();
            $GlobalOrderedList = array();
            $strLevel = "";

            // $_SESSION['listedByID'] = array();

            foreach ($ListConsequenFromSql as $key => $cateDetail) {
                $cate_id     = $cateDetail['cate_id'];
                $cate_name   = $cateDetail['cate_name'];
                $cate_parent = $cateDetail['cate_parent'];
                $cate_order  = $cateDetail['cate_order'];
                
                if($cate_parent == 0){
                    $LevelList[] = array(
                                'cate_id'     => $cate_id,
                                'cate_name'   => $strLevel . $cate_name,
                                'cate_parent' => $cate_parent,
                                'cate_order'  => $cate_order
                                );
                    unset($ListConsequenFromSql[$key]);
                } // end if $cate_parent
            } // end foreach

            $RemainCate = $ListConsequenFromSql;

            foreach ($LevelList as $key => $value) {
                $KeyCateOrder[$key] = $value['cate_order'];
            }
            if(isset($KeyCateOrder)){
                asort($KeyCateOrder);
                foreach ($KeyCateOrder as $key => $value) {
                    $OrderedLevelList[$key] = $LevelList[$key];
                } // end foreach $KeyCateOrder
            } // end if isset($KeyCateOrder)

            foreach ($OrderedLevelList as $key => $value) {
                // $GlobalOrderedList[] = $value;
                echo $value['cate_name'];
                // echo "add" . $value['cate_id'] . "<br/>";
                $this->recursive($cate_id,$RemainCate,$strLevel,$GlobalOrderedList);
            }

            $data['orderList'] = $GlobalOrderedList;
            $data['template'] = "cate/listcategory";
            $this->load->view('layout/layout',$data);
            
        } // end listcate()

    private function recursive($cate_id,$RemainCate,$strLevel,&$GlobalOrderedList){
            $strLevel .= "_____   ";
            // $a = 'b';
            // $UnOrdered = array();
            $LevelList = array();
            foreach ($RemainCate as $key => $cateDetail) {
                $cate_id     = $cateDetail['cate_id'];
                $cate_name   = $cateDetail['cate_name'];
                $cate_parent = $cateDetail['cate_parent'];
                $cate_order  = $cateDetail['cate_order'];

                if($cate_parent == $cate_id){
                    $LevelList[] = array(
                                'cate_id'     => $cate_id,
                                'cate_name'   => $strLevel . $cate_name,
                                'cate_parent' => $cate_parent,
                                'cate_order'  => $cate_order
                                );
                    unset($RemainCate[$key]);
                } // end if $cate_parent
            } // end foreach

            foreach ($LevelList as $key => $value) {
                $KeyCateOrder[$key] = $value['cate_order'];
            }
            if(isset($KeyCateOrder)){
                asort($KeyCateOrder);
                foreach ($KeyCateOrder as $key => $value) {
                    $OrderedLevelList[$key] = $LevelList[$key];
                } // end foreach $KeyCateOrder
            } // end if isset($KeyCateOrder)

            foreach ($OrderedLevelList as $key => $value) {
                // $GlobalOrderedList[] = $value;
                echo $value['cate_name'];
                // echo "add" . $value['cate_id'] . "<br/>";
                $this->recursive($value['cate_id'],$RemainCate,$strLevel,$GlobalOrderedList);
            }
            
        } // end class recursive