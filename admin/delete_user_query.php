<?php 

include('include/database.php');
include('session.php');

$get_id=$_GET['user_id'];

$history_record=mysqli_query("select * from user where user_id=$id_session");
$row=mysqli_fetch_array($history_record);
$user=$row['firstname']." ".$row['lastname'];
mysqli_query("INSERT INTO history (date,action,data) VALUES (NOW(),'Delete User','$user')")or die(mysqli_error());

mysqli_query("delete from user where user_id = '$get_id' ")or die(mysqli_error());

header('location:user.php');
?>a<?php
include('include/database.php');
include('session.php');

$get_id = $_GET['user_id'];

// Ensure the session is active and ID is valid
if (isset($id_session) && is_numeric($get_id)) {
    $stmt = $connection->prepare("SELECT firstname, lastname FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $id_session);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $user = $row['firstname'] . ' ' . $row['lastname'];
    
    // Delete user
    $stmt = $connection->prepare("DELETE FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $get_id);
    $stmt->execute();
    
    // Log the action
    $stmt = $connection->prepare("INSERT INTO history (user, action, user_id) VALUES (?, 'Deleted user', ?)");
    $stmt->bind_param("si", $user, $get_id);
    $stmt->execute();

    // Redirect
    header("Location: users.php");
}
?>
