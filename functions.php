<?php

function connect () {
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "attendance";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	return $conn;
}

function login() {
    $conn = connect();

	$email = addslashes($_POST['email']);
	$password = addslashes($_POST['password']);

	$query = "SELECT * FROM user WHERE email = '" . $email . "' AND password= '" . $password . "'; ";
	// $result = mysqli_query($conn, $query);
    // var_dump($conn);
    $result = $conn->query($query);
    $user = mysqli_fetch_row($result);
    // $user = mysqli_fetch_array($result);

    var_dump($user);

    echo $user[1];
    // $user = mysql_fetch_assoc($result);

    return $user;
}

function saveTweet() {
	$text = addslashes($_POST['text']);
	$email = addslashes($_POST['email']);

	$query = "INSERT INTO tweet(email, text, created_at) VALUES ('" . $email . "', '" . $text . ", NOW() '); ";
	mysqli_query($conn, $query);

}



function getClasses() {

	$conn = connect();
	// $email = addslashes($_GET['email']);
	$teacher_id = $_SESSION['user'][0];

	// $query = "SELECT text FROM tweet WHERE email = " . $email;
	$query = "SELECT * FROM class WHERE teacherid = " . $teacher_id;
	$result = mysqli_query($conn, $query);

	// echo json_encode($result);
	return $result;
}

function class($id) {

	$conn = connect();
	// $email = addslashes($_GET['email']);
	$teacher_id = $_SESSION['user'][0];

	// $query = "SELECT text FROM tweet WHERE email = " . $email;
	$query = "SELECT * FROM attendance WHERE classid = " . $id;
	$result = mysqli_query($conn, $query);

	// echo json_encode($result);
	return $result;
}


function loggedin($who, $user) 
{
	// user has logged in
	// keep track in header
	
	if ($who == 'teacher' || $who == 'student') {
		$_SESSION['who'] = $who;
		$_SESSION['logged_id'] = $user[0];
		$_SESSION['user'] = $user;
	}

	if ($who == 'teacher') {
		header('Location: teacher.php');
	}
	else if ($who == 'student') {
		header('Location: student.php');
	}
}

function isLoggedin() {
	return $_SESSION['logged_id'] > 0;
}