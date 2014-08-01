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
    <div class="top_search">
      <div class="search_text"><a href="">T&igrave;m ki&#7871;m</a></div>
      <input type="text" class="search_input" name="search" />
      <input type="image" src="http://localhost/phpmock/public/images/search.gif" class="search_bt"/>
    </div>
  </div>
  <div id="header">
    <div id="logo"> <a href="http://localhost/phpmock/default/home/index"><img src="http://localhost/phpmock/public/images/smartosc.jpg" alt="" border="0" width="237" height="140" /></a> </div>
    <div class="oferte_content">

      <!-- show slide der ============================================================================ -->
      <?php //include("sli.php") ?>
      <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/slide.css">
      <script type="text/javascript" src="http://localhost/phpmock/js/jquery-1.11.1.min.js"></script>
      <?php
      if(isset($slider) && ! empty($slider)){
        // print_r($slider);
        echo "<div id='slider'>";
        echo "<a href='#' class='control_next'>></a>";
        echo "<a href='#' class='control_prev'><</a>";
        echo "<ul>";
        foreach ($slider as $key => $value) {
          echo "<li><a href='". base_url("default/product/detailProduct") . "/" . $value['pro_id'] ."'>";
          echo "<img src='" . base_url('uploads/product') ."/" . $value['pro_images'] . "'alt=''>";
          
        }
        
        echo '</ul>';
        echo "</div>";
      }
      
      ?>
      <script src="<?php echo base_url();?>js/slide.js"></script>
      <!-- end slider ================================================================================ -->

    </div>
    <!-- end of oferte_content-->
  </div>
