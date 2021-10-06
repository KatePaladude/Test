<?php
$mysqli = new mysqli("localhost", "root", "", "test") or die ("Error");

if(!isset($_GET['page'])) $page = 1; else $page = htmlspecialchars($_GET['page']);
if(ctype_digit($page) === false) $page = 1;


$table = "ads";
$count_query = $mysqli->query("SELECT COUNT(*) FROM $table");
$count_array = $count_query->fetch_array(MYSQLI_NUM);
$count = $count_array[0];
$limit = 10;
$start = ($page*$limit)-$limit;
$length = ceil($count/$limit);

if((int)$page > $length || $page <= 0) $start = 0;
$query = $mysqli->query("SELECT * FROM $table ORDER BY id DESC LIMIT $start, $limit");

	function Pagination($length, $page){
		

		if($length < 5) foreach(range(1, $length) as $p) echo '<a href="project.php?page='.$p.'">'.$p.'</a> ';

		if($length > 4 && $page < 5) foreach(range(1, 5) as $p) echo '<a href="project.php?page='.$p.'">'.$p.'</a> ';

		if($length - 5 < 5 && $page > 5 && $length - 5 > 0) foreach(range($length - 4, $length) as $p) echo '<a href="project.php?page='.$p.'">'.$p.'</a> ';

		if($length > 4 && $length - 5 < 5 && $page == 5) foreach(range($page-2, $length) as $p) echo '<a href="project.php?page='.$p.'">'.$p.'</a> ';

		if($length > 4 && $length-5 > 5 && $page >=5 && $page <= $length-4) foreach(range($page-2, $page+2) as $p) echo '<a href="project.php?page='.$p.'">'.$p.'</a> ';

		if($length > 4 && $length-5 > 5 && $page > $length-4) foreach(range($length-4, $length) as $p) echo '<a href="project.php?page='.$p.'">'.$p.'</a> ';
	}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Pagination</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<?php 
	Pagination($length, $page);
	while($row = $query->fetch_assoc()) echo '<h1>'.$row["name"].' '.$row["price"].' ' .$row["photo"].'</h1>';  
	Pagination($length, $page);
?>
</body>
</html>
