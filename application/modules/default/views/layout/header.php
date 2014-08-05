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

<script type="text/javascript" src="http://localhost/phpmock/js/jssor.core.js"></script>
<script type="text/javascript" src="http://localhost/phpmock/js/jssor.utils.js"></script>
<script type="text/javascript" src="http://localhost/phpmock/js/jssor.slider.js"></script>

<script>
jQuery(document).ready(function ($) {
	var options = {
		$AutoPlay: true, //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
		$AutoPlaySteps: 1, //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
		$AutoPlayInterval: 0, //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
		$PauseOnHover: 1, //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 1
		
		$ArrowKeyNavigation: true, //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
		$SlideEasing: $JssorEasing$.$EaseLinear, //[Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad
		$SlideDuration: 3000, //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
		$MinDragOffsetToSlide: 20, //[Optional] Minimum drag offset to trigger slide , default value is 20
		$SlideWidth: 30, //[Optional] Width of every slide in pixels, default value is width of 'slides' container
		$SlideHeight: 29, //[Optional] Height of every slide in pixels, default value is height of 'slides' container
		$SlideSpacing: 0, //[Optional] Space between each slide in pixels, default value is 0
		$DisplayPieces: 7, //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
		$ParkingPosition: 0, //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
		$UISearchMode: 1, //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
		$PlayOrientation: 1, //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
		$DragOrientation: 1 //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
	};

	var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
	function ScaleSlider() {
		var bodyWidth = document.body.clientWidth;
		if (bodyWidth)
			jssor_slider1.$SetScaleWidth(Math.min(bodyWidth, 980));
		else
			window.setTimeout(ScaleSlider, 30);
		}

		ScaleSlider();

		if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
			$(window).bind('resize', ScaleSlider);
		}


            //if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
            //    $(window).bind("orientationchange", ScaleSlider);
            //}
            //responsive code end
        });
    </script>
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
  
