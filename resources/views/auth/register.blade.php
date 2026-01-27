<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - AllNOne</title>
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
              /* Login/Register form styling */
        .form-input {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            color: var(--text-color);
            transition: all 0.2s ease;
        }

        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen">
  <!-- Register Page -->
    <div id="registerPage" class="page min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="flex justify-center mb-8">
                <div class="w-16 h-16 rounded-xl bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center"><a href="/"><i class="fas fa-user-plus text-white text-2xl"></i></a>
                    
                </div>
            </div>
            
            <div class="card p-8">
                <h2 class="text-3xl font-bold text-center mb-2">Create Account</h2>
                <p class="text-gray-500 dark:text-gray-400 text-center mb-8">Start managing your service business today</p>
                
                <form id="registerForm" method="POST" action="{{route('register.post')}}"> @csrf
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="registerName">Full Name</label>
                        <input type="text" name="name" id="registerName" class="form-input w-full py-3 px-4 rounded-lg" placeholder="John Smith" required>

                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="registerEmail">Email</label>
                        <input type="email" name="email" id="registerEmail" class="form-input w-full py-3 px-4 rounded-lg" placeholder="name@example.com" required>
 
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="registerPassword">Password</label>
                        <input type="password" name="password" id="registerPassword" class="form-input w-full py-3 px-4 rounded-lg" placeholder="••••••••" required>

                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Must be at least 8 characters</p>
                    </div>
                    
                    <div class="flex items-center mb-6">
                        <input type="checkbox" name="terms" id="terms" class="w-4 h-4 rounded border-gray-300" required>

                        <label for="terms" class="ml-2 text-sm">
                            I agree to the <a href="#" class="text-blue-600 dark:text-blue-400">Terms of Service</a> and <a href="#" class="text-blue-600 dark:text-blue-400">Privacy Policy</a>
                        </label>
                    </div>
                    
                    <button type="submit" class="btn-primary w-full py-3 px-4 rounded-lg font-medium mb-6">
                        Create Account
                    </button>
                    
                    <div class="text-center">
                        <p class="text-gray-500 dark:text-gray-400">
                            Already have an account?
                            <button type="button" class="text-blue-600 dark:text-blue-400 font-medium ml-1" onclick="showPage('loginPage')">
                                <a href="{{route('login')}}">Sign in</a>
                            </button>
                        </p>
                    </div>
                </form>
            </div>
            
            <div class="text-center mt-8">
                <button class="text-gray-500 dark:text-gray-400" onclick="showPage('landingPage')">
                    <a href="/"><i class="fas fa-arrow-left mr-2"></i> Back to Home
                </button></a>
            </div>
        </div>
    </div>
</body>
</html>