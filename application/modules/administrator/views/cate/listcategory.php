<div id = 'center'>
    <h3>List Category</h3>
    <table border = '1'>
    <th>CategoryID</th>
    <th>Category Name</th>
    <th>Category Parent</th>
    <th>Category Order</th>
    <th>Edit</th>
    <th>Delete</th>

    <?php
        // echo "<pre>";
        // print_r($orderList);
        foreach ($orderList as $key => $value){
            echo "<tr>";
            echo "<td>" . $value['cate_id'] . "</td>";
            echo "<td>" . $value['cate_name'] . "</td>";
            echo "<td>" . $value['cate_parent'] . "</td>";
            echo "<td>" . $value['cate_order'] . "</td>";
            echo "<td><a href = '" . base_url("/administrator/cate/update/") . "/" . $value['cate_id'] . "'>Edit</a></td>";
            echo "<td><a href = '" . base_url("/administrator/cate/delete/") . "/" . $value['cate_id'] . "'>Delete</a></td>";
            echo "</tr>";
        } // end foreach
    ?>
    </table>
</div>
