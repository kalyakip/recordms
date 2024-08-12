<?php
include('include/database.php');
include('session.php');

$get_id = $_GET['item_id'];

// Ensure the session is active and ID is valid
if (isset($id_session) && is_numeric($get_id)) {
    $stmt = $connection->prepare("SELECT firstname, lastname FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $id_session);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $user = $row['firstname'] . ' ' . $row['lastname'];
    
    // Delete item
    $stmt = $connection->prepare("DELETE FROM items WHERE item_id = ?");
    $stmt->bind_param("i", $get_id);
    $stmt->execute();
    
    // Log the action
    $stmt = $connection->prepare("INSERT INTO history (user, action, item_id) VALUES (?, 'Deleted item', ?)");
    $stmt->bind_param("si", $user, $get_id);
    $stmt->execute();

    // Redirect
    header("Location: items.php");
}
?>
