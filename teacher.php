<?php
require_once 'functions.php';

session_start();
if ($_SESSION['logged_id'] <= 0) {
	header('Location: index.php');
	// echo 'not logged in ';
}


?>
<html>
<head>
	<title>Take attendance - Teacher</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >

	<style>
	body {
		margin: 10%;
	}
	thead tr td {
		font-weight: bold;
	}
	td {
		padding: 10px;
		border: 1px dotted black;
	}
	</style>
</head>
<body>

	<table>
	<?php
		$res = getClasses();
		echo '<thead><tr>' . '<td>Class ID</td>' . '<td>Start Time</td>' . '<td>End Time</td>' . '<td>Credit Hours</td>' . '</tr></thead>' ;
		while ($r = $res->fetch_assoc() ) {
			// var_dump($r);
			echo "<tr><td><a href='class.php?id=" . $r['id'] . "'>". $r['id'] . "</a></td><td>". $r['starttime'] . "</td><td>" . $r['endtime'] . "</td><td>" . $r['credit_hours'] . "</td></tr>" ;
		}
	?>

	</table>

</body>
</html>