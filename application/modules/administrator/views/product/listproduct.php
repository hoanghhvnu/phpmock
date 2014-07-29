
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
    <div style="clear:both;margin:5px;padding: 5px">
    <a  href='<?php echo base_url("administrator/product/searchproduct");?>'>
                <button >Search Product</button></a><br/>
    <a  href='<?php echo base_url("administrator/product/insertProduct");?>'>
                <button >Insert Product</button></a>        

    </div>
    

    <div id = 'listproduct'>
      <?php  echo "Trang: ";
                echo isset($link) ? $link : "";  ?>
    
    <table border='1' cellpadding='0' cellspacing='0'>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Image</th>
        <th>Price</th>
        <th>Price Sale</th>
        
        <th>Description</th>
        <th>Infomation</th>
        <th>Status</th>
        <th>Brand</th>
        <th>Country</th>
        <th>Edit</th>
        <th>Delete</th>

        </tr>
        <?php
        $ListBrandKeyValue = array();
        foreach ($ListBrand as $key => $value) {
            $ListBrandKeyValue[$value['bran_id']] = $value['bran_name'];
        }
        // print_r($ListBrandKeyValue);
        $ListCountryKeyValue = array();
        foreach ($ListCountry as $key => $value) {
            $ListCountryKeyValue[$value['coun_id']] = $value['coun_name'];
        }

        $Status = array(
            '1' => "Active",
            '2' => "Deactive"
            );
        if(isset($listproduct) && $listproduct !=null){
            foreach($listproduct as $list){
                echo "<tr>";
                echo "<td>".$list['pro_id']."</td>";
                echo "<td>".$list['pro_name']."</td>";
                echo "<td>". "<img width= 90 height = 140 src='" . base_url("uploads/product") . "/" . $list['pro_images']."'></td>";
                echo "<td>".$list['pro_price']."</td>";
                echo "<td>".$list['pro_price_sale']."</td>";
                
                echo "<td>".$list['pro_desc']."</td>";
                echo "<td>".$list['pro_info']."</td>";
                echo "<td>".$Status[$list['pro_status']]."</td>";
                echo "<td>".$ListBrandKeyValue[$list['bran_id']]."</td>";
                echo "<td>".$ListCountryKeyValue[$list['country_id']]."</td>";
                echo "<td><a href = '" . base_url("/administrator/product/update/") . "/" . $list['pro_id'] . "'>Edit</a></td>";
                echo "<td><a href = '" . base_url("/administrator/product/delete/") . "/" . $list['pro_id'] . "'>Delete</a></td>";
                echo "</tr>";
            } // end foreach
        } // end if
        ?>
    </table>

    
    </div><!--  end div id=listproduct -->
</div> <!-- end div center -->

