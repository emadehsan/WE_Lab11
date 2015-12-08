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



function getTweets($conn) {
	$email = addslashes($_GET['email']);

	$query = "SELECT text FROM tweet WHERE email = " . $email;
	$result = mysqli_query($conn, $query);

	return json_encode($result);
}
