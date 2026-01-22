<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
      <!-- Login Page -->
      <div id="loginPage" class="page min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="flex justify-center mb-8">
                <div class="w-16 h-16 rounded-xl bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                    <a href="/"><i class="fas fa-chart-line text-white text-2xl"></i></a>
                </div>
            </div>
            
            <div class="card p-8">
                <h2 class="text-3xl font-bold text-center mb-2">Welcome Back</h2>
                <p class="text-gray-500 dark:text-gray-400 text-center mb-8">Sign in to your ServiceDash account</p>
                
                <form id="loginForm" method="POST" action="{{route('login.post')}}"> @csrf
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="loginEmail">Email</label>
                        <input type="email" name="email" id="loginEmail" class="form-input w-full py-3 px-4 rounded-lg" placeholder="name@example.com" required>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="loginPassword">Password</label>
                        <input type="password" name="password" id="loginPassword" class="form-input w-full py-3 px-4 rounded-lg" placeholder="••••••••" required>
                    </div>
                    
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" id="rememberMe" class="w-4 h-4 rounded border-gray-300">
                            <label for="rememberMe" class="ml-2 text-sm">Remember me</label>
                        </div>
                        <a href="#" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Forgot password?</a>
                    </div>
                    
                    <button type="submit" class="btn-primary w-full py-3 px-4 rounded-lg font-medium mb-6">
                        Sign In
                    </button>
                    
                    <div class="text-center">
                        <p class="text-gray-500 dark:text-gray-400">
                            Don't have an account?
                            <button type="button" class="text-blue-600 dark:text-blue-400 font-medium ml-1" onclick="showPage('registerPage')"><a href="{{route('register')}}">Sign up</a>
                                
                            </button>
                        </p>
                    </div>
                </form>
            </div>
            
            <div class="text-center mt-8">
                <button class="text-gray-500 dark:text-gray-400" onclick="showPage('landingPage')">
                    <i class="fas fa-arrow-left mr-2"></i> <a href="/">Back to Home</a> 
                </button>
            </div>
        </div>
    </div>

</body>
</html>