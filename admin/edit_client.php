<?php
include('include/database.php');
include('session.php');

if (isset($_POST['submit'])) {
    $id = $_POST['client_id'];
    $school_id = $_POST['school_id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $type = $_POST['type'];
    $department = $_POST['department'];
    $contact = $_POST['contact'];
    
    // Update client
    $stmt = $connection->prepare("UPDATE client SET school_id=?, firstname=?, middlename=?, lastname=?, type=?, department=?, contact=? WHERE client_id=?");
    $stmt->bind_param('isssssi', $school_id, $firstname, $middlename, $lastname, $type, $department, $contact, $id);
    $stmt->execute();

    // Log the action
    $stmt = $connection->prepare("INSERT INTO history (user, action, client_id) VALUES (?, 'Edited client details', ?)");
    $stmt->bind_param("si", $user, $id);
    $stmt->execute();

    // Redirect
    header("Location: client.php");
}
?>
