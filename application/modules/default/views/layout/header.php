<!DOCTYPE html>
<html>
<head>
<title>Project Nhom 2</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="http://localhost/phpmock/public/style.css" />
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
  <div id="main_content">
    <div id="menu_tab">
      <div class="left_menu_corner"></div>
      <ul class="menu">
        <li><a href="<?php echo base_url();?>default/home/index" class="nav1"> Trang ch&#7911;</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo base_url();?>default/product/listproduct" class="nav2">S&#7843;n ph&#7849;m</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo base_url();?>default/home/index" class="nav3">Điện thoại</a></li>
        <li class="divider"></li>
        <li></li>
        <li class="divider"></li>
        <li><a href="<?php echo base_url();?>default/home/index" class="nav4">Máy tính</a></li>
        <li class="divider"></li>
        <li></li>
        <li class="divider"></li>
        <li><a href="contact.html" class="nav6">Li&ecirc;n h&#7879;</a></li>
        <li class="currencies"></li>
      </ul>
      <div class="right_menu_corner"></div>
    </div>
    <!-- end of menu tab -->