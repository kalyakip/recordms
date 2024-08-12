<?php
include('include/database.php'); // Include database configuration
include('session.php'); // Include session management

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Retrieve client_id from the query string
$get_id = isset($_GET['client_id']) ? $_GET['client_id'] : null;

// Debugging: Print session and client_id
echo '<pre>';
print_r($_SESSION);
echo 'Client ID: ' . htmlspecialchars($get_id);
echo '</pre>';

// Ensure the session is active and ID is valid
if (isset($_SESSION['user_id']) && is_numeric($get_id)) {
    $id_session = $_SESSION['user_id'];

    // Prepare and execute the query to get user information
    $stmt = $connection->prepare("SELECT firstname, lastname FROM user WHERE user_id = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($connection->error));
    }
    $stmt->bind_param("i", $id_session);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result === false) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    $row = $result->fetch_assoc();
    if ($row) {
        $user = $row['firstname'] . ' ' . $row['lastname'];
        
        // Prepare and execute the query to delete the client
        $stmt = $connection->prepare("DELETE FROM client WHERE client_id = ?");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($connection->error));
        }
        $stmt->bind_param("i", $get_id);
        $stmt->execute();
        if ($stmt->affected_rows === 0) {
            die('Delete failed or no rows affected');
        }
        
        // Prepare and execute the query to log the action
        $stmt = $connection->prepare("INSERT INTO history (user, action, client_id) VALUES (?, 'Deleted client', ?)");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($connection->error));
        }
        $stmt->bind_param("si", $user, $get_id);
        $stmt->execute();
        if ($stmt->affected_rows === 0) {
            die('Insert failed or no rows affected');
        }

        // Redirect to the client page
        header("Location: client.php");
        exit; // Ensure no further code is executed
    } else {
        die('User not found');
    }
} else {
    // Handle the case where session is not active or ID is invalid
    die('Invalid session or client ID');
}
?>
