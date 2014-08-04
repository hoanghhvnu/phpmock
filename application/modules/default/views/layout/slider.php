
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/bootstrap.min.css"); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("public/css/defaultStyle.css"); ?>">
  <script src= '<?php echo base_url("js/bootstrap.min.js"); ?>'></script>
  <script>
  $(document).ready(function(){
    $('.carousel').carousel({
      interval: 2000
    })
  });
  </script>


<div id="slider" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <?php
        /**
         * $SliderData has infomation of slider: images link and product_id
         * @var integer
         */
        
        if(isset($SliderData) && ! empty($SliderData)){
          $length = count($SliderData);
          for ($i = 0; $i < $length; $i ++){
            echo "<li data-target='#carousel-example-generic' data-slide-to='";
            echo $i;
            
            echo "' ";
            if ($i == 0) echo " class='active'";
            echo " ></li>";
          } // end for $i
        } // end if isset
    ?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <?php 
        if(isset($SliderData) && ! empty($SliderData)){
          $i = 0;
          foreach ($SliderData as $key => $value) :
    ?>
              <div class="item <?php if ($i == 0) echo ' active' ?>">
                <a href=' <?php echo base_url("default/product/detailProduct") . "/" . $value['pro_id'] ?>'>
                    <img src="<?php echo base_url('uploads/product') . '/' .  $value['pro_images'];?>">
                </a>
                
                <div class="carousel-caption">
                  <?php echo $value['pro_images']; ?>
                </div>
              </div>
    <?php
          $i++;
          endforeach;
        } // end if isset
    ?>
    
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>