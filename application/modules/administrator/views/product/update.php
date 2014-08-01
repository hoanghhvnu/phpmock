
		<div id="center">
        		<h1>Update product</h1>
                <form action="" method="post" enctype="multipart/form-data">
                	<label>Tên sản phẩm</label>
                   	<input type="text" name="pro_name" value="<?php echo $productInfo['pro_name']; ?>" size="30" />
                    <?php echo form_error("pro_name"); ?>
                    <?php echo isset($errorName) ? $errorName : ""; ?>
                    <br />
                	<label>Giá</label>
                    <input type="text" name="pro_price" value="<?php echo $productInfo['pro_price']; ?>" size="30" />
                    <?php echo form_error("pro_price"); ?>
                    
                    <br />
                	<label>Giá khuyến mại</label>
                    <input type="text" name="pro_price_sale" value="<?php echo $productInfo['pro_price_sale']; ?>" size="30" />
                    <?php echo form_error("pro_price_sale"); ?>
                    <br />

                    <?php
                            if($productInfo['pro_images'] != null ) {
                                echo "<img src='/phpmock/uploads/product/".$productInfo['pro_images']."' width='100' />";
                            }
                    ?>
                    <br />
                    <br />
                    <label>Ảnh đại diện</label>
                    <input type="file" name="pro_images" id="file" />
                   
                    <br />
                    <br />
                    <br />
                   	<label>Mô tả sản phẩm</label>
                    <textarea name="pro_desc"><?php echo $productInfo['pro_desc']; ?></textarea>
                    
                    <?php echo form_error("pro_desc"); ?>
                    <br />   
                   	<label>Thông tin sản phẩm</label>
                    <textarea name="pro_info"><?php echo $productInfo['pro_info']; ?></textarea>
                
                    <?php echo form_error("pro_info"); ?>
                    <br />
                   	<label>Số lượng</label>
                    <input type="text" name="pro_quantity" value="<?php echo $productInfo['pro_quantity']; ?>" size="30" />
                    <?php echo form_error("pro_quantity"); ?>
                    <br /> 
                    
                    <label>Trạng thái sản phẩm</label>
                    Active&nbsp;<input type="radio" name="pro_status" value="1" <?php if($productInfo['pro_status'] == 1 ) { echo "checked='checked'"; } ?> />
                    Disable&nbsp;<input type="radio" name="pro_status" value="2" <?php if($productInfo['pro_status'] == 2 ) { echo "checked='checked'"; } ?> /> 
                    <?php echo form_error("pro_status"); ?>
                    <br />
                    <br />
                    <br />
                    <label>Category</label>
                    <br /> <br />
                    <div class="category_list">
                     <?php 
                            $stt = 1;

                            foreach($listCategory as $key=>$val){
                                if(in_array($val['cate_id'],$listCateid)) {
                                    $checked = "checked='checked'";
                                }else{
                                    $checked = "";
                                }
                                
                              $name = '<input '.$checked.' type="checkbox" name="category[]" value="'.$val['cate_id'].'" /> '.$val['cate_name'];
                                   
                              
                                echo $name;
                                 echo "<br>";
                            }
                    ?>     
                    </div> 
                    <?php echo isset($error['errorCategory']) ? $error['errorCategory'] : ""; ?>  

                    <?php echo isset($error['errorCategory']) ? $error['errorCategory'] : ""; ?> 
                    <br />
                    <br />
                    <label>Nhãn hàng</label>
                        <select style="width: 150px;" name="bran_id">
                                <option value="">Select bran</option>
                                <?php if(isset($bran) && $bran != null) {
                                    foreach($bran as $listBran) {
                                        if($productInfo['bran_id'] == $listBran['bran_id']) {
                                            $selected = "selected='selected'";
                                        }else{
                                            $selected = "";
                                        }
                                        echo "<option $selected value='".$listBran['bran_id']."'>".$listBran['bran_name']."</option>";    
                                    }} 
                                ?>
                    </select>  
                    <br />
                    
                    <label>Xuất xứ</label>
                        <select style="width: 150px;" name="country_id">
                                <option value="">Select country</option>
                                <?php if(isset($country) && $country != null) {
                                    foreach($country as $listCountry) {
                                        if($productInfo['country_id'] == $listCountry['coun_id']) {
                                            $selected = "selected='selected'";
                                        }else{
                                            $selected = "";
                                        }
                                        echo "<option $selected value='".$listCountry['coun_id']."'>".$listCountry['coun_name']."</option>";    
                                    }} 
                                ?>
                    </select>  
                    <br />
                    <br />
                    <label>ảnh thêm</label>
                    <br />
                    <br />
                    <?php 
                    if(isset($listImages) && $listImages != null) {
                                    foreach($listImages as $val) {
                                        echo "<div>";

                                        echo "<img src='/phpmock/uploads/product/".$val['img_name']."' width='100' />";
                                         echo "<input type='file' name='image".$val['img_id']."' value='' />";
                                        
                                        echo "<a class='delete' href='/phpmock/administrator/product/deleteimages/".$val['img_id']."'>Delete</a>";
                                        echo "<br>";
                                        echo "<br>";
                                        echo "</div>";
    
                                    }
                           }
                    
                    
					
					for ($i=1;$i<=$numimg;$i++) {															
                    ?>
                    <br /> <br /> 
                    <label>Thêm ảnh</label> 
                    <input type="file" name="file<?php echo $i; ?>" id="file" /> 
                    <br />
                    <?php 
                    }
                    ?>
                    
                    

                    <label>&nbsp;</label> 
                    <input type="submit" name="ok" value="Update" />
                    <input type="reset" value="Reset" />                                  
                </form>
        </div>
    </div>
    