<div id = 'center'>
    <h3>List Category</h3>
    

     <a  href='<?php echo base_url("administrator/cate/insertCategory");?>'>
                <button >Thêm Category</button></a></br>
    <a  href='<?php echo base_url("administrator/cate/moveCategory");?>'>
               <button >Move Category</button></a>
    <table border = '1'>
        <th>CategoryID</th>
        <th>Category Name</th>
        <th>Category Parent</th>
        <th>Category Order</th>
        <th>Edit</th>
        <th>Delete</th>

        <?php
            foreach ($orderList as $key => $value) :
        ?>
                <tr>
                <td> <?php echo $value['cate_id'] ?></td>
                <td> <?php echo $value['cate_name'] ?></td>
                <td> <?php echo $value['cate_parent'] ?></td>
                <td> <?php echo $value['cate_order'] ?></td>
                <td> <a href = ' <?php echo base_url("/administrator/cate/update/") . "/" . $value["cate_id"] ?>'>
                    <img src="<?php echo base_url('public/images/edit-button.png') ?>" alt=""></a>
                </td>
                <td> <a href = ' <?php echo base_url("/administrator/cate/delete/") . "/" . $value["cate_id"] ?>'>
                    <img src="<?php echo base_url('public/images/delete-button.png') ?>" alt=""></a>
                </td>
                </tr>
        <?php
            endforeach;
        ?>
    </table>
</div>
