<?php
// Start the session to pass data securely to the registration page
session_start();

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../db/company_db_connection.php'; // Use the company DB connection

    $provided_id = strtoupper(trim($_POST['verification_id']));
    $user_type = null;
    $is_valid = false;

    // Determine user type from ID prefix and check the corresponding table
    if (strpos($provided_id, 'EMP') === 0) {
        $user_type = 'employee';
        $stmt = $company_conn->prepare("SELECT employee_id FROM employees WHERE employee_id = ?");
    } else if (strpos($provided_id, 'ADM') === 0) {
        $user_type = 'admin';
        $stmt = $company_conn->prepare("SELECT admin_id FROM admins WHERE admin_id = ?");
    } else {
        $error_message = "Invalid ID format. Please use 'EMP...' or 'ADM...'.";
    }

    if (isset($stmt)) {
        $stmt->bind_param("s", $provided_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $is_valid = true;
        }
        $stmt->close();
    }
    
    $company_conn->close();

    if ($is_valid) {
        // ID is valid. Store it and the user type in the session.
        $_SESSION['verified_id'] = $provided_id;
        $_SESSION['user_type'] = $user_type;
        
        // Redirect to the registration page
        header("Location: register.php");
        exit();
    } else {
        if (empty($error_message)) {
            $error_message = "The provided ID was not found. Please check and try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Verification</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Your Tailwind CSS -->
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-10 rounded-xl shadow-lg w-full max-w-sm">
        <h2 class="text-2xl font-bold text-center mb-2">Verify Your ID</h2>
        <p class="text-gray-500 text-center mb-6">Please enter your Employee or Admin ID to proceed.</p>

        <?php if (!empty($error_message)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-center mb-4" role="alert">
                <span><?php echo htmlspecialchars($error_message); ?></span>
            </div>
        <?php endif; ?>

        <form action="verify-id.php" method="POST">
            <div class="mb-4">
                <label for="verification_id" class="block mb-1 text-sm font-medium text-gray-700">Verification ID</label>
                <input type="text" id="verification_id" name="verification_id" placeholder="e.g., EMP12345" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-2 rounded-md hover:bg-indigo-700 transition">
                Verify & Proceed
            </button>
        </form>
         <p class="mt-8 text-sm text-center text-gray-500">
            Are you a general user? 
            <a href="register.php" class="text-indigo-600 hover:underline">Register here</a>
        </p>
    </div>
</body>
</html>