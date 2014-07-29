<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>


<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="<?php echo base_url("public/images/slider/example-slide-1.jpg"); ?>" alt="...">
      <div class="carousel-caption">
        <h1>slide 01</h1>
      </div>
    </div>
    <div class="item">
      <img src="<?php echo base_url("public/images/slider/example-slide-2.jpg"); ?>" alt="...">
      <div class="carousel-caption">
        <h1>slide 02</h1>
      </div>
    </div>
    <div class="item">
      <img src="<?php echo base_url("public/images/slider/example-slide-3.jpg"); ?>" alt="...">
      <div class="carousel-caption">
        <h1>slide 03</h1>
      </div>
    </div>
  
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>

  <script type="text/javascript">
  $('.carousel').carousel({
    interval: 2000
  })
  </script>
</div>