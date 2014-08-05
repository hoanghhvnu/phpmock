<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WEB BÁN HÀNG</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/phpmock/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/admin/AdminStyle.css" />
<script type="text/javascript">
            function CheckDelete(){
                    r = confirm("Bạn chắc chắn xoá không?");
                    if(r == false) return false;
                    else return true;
                                               
            } 
</script>
<script>
function MyConfirm(string) {
    
    if (confirm(string) == true) {
        return true;
    } else {
        return false;
    }
}
</script>
<script src="/phpmock/js/jquery.js"></script>
    <script>
$(document).ready(function(){

     $(".delete").click(function(e){
        
       alert("Delete?");
         e.preventDefault(); 
         var href = $(this).attr("href");
     
         var parent = $(this).parent();

        $.ajax({
          type: "GET",
          url: href,
          async: true,
          success: function(response) {
          parent.fadeOut('slow', function() {$(this).remove();});
        

            
          

       }
    });

   })
  });
    
    
    </script>
</head>
<body>
    <div id="banner">&nbsp;</div>
    <div id="menu"><h1>Trang quản lý</h1></div>
    <div id="main">
        <div id="left">
            <div class="category">
                <h1>MENU CHỨC NĂNG</h1>
                <ul>
                    <li><a href="<?php echo base_url('administrator/user/listuser');?>">Quản lý thành viên</a></li>
                    <li><a href="<?php echo base_url('administrator/cate/listcate');?>">Quản lý chuyên mục</a></li>
                    <li><a href="<?php echo base_url('administrator/product/listproduct');?>">Quản lý sản phẩm</a></li>
                    <li><a href="<?php echo base_url('administrator/bran/listbran');?>">Quản lý thương hiệu</a></li>
                    <li><a href="<?php echo base_url('administrator/order/listorder');?>">Quản lý đơn hàng </a></li>
                    <li><a href="<?php echo base_url('administrator/config');?>">Quản lý cấu hình </a></li>
                </ul>
            </div>
            <div class="category" style="margin-top:10px; border-top:1px solid #CCC; background:#FFF;">
                <?php
                    
                    // $ob = new user();
                    // $usrname = $ob->session->userdata['user'];
                    // print_r($usrname);
                ?>
                 <p>Chào bạn: 
                     <?php if(session_id() == '') {
                                session_start();
                            };
                            // print_r($_SESSION['user']);
                             echo  isset($_SESSION['user']['username']) ?  $_SESSION['user']['username'] : "";
                     ?></p>
                <p><a href=' <?php echo base_url("/administrator/user/logout") ?> '>Đăng xuất</a></p>
                
            </div>
        </div>