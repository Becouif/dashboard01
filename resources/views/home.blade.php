<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServiceDash | Modern Dashboard for Local Service Businesses</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --success: #4cc9f0;
            --warning: #f8961e;
            --danger: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
        }

        .dark {
            --primary: #5a76f9;
            --primary-dark: #4361ee;
            --bg-color: #121826;
            --card-bg: #1f2937;
            --text-color: #f3f4f6;
            --border-color: #374151;
        }

        .light {
            --bg-color: #f9fafb;
            --card-bg: #ffffff;
            --text-color: #111827;
            --border-color: #e5e7eb;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .nav-link {
            color: var(--text-color);
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            color: var(--primary);
        }

        /* Dashboard floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }

        .floating-dashboard {
            animation: float 6s ease-in-out infinite;
            transform-origin: center;
        }

        /* Page transitions */
        .page {
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .page.active {
            display: block;
            opacity: 1;
        }

        /* Theme toggle */
        .theme-toggle {
            position: relative;
            width: 60px;
            height: 30px;
            background: var(--border-color);
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .theme-toggle::before {
            content: '';
            position: absolute;
            top: 3px;
            left: 3px;
            width: 24px;
            height: 24px;
            background: white;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .dark .theme-toggle::before {
            transform: translateX(30px);
            background: #fbbf24;
        }

        /* Custom calendar styling */
        .calendar-day {
            width: 100%;
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .calendar-day:hover {
            background-color: var(--primary);
            color: white;
        }

        .calendar-day.today {
            background-color: var(--primary);
            color: white;
            font-weight: bold;
        }

        .calendar-day.has-appointment::after {
            content: '';
            position: absolute;
            bottom: 2px;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background-color: var(--danger);
        }

        /* Custom table styling */
        .customer-table tr {
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.2s ease;
        }

        .customer-table tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .dark .customer-table tr:hover {
            background-color: rgba(67, 97, 238, 0.1);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--border-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

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
    <!-- Theme toggle button -->
    <div class="fixed top-4 right-4 z-50">
        <div class="theme-toggle" id="themeToggle"></div>
    </div>

    <!-- Landing Page -->
    <div id="landingPage" class="page active min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="py-6 px-8 flex justify-between items-center">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center mr-3">
                    <i class="fas fa-chart-line text-white"></i>
                </div>
                <span class="text-2xl font-bold"><a href="/">ServiceDash</a></span>
            </div>
            <div>
                <button  class="btn-primary py-2 px-6 rounded-lg font-medium mr-4" onclick="showPage('loginPage')"><a href="{{route('login')}}">Sign In</a>
                    
</button>
                <button  class="py-2 px-6 rounded-lg font-medium border border-gray-300 dark:border-gray-600" onclick="showPage('registerPage')"><a href="{{route('register')}}">Get Started</a>
                    
</button>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="flex-grow container mx-auto px-8 py-12 flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 mb-12 lg:mb-0">
                <h1 class="text-5xl font-bold leading-tight mb-6">
                    Modern dashboard for <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-purple-600">local service businesses</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-2xl">
                    Manage appointments, track revenue, and connect with customers all in one beautiful, intuitive dashboard designed specifically for service providers.
                </p>
                <div class="flex flex-wrap gap-4">
                    <button class="btn-primary py-3 px-8 rounded-lg text-lg font-medium flex items-center" onclick="showPage('registerPage')"><a href="{{route('register')}}"> Get Started <i class="fas fa-arrow-right ml-2"></i></a>
                       
                    </button>
                    <button class="py-3 px-8 rounded-lg text-lg font-medium border border-gray-300 dark:border-gray-600 flex items-center"><a href="{{route('dashboard')}}"><i class="fa-solid fa-gauge-high mr-2"></i> Go To Dashboard</a>
                        
                    </button>
                    <button class="py-3 px-8 rounded-lg text-lg font-medium text-blue-600 dark:text-blue-400" onclick="showPage('loginPage')"><a href="{{route('login')}}"> Already have an account? Sign In</a>
                       
                    </button>
                </div>
            </div>
            
            <div class="lg:w-1/2 relative">
                <!-- Floating dashboard visualization -->
                <div class="relative mx-auto max-w-2xl">
                    <div class="floating-dashboard">
                        <!-- Main dashboard card -->
                        <div class="card p-6 shadow-2xl">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-xl font-bold">Today's Overview</h3>
                                <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-sm font-medium">
                                    +12% Revenue
                                </span>
                            </div>
                            
                            <!-- Stats row -->
                            <div class="grid grid-cols-3 gap-4 mb-6">
                                <div class="p-4 rounded-lg bg-blue-50 dark:bg-blue-900/30">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Revenue</p>
                                    <p class="text-2xl font-bold">$4,280</p>
                                </div>
                                <div class="p-4 rounded-lg bg-purple-50 dark:bg-purple-900/30">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Appointments</p>
                                    <p class="text-2xl font-bold">12</p>
                                </div>
                                <div class="p-4 rounded-lg bg-green-50 dark:bg-green-900/30">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Customers</p>
                                    <p class="text-2xl font-bold">84</p>
                                </div>
                            </div>
                            
                            <!-- Calendar preview -->
                            <div class="mb-4">
                                <h4 class="font-medium mb-2">Upcoming</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center p-2 rounded-md bg-gray-50 dark:bg-gray-800">
                                        <div class="w-2 h-8 bg-blue-500 rounded mr-3"></div>
                                        <div>
                                            <p class="font-medium">John Smith - AC Repair</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">10:30 AM</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center p-2 rounded-md bg-gray-50 dark:bg-gray-800">
                                        <div class="w-2 h-8 bg-purple-500 rounded mr-3"></div>
                                        <div>
                                            <p class="font-medium">Sarah Johnson - Plumbing</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">2:00 PM</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Customer preview -->
                            <div>
                                <h4 class="font-medium mb-2">Recent Customers</h4>
                                <div class="flex space-x-4">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold">
                                        JS
                                    </div>
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-400 to-purple-600 flex items-center justify-center text-white font-bold">
                                        SJ
                                    </div>
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center text-white font-bold">
                                        MK
                                    </div>
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-red-400 to-red-600 flex items-center justify-center text-white font-bold">
                                        AL
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Floating elements around dashboard -->
                    <div class="absolute -top-4 -left-4 w-20 h-20 bg-gradient-to-r from-blue-400 to-blue-600 rounded-xl opacity-20 animate-pulse"></div>
                    <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-gradient-to-r from-purple-400 to-purple-600 rounded-full opacity-20 animate-pulse delay-1000"></div>
                    <div class="absolute top-1/2 -right-10 w-16 h-16 bg-gradient-to-r from-green-400 to-green-600 rounded-lg opacity-20 animate-pulse delay-500"></div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-8 px-8 border-t border-gray-200 dark:border-gray-800 text-center text-gray-500 dark:text-gray-400">
            <p>© 2023- <span id="yearFooter"> </span> ServiceDash. All rights reserved. Built for local service businesses.</p>
        </footer>
    </div>



    
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // get year for footer 
        let year = new Date().getFullYear();
        document.getElementById('yearFooter').textContent = year;
        
        // Theme toggle functionality
        const themeToggle = document.getElementById('themeToggle');
        const htmlElement = document.documentElement;
        
        // Check for saved theme or prefer-color-scheme
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
            htmlElement.classList.add('dark');
        }
        
        themeToggle.addEventListener('click', () => {
            htmlElement.classList.toggle('dark');
            localStorage.setItem('theme', htmlElement.classList.contains('dark') ? 'dark' : 'light');
        });
        
        // Page navigation functionality
        function showPage(pageId) {
            // Hide all pages
            document.querySelectorAll('.page').forEach(page => {
                page.classList.remove('active');
            });
            
            // Show the requested page
            document.getElementById(pageId).classList.add('active');
            
            // If showing dashboard, generate calendar
            if (pageId === 'dashboardPage') {
                generateCalendar();
            }
        }
        
        // Form submission handling
        document.getElementById('loginForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            // In a real app, you would send this to your backend
            alert('Login form submitted! (Backend integration needed)');
            showPage('dashboardPage');
        });
        
        document.getElementById('registerForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            // In a real app, you would send this to your backend
            alert('Registration form submitted! (Backend integration needed)');
            showPage('dashboardPage');
        });
        
        // Calendar generation
        function generateCalendar() {
            const calendarDays = document.getElementById('calendarDays');
            if (!calendarDays) return;
            
            // Clear previous calendar
            calendarDays.innerHTML = '';
            
            // November 2023 - starting on Wednesday (offset for first day)
            const firstDayOffset = 3; // Wednesday (0 = Sunday, 1 = Monday, etc.)
            const daysInMonth = 30;
            const today = 15; // Today is November 15
            
            // Add empty cells for days before the first day of the month
            for (let i = 0; i < firstDayOffset; i++) {
                const emptyDay = document.createElement('div');
                emptyDay.classList.add('calendar-day');
                calendarDays.appendChild(emptyDay);
            }
            
            // Add days of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = document.createElement('div');
                dayElement.classList.add('calendar-day', 'relative');
                dayElement.textContent = day;
                
                // Mark today
                if (day === today) {
                    dayElement.classList.add('today');
                }
                
                // Mark days with appointments (just for demonstration)
                if ([3, 8, 12, 15, 20, 25].includes(day)) {
                    dayElement.classList.add('has-appointment');
                }
                
                calendarDays.appendChild(dayElement);
            }
        }
        
        // Settings modal functionality
        const generalSettingsBtn = document.getElementById('generalSettingsBtn');
        const profileSettingsBtn = document.getElementById('profileSettingsBtn');
        const settingsModal = document.getElementById('settingsModal');
        const closeSettingsBtn = document.getElementById('closeSettingsBtn');
        const generalTab = document.getElementById('generalTab');
        const profileTab = document.getElementById('profileTab');
        const generalSettings = document.getElementById('generalSettings');
        const profileSettings = document.getElementById('profileSettings');
        const settingsTitle = document.getElementById('settingsTitle');
        
        if (generalSettingsBtn) {
            generalSettingsBtn.addEventListener('click', () => {
                settingsModal.classList.remove('hidden');
                showSettingsTab('general');
            });
        }
        
        if (profileSettingsBtn) {
            profileSettingsBtn.addEventListener('click', () => {
                settingsModal.classList.remove('hidden');
                showSettingsTab('profile');
            });
        }
        
        if (closeSettingsBtn) {
            closeSettingsBtn.addEventListener('click', () => {
                settingsModal.classList.add('hidden');
            });
        }
        
        // Close modal when clicking outside
        settingsModal.addEventListener('click', (e) => {
            if (e.target === settingsModal) {
                settingsModal.classList.add('hidden');
            }
        });
        
        function showSettingsTab(tab) {
            // Update tabs
            if (tab === 'general') {
                generalTab.classList.add('border-blue-600', 'text-blue-600', 'dark:text-blue-400');
                generalTab.classList.remove('text-gray-500', 'dark:text-gray-400', 'border-transparent');
                profileTab.classList.remove('border-blue-600', 'text-blue-600', 'dark:text-blue-400');
                profileTab.classList.add('text-gray-500', 'dark:text-gray-400', 'border-transparent');
                
                // Show general settings, hide profile
                generalSettings.classList.remove('hidden');
                profileSettings.classList.add('hidden');
                
                settingsTitle.textContent = 'General Settings';
            } else {
                profileTab.classList.add('border-blue-600', 'text-blue-600', 'dark:text-blue-400');
                profileTab.classList.remove('text-gray-500', 'dark:text-gray-400', 'border-transparent');
                generalTab.classList.remove('border-blue-600', 'text-blue-600', 'dark:text-blue-400');
                generalTab.classList.add('text-gray-500', 'dark:text-gray-400', 'border-transparent');
                
                // Show profile settings, hide general
                profileSettings.classList.remove('hidden');
                generalSettings.classList.add('hidden');
                
                settingsTitle.textContent = 'Profile Settings';
            }
        }
        
        // Tab switching
        if (generalTab) {
            generalTab.addEventListener('click', () => showSettingsTab('general'));
        }
        
        if (profileTab) {
            profileTab.addEventListener('click', () => showSettingsTab('profile'));
        }
        
        // Initialize the calendar when page loads
        document.addEventListener('DOMContentLoaded', generateCalendar);
        
        // Simulate customer action buttons
        document.querySelectorAll('.customer-table button').forEach(button => {
            button.addEventListener('click', function() {
                const action = this.querySelector('i').className;
                let actionName = '';
                
                if (action.includes('phone')) {
                    actionName = 'Call';
                } else if (action.includes('envelope')) {
                    actionName = 'Email';
                } else if (action.includes('file-invoice')) {
                    actionName = 'Invoice';
                }
                
                // In a real app, this would trigger the actual action
                console.log(`${actionName} action triggered`);
            });
        });
    </script>
</body>
</html>