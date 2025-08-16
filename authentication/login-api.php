<?php
// This is the single most important line for any login system.
session_start();

header('Content-Type: application/json');
require_once '../db/db_connection.php'; 

$response = ['status' => 'error', 'message' => 'An unknown error occurred.'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $response = ['status' => 'error', 'message' => 'Username and password are required.'];
        echo json_encode($response);
        exit();
    }

    // Prepare a statement to prevent SQL Injection
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($password, $user['password'])) {
            // Password is correct, start the session
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            $response = ['status' => 'success', 'message' => 'Login success'];
        } else {
            // Incorrect password
            $response = ['status' => 'error', 'message' => 'Invalid username or password.'];
        }
    } else {
        // No user found with that username
        $response = ['status' => 'error', 'message' => 'Invalid username or password.'];
    }
    $stmt->close();
}

$conn->close();
echo json_encode($response);