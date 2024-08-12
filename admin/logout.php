<?php
include('include/database.php');
include('session.php');

// session_start();

// Get user information from the session
$user_id = $_SESSION['user_id']; // Make sure session variable 'user_id' is set

// Fetch user details
$logout_query = $connection->prepare("SELECT * FROM user WHERE user_id = ?");
$logout_query->bind_param("i", $user_id);
$logout_query->execute();
$result = $logout_query->get_result();
$row = $result->fetch_assoc();

$user = $row['firstname'] . " " . $row['lastname'];

// Destroy the session
session_destroy();

// Log the logout action
$log_query = $connection->prepare("INSERT INTO history (date, action, data) VALUES (NOW(), 'Logout', ?)");
$log_query->bind_param("s", $user);
$log_query->execute();

// Redirect to index page
header('Location: index.php');
exit();
?>
