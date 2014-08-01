<h3>Search Result</h3>
<?php

/**
 * @author easyvn.net
 * @copyright 2014
 */
 echo "<table border='1' cellpadding='0' cellspacing='0'>";
 // echo "<tr>";
 echo "<th> Brand ID </th>";
 echo "<th> Brand Name </th>";
 echo "<th> Edit </th>";
 echo "<th> Delete </th>";
 // echo "</tr>";
 if(isset($result) && $result != null){ 
    foreach($result as $list){
        echo "<tr>";
        echo "<td>".$list['bran_id']."</td>";
        echo "<td>".$list['bran_name']."</td>";
        echo "<td>" . "<a href = '" . base_url("administrator/bran/update") . "/" . $list['bran_id'] . "'>Edit</a>". "</td>";
        echo "<td>" . "<a href = '" . base_url("administrator/bran/delete") . "/" . $list['bran_id'] . "'>Delete</a>". "</td>";
        echo "</tr>";
}
} else {
    echo "<td colspan='2'>Không tìm thấy </td>";
}
echo "</table>";


?>