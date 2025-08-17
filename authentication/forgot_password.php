<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forget Password</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
    <!-- Tailwind CSS File or CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Toastify Library CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body class="m-0 h-screen box-border flex flex-row gap-8 bg-white p-5 md:p-2 overflow-hidden">
    <!-- Left Image Side -->
    <div class="hidden md:block w-1/2 h-full overflow-hidden rounded-xl">
        <img src="../assets/images/forgot-password.jpg" alt="Login Background" class="w-full h-full object-cover" />
    </div>


    <div class="w-full md:w-1/2 h-full flex items-center ">
        <!-- Check Email Section -->
        <div class="w-full max-w-md mx-auto hidden">
            <h2 class="text-3xl font-bold mb-3 text-center">Forget Password</h2>
            <p class="text-gray-500 text-center mb-16 md:mb-20 custom-margin">Enter your email address and we'll send you a verification code</p>

            <form>
                <div class="mb-5">
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="bi bi-envelope text-gray-400"></i></i></div>
                        <input type="text" id="email" name="email" class="w-full pl-10 pr-4 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        <p class="text-red-500 text-xs hidden mt-2" id="emailError">Please enter a valid email address.</p>
                    </div>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-md hover:bg-indigo-700 transition">
                    Send Code
                </button>
                <p class="mt-6 text-sm text-center text-gray-500">
                    <a href="login.php" class="text-indigo-600 hover:text-indigo-400 font-medium">Back to Login</a>
                </p>
            </form>
        </div>

        <!-- Verification Code Section -->
        <div class="w-full max-w-md mx-auto hidden">
            <h2 class="text-3xl font-bold mb-3 text-center">Check your Email</h2>
            <p class="text-gray-500 text-center mb-1">A 5-digit code was sent to</p>
            <p class="font-semibold text-center text-gray-800 mb-16 md:mb-20 custom-margin">you@example.com</p>

            <form>
                <div class="mb-5">
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><i class="bi bi-envelope text-gray-400"></i></i></div>
                        <input type="text" id="email" name="email" class="w-full pl-10 pr-4 border border-gray-300 tracking-[1em] text-center rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 " placeholder="- - - - -" maxlength="5" required />
                        <p class="text-red-500 text-xs hidden mt-2" id="codeError">Please enter a valid 5-digit code.</p>
                    </div>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-md hover:bg-indigo-700 transition">
                    Resend Code
                </button>
                <p class="mt-10 text-sm text-center text-gray-500">
                    <a href="login.php" class="text-indigo-600 hover:text-indigo-400 font-medium">Back to Sign In</a>
                    <span class="text-gray-300 mx-5">|</span>
                    <a href="forgot_password.html" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Change Email</a>
                </p>
            </form>
        </div>

        <!-- Reset Password Section -->
        <div class="w-full max-w-md mx-auto">
            <h2 class="text-3xl font-bold mb-3 text-center">Create New Password</h2>
            <p class="text-gray-500 text-center mb-16 md:mb-20 custom-margin">Enter your new password to complete the reset process</p>
            <form>
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
                    <p id="password-error" class="text-red-500 text-xs mt-1 hidden">Password is required.</p>
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
                    <p id="password-error" class="text-red-500 text-xs mt-1 hidden">Passwords do not match.</p>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-md hover:bg-indigo-700 transition">
                    Reset Password
                </button>
               
            </form>
        </div>
    </div>



    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

</body>

</html>