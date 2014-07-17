<h3>Danh sách các thương hiệu</h3>
<head>
    <style type="text/css">
        input{
            width: 50px;
        }
    </style>
</head>
<body>
    <form action = '' method = 'post'>
        <label>Số brand trên 1 trang: </label>
        <input type = 'text' name = 'per_page' value = <?php echo isset($per) ? $per : "" ?>>
        <input type = 'submit' name = 'btnok' value = 'Gửi'>
    </form>

    <?php  echo "Trang: ";
            echo isset($link) ? $link : "";  ?>
    <table border = 1 id = 'listbran'>
        <th>ID</th>
        <th>name</th>
            <?php
                foreach ($listbran as $list) {

                    # code...
                    echo "<tr>";
                        echo "<td>" . $list['bran_id'] . "</td>";
                        echo "<td>" . $list['bran_name'] . "</td>";
                    echo "</tr>";
                } // end foreach $listbran
            ?>
    </table>
    
    <!-- <a href="insertuser">Insert User</a> -->
</body>