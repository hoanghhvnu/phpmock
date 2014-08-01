<ul>
    <?php
        foreach($listProduct as $infoProduct){
    ?>
    <li style="margin-left:10px;">
   	    <h3><a href="<?php echo base_url("default/home/detail/".$infoProduct['pro_id']); ?>"><?php echo $infoProduct['pro_name']; ?></a></h3>
        <img src="<?php echo base_url() ?>/public/default/images/product.jpg" class="product" />
        <p>Ðon giá: <?php echo number_format($infoProduct['pro_price'],0) ?></p>
        <a href="#" class="cart"><img src="<?php echo base_url() ?>/public/default/images/giohang.jpg" />Ðặt hàng</a>
    </li>
    <?php } ?>
</ul>
     