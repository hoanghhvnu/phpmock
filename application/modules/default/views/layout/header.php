<!DOCTYPE html>
<html>
<head>
<title>Project Nhom 2</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="http://localhost/phpmock/public/style.css" />


<!-- HuanDT -->
<link rel="stylesheet" type="text/css" href="http://localhost/phpmock/public/css/detailproduct.css" />
<link rel="stylesheet" type="text/css" href="http://localhost/phpmock/public/css/example.css" />
<link rel="stylesheet" type="text/css" href="http://localhost/phpmock/public/css/jquery.megamenu.css" />
<script src="http://localhost/phpmock/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="http://localhost/phpmock/js/jquery.megamenu.js"></script>
<script type="text/javascript" src="http://localhost/phpmock/js/windowopen.js"></script>
<script type="text/javascript" src="http://localhost/phpmock/js/boxOver.js"></script>
<!-- end HuanDT -->

</head>
<body>
<div id="main_container">
  <div class="top_bar">
    
  </div>
  <div id="header">
    <div id="logo"> <a href="http://localhost/phpmock/default/home/index">
    <img src="http://localhost/phpmock/public/images/smartosc.jpg" alt="" border="0"
     width="237" height="140" /></a> </div>
  </div>
      <!-- show slide der ============================================================================ -->

      <script type="text/javascript" src="http://localhost/phpmock/js/jquery-1.11.1.min.js"></script>
      <?php
        if(isset($slider)) :
      ?>
        <div id = 'wapperSlider'>
      <?php
            $data['SliderData'] = $slider;
            $this->load->view('layout/slider',$data);
      ?>
        </div>
        <?php
        endif;
      ?>
      <!-- end slider ================================================================================ -->

    <!-- </div> -->
    <!-- end of oferte_content-->
  
