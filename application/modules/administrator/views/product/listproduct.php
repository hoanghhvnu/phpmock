<?php $this->load->view('main/mainhead')?>
<div id = 'center'>
    <h3>List Product </h3>

    <div id = 'modlistbran'>
        <form action = '' method = 'post'>
            <label>Product per page: </label>
            <input class = 'txt' type = 'text' name = 'per_page' value = <?php echo isset($per) ? $per : "" ?>>
            <span>Show all</span><input type = 'checkbox' name = 'show_all' value = 'show'>
            <br/>
            <input type = 'submit' name = 'btnSubmit' value = 'Submit'>
        </form>
    </div>

    <div id = 'listbran'>
      <?php  echo "Trang: ";
                echo isset($link) ? $link : "";  ?>
    <?php
    echo "<table border='1' cellpadding='0' cellspacing='0'>";
        echo "<tr>";
        echo "<td>Product ID</td>";
        echo "<td>Product Name</td>";
        echo "<td>Product Price</td>";
        echo "<td>Product Price Sale</td>";
        echo "<td>Product Image</td>";
        echo "<td>Product Description</td>";
        echo "<td>Product Infomation</td>";
        echo "<td>Product Status</td>";
        echo "<td>Product Brand</td>";
        echo "<td>Product Country</td>";
        echo "</tr>";
        if(isset($listproduct) && $listproduct !=null){
        foreach($listproduct as $list){
            echo "<tr>";
            echo "<td>".$list['pro_id']."</td>";
            echo "<td>".$list['pro_name']."</td>";
            echo "<td>".$list['pro_price']."</td>";
            echo "<td>".$list['pro_price_sale']."</td>";
            echo "<td>".$list['pro_images']."</td>";
            echo "<td>".$list['pro_desc']."</td>";
            echo "<td>".$list['pro_info']."</td>";
            echo "<td>".$list['pro_status']."</td>";
            echo "<td>".$list['bran_id']."</td>";
            echo "<td>".$list['country_id']."</td>";
            echo "</tr>";
        }
    }
    echo "</table>";

    ?>
    </div>
</div> <!-- end div center -->

<?php $this->load->view('main/mainfoot')?>