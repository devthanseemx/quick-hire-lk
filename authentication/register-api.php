<?php
session_start();
header('Content-Type: application/json');

require_once '../db/db_connection.php'; 

$response = ['status' => 'error', 'message' => 'An unknown error occurred.'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Normalize input for case-insensitivity
    $fullName = trim($_POST['full-name'] ?? '');
    $username = strtolower(trim($_POST['username'] ?? ''));
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $user_type = $_POST['user_type'] ?? 'user';

    // --- Check if Username exists ---
    $stmt_user = $conn->prepare("SELECT id FROM user_accounts WHERE username = ?");
    $stmt_user->bind_param("s", $username);
    $stmt_user->execute();
    $stmt_user->store_result();
    
    if ($stmt_user->num_rows > 0) {
        $response = ['status' => 'error', 'message' => 'This username is already taken.'];
    } else {
        // --- Check if Email exists ---
        $stmt_email = $conn->prepare("SELECT id FROM user_accounts WHERE email = ?");
        $stmt_email->bind_param("s", $email);
        $stmt_email->execute();
        $stmt_email->store_result();
        
        if ($stmt_email->num_rows > 0) {
            $response = ['status' => 'error', 'message' => 'This email address is already registered.'];
        } else {
            // --- Insert into `user_accounts` ---
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql_insert_account = "INSERT INTO user_accounts (full_name, username, email, password, user_type) VALUES (?, ?, ?, ?, ?)";
            
            if ($stmt_insert_account = $conn->prepare($sql_insert_account)) {
                $stmt_insert_account->bind_param("sssss", $fullName, $username, $email, $hashedPassword, $user_type);
                
                if ($stmt_insert_account->execute()) {
                    $new_user_account_id = $stmt_insert_account->insert_id;
                    $role_insert_success = true;

                    // --- Handle roles ---
                    if ($user_type === 'employee' || $user_type === 'admin') {
                        if (!isset($_SESSION['verified_id'])) {
                            $role_insert_success = false; 
                            $response = ['status' => 'error', 'message' => 'Verification required for employee/admin.'];
                        } else {
                            $verified_id = $_SESSION['verified_id'];
                            if ($user_type === 'employee') {
                                $stmt_role = $conn->prepare("INSERT INTO employees (user_account_id, employee_id_ref) VALUES (?, ?)");
                            } else { // admin
                                $stmt_role = $conn->prepare("INSERT INTO admins (user_account_id, admin_id_ref) VALUES (?, ?)");
                            }
                            $stmt_role->bind_param("is", $new_user_account_id, $verified_id);
                            if (!$stmt_role->execute()) {
                                $role_insert_success = false;
                            }
                            $stmt_role->close();
                            unset($_SESSION['verified_id']);
                        }
                    } elseif ($user_type === 'user') {
                        // Insert into users table as well
                        $stmt_role = $conn->prepare("INSERT INTO users (user_account_id) VALUES (?)");
                        $stmt_role->bind_param("i", $new_user_account_id);
                        if (!$stmt_role->execute()) {
                            $role_insert_success = false;
                        }
                        $stmt_role->close();
                    }

                    if ($role_insert_success) {
                        $response = ['status' => 'success', 'message' => 'Registration successful!'];
                    } else {
                        $response = ['status' => 'error', 'message' => 'Account created, but role profile failed. Please contact support.'];
                    }
                } else {
                    // Generic error, no DB error exposure
                    $response = ['status' => 'error', 'message' => 'A server error occurred creating the account.'];
                }
                $stmt_insert_account->close();
            } else {
                $response = ['status' => 'error', 'message' => 'A server error occurred preparing the account statement.'];
            }
        }
        $stmt_email->close();
    }
    $stmt_user->close();
}

$conn->close();

echo json_encode($response);
