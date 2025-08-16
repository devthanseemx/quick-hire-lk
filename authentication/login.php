<?php
// Start the session to check if the user is already logged in
session_start();

// If the user is already logged in, redirect them to the dashboard
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  header("Location: ../layouts/user/user-dashboard.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <!-- Tailwind CSS File or CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- Toastify Library CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body class="m-0 h-screen box-border flex flex-row-reverse gap-8 bg-white">

  <!-- Left Image Side -->
  <div class="hidden md:block w-1/2 h-full overflow-hidden ">
    <img src="../assets/images/login-bg.jpg" alt="Login Background" class="w-full h-full object-cover" />
  </div>

  <!-- Right Form Side -->
  <div class="w-full md:w-1/2 h-full flex items-center">
    <div class="w-full max-w-md mx-auto">
      <h2 class="text-3xl font-bold mb-3">Login</h2>
      <p class="text-gray-500 mb-10">Please enter your details to login</p>

      <form id="login-form" action="login-api.php" method="POST" novalidate>
        <div class="mb-5">
          <label for="username" class="block mb-1 text-sm font-medium text-gray-700">Username</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="bi bi-person text-gray-400"></i></div>
            <input type="text" id="username" name="username" class="w-full pl-10 pr-4 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
          </div>
        </div>

        <div class="mb-3">
          <label for="password" class="block mb-1 text-sm font-medium text-gray-700">Password</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="bi bi-shield-lock text-gray-400"></i></div>
            <input type="password" id="password" name="password" class="w-full pl-10 pr-10 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center"><i class="bi bi-eye text-gray-400 hover:text-gray-600 cursor-pointer" id="togglePassword"></i></div>
          </div>
        </div>

        <p class="mb-9 text-sm text-left text-gray-500">
          Forgot Password?
          <a href="#" class="text-indigo-600 hover:underline">Reset it</a>
        </p>

        <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-md hover:bg-indigo-700 transition">
          Login
        </button>
        <p class="mt-6 text-sm text-center text-gray-500">
          <a href="../index.html" class="text-indigo-600 hover:text-indigo-400 font-medium">Go Back</a>
        </p>
      </form>

      <hr class="my-8" />
      <p class="mt-6 text-sm text-center text-gray-500">
        Don't have an account?
        <a href="register.php" class="text-indigo-400 hover:underline hover:text-indigo-600 font-medium">Sign up</a>
      </p>
    </div>
  </div>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script src="../assets/js/toast-notifications.js"></script>
  <script src="../assets/js/login-validation.js"></script>
</body>

</html>