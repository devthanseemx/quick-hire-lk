<?php
// Start session to access verification data
session_start();

// Check if an employee/admin has been verified
$user_type = $_SESSION['user_type'] ?? 'user'; // Default to 'user'
$verified_id = $_SESSION['verified_id'] ?? null;

// Important: Clear the session variables after reading them to prevent misuse
unset($_SESSION['verified_id']);
unset($_SESSION['user_type']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - QuickHire LK </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body class="m-0 p-2 h-screen box-border flex gap-8 bg-white">

    <!-- Left Image Side -->
    <div class="hidden md:block w-1/2 h-full overflow-hidden rounded-xl">
        <img src="../assets/images/signup-image.png" alt="Office Background" class="w-full h-full object-cover" />
    </div>

    <!-- Right Form Side -->
    <div class="w-full md:w-1/2 h-full flex items-center">
        <div class="w-full max-w-md mx-auto">
            <h2 class="text-3xl font-bold mb-3 text-center">Sign Up</h2>
            <p class="text-gray-500 custom-margin text-center">
                <?php
                // Display a custom message for verified users
                if ($user_type === 'employee' || $user_type === 'admin') {
                    echo "Your ID has been verified. Please create your account.";
                } else {
                    echo "Fill the form below to create your account ";
                }
                ?>
            </p>

            <form id="registration-form" action="register-api.php" method="POST" novalidate>

                <input type="hidden" name="user_type" value="<?php echo htmlspecialchars($user_type); ?>">

                <div class="mb-5">
                    <label for="full-name" class="block mb-1 text-sm font-medium text-gray-700">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-person text-gray-400"></i>
                        </div>
                        <input type="text" id="full-name" name="full-name" class="w-full pl-10 pr-4 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <p id="fullname-error" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>

                <div class="mb-5">
                    <label for="username" class="block mb-1 text-sm font-medium text-gray-700">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-at text-gray-400"></i>
                        </div>
                        <input type="text" id="username" name="username" class="w-full pl-10 pr-4 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <p id="username-error" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>

                <div class="mb-5">
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-envelope text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email" class="w-full pl-10 pr-4 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>
                    <p id="email-error" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>

                <div class="mb-5">
                    <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-shield-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" class="w-full pl-10 pr-10 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="bi bi-eye text-gray-400 hover:text-gray-600 cursor-pointer" id="togglePassword"></i>
                        </div>
                    </div>
                    <p id="password-error" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>

                <button type="submit" class="mt-6 w-full bg-indigo-600 text-white py-3 rounded-md hover:bg-indigo-700 transition font-semibold">
                    Sign Up
                </button>
            </form>

            <hr class="my-8" />
            <p class="mt-6 text-sm text-center text-gray-500">
                Already have an account?
                <a href="login.php" class="text-indigo-600 hover:underline font-medium">Sign in</a>
            </p>
        </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="../assets/js/toast-notifications.js"></script>
    <script src="../assets/js/registration-validation.js"></script>
</body>

</html>