<?php
session_start();

header('Content-Type: application/json');
require_once '../db/db_connection.php'; 

$response = ['status' => 'error', 'message' => 'An unknown error occurred.'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = strtolower(trim($_POST['username'] ?? ''));
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $response = ['status' => 'error', 'message' => 'Username and password are required.'];
        echo json_encode($response);
        exit();
    }

    // Check login from user_accounts
    $stmt = $conn->prepare("SELECT id, username, password, user_type FROM user_accounts WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Store session data
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_type'] = $user['user_type'];

            // Decide dashboard URL based on role
            if ($user['user_type'] === 'admin') {
                $dashboard = '../layouts/admin/admin_dashboard.php';
            } elseif ($user['user_type'] === 'employee') {
                $dashboard = '../layouts/employee/employee_dashboard.php';
            } else {
                $dashboard = '../layouts/user/user_dashboard.php';
            }

            $response = [
                'status' => 'success',
                'message' => 'Login successful',
                'redirect' => $dashboard
            ];
        } else {
            $response = ['status' => 'error', 'message' => 'Invalid username or password.'];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Invalid username or password.'];
    }

    $stmt->close();
}

$conn->close();
echo json_encode($response);
