<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WEB BÁN HÀNG</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/Day1/public/category/css/style.css" />
</head>
<body>
	<div id="banner">&nbsp;</div>
    <div id="menu"><h1>Trang quản lý</h1></div>
    <div id="main">
    	<div id="left">
        	<div class="category">
            	<h1>MENU CHỨC NĂNG</h1>
                <ul>
    	        	<li><a href="http://localhost/Day1/administrator/user/listuser">Quản lý thành viên</a></li>
                    <li><a href="http://localhost/Day1/administrator/category/listcategory">Quản lý category</a></li>
					<li><a href="http://localhost/Day1/administrator/bran/listbran">Quản lý Bran</a></li>
                    <li><a href="#">Quản lý sản phẩm</a></li>
	            </ul>
            </div>
            <div class="category" style="margin-top:10px; border-top:1px solid #CCC; background:#FFF;">
            	<p>Chào bạn: admin</p>
                <p><a href="#">Đăng xuất tài khoản</a></p>
            </div>
        </div>
		<div id="center">
        		<h1>Update category</h1>
                <form action="" method="post">
                	<label>Tên category</label>
                   	<input type="text" name="cate_name" value="<?php echo $categoryInfo['cate_name']; ?>" size="30" />
                    <?php echo form_error("cate_name"); ?>
                    <?php echo isset($errorName) ? $errorName : ""; ?>
                    <br />  

                   	<label>Thứ tự category</label>
                   	<input type="text" name="cate_order" value="<?php echo $categoryInfo['cate_order']; ?>" size="30" />
                    <?php echo form_error("cate_order"); ?>
                    <br />  
            <p>
                    <label>Category cha</label>
                    <select class="input-short" name="cate_parent" multiple="true">
                        <option value="0" <?php if($categoryInfo['cate_parent'] == 0){echo "selected='selected'";}?>> 
                        Menu gốc </option>
                        
                        <?php 
                        foreach($showCategory as $key=>$value)
                        { ?>
                        <option value="<?php echo $value['cate_id']; ?>" 
                      
                        <?php if($categoryInfo['cate_parent'] == $value['cate_id']){echo "selected='selected'";}?>>
                        
                        <?php echo $value['cate_name']; ?></option>
                        <?php } ?>
                    </select>
                    <br />
                    <?php 
                    
                        if(isset($errorTrung) && $errorTrung != ""){
                            echo $errorTrung;
                        }
                    ?>
                </p>
    <br />
                    <label>&nbsp;</label> 
                    <input type="submit" name="ok" value="Update" />
                    <input type="reset" value="Reset" />                                  
                </form>
        </div>
    </div>
    <div id="footer">
    	Training PHP Project 
    </div>
</body>
</html>
