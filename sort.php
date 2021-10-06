<?php
$mysqli = new mysqli("localhost", "root", "", "test") or die ("Error");

if(isset($_GET['order'])){
    $order = $_GET['order'];
}else{
    $order = 'price';
}

if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
} else{
    $sort = 'ASC';
}

$resultSet = $mysqli->query("SELECT * FROM ads ORDER BY $order $sort");

if($resultSet->num_rows >6){
    
    $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC';
    
    echo"
    <table border='1'>
        <tr>
            <th>Name</th> 
            <th><a href='?order=price&&sort=$sort'>Price</a></th>
            <th><a href='?order=created_at&&sort=$sort'>Date</a></th>
    ";
    while($rows = $resultSet->fetch_assoc())
    {
        $name=$row['name'];
        $price=$row['price'];
        $date=$row['created_at'];
         echo"
         <tr>
            <td>$name</td>
            <td>$price</td>
            <td>$date</td>
            </tr>
         ";
    }
    echo"
    </table>
    ";
    
}else{
    echo "Error";
}

?>
