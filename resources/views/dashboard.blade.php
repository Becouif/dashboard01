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
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
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
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }

        .btn-secondary {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-color);
            transition: all 0.2s ease;
        }

        .btn-secondary:hover {
            background-color: rgba(0, 0, 0, 0.05);
            border-color: var(--primary);
        }

        .dark .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.05);
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
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 12px;
            color: #f59e0b;
        }

        .light .theme-toggle::before {
            content: '\f185';
        }

        .dark .theme-toggle::before {
            transform: translateX(30px);
            background: #374151;
            content: '\f186';
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
            position: relative;
            font-weight: 500;
        }

        .calendar-day:hover {
            background-color: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        .calendar-day.today {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(67, 97, 238, 0.3);
        }

        .calendar-day.has-appointment::after {
            content: '';
            position: absolute;
            bottom: 4px;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background-color: var(--danger);
        }

        .calendar-day.selected {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
        }

        /* Customer table styling */
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

        /* Status badges */
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .status-active {
            background-color: rgba(34, 197, 94, 0.1);
            color: rgb(21, 128, 61);
        }

        .dark .status-active {
            background-color: rgba(34, 197, 94, 0.2);
            color: rgb(74, 222, 128);
        }

        .status-pending {
            background-color: rgba(245, 158, 11, 0.1);
            color: rgb(180, 83, 9);
        }

        .dark .status-pending {
            background-color: rgba(245, 158, 11, 0.2);
            color: rgb(253, 186, 116);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(156, 163, 175, 0.5);
            border-radius: 4px;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: rgba(75, 85, 99, 0.5);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(107, 114, 128, 0.7);
        }

        /* Action buttons */
        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            font-size: 0.875rem;
        }

        .action-btn-call {
            background-color: rgba(34, 197, 94, 0.1);
            color: rgb(21, 128, 61);
        }

        .action-btn-call:hover {
            background-color: rgb(21, 128, 61);
            color: white;
        }

        .action-btn-email {
            background-color: rgba(59, 130, 246, 0.1);
            color: rgb(29, 78, 216);
        }

        .action-btn-email:hover {
            background-color: rgb(29, 78, 216);
            color: white;
        }

        .action-btn-invoice {
            background-color: rgba(168, 85, 247, 0.1);
            color: rgb(126, 34, 206);
        }

        .action-btn-invoice:hover {
            background-color: rgb(126, 34, 206);
            color: white;
        }

        /* Animation for stats cards */
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-up {
            animation: slideUp 0.5s ease-out forwards;
        }

        /* Loading skeleton */
        .skeleton {
            background: linear-gradient(90deg, var(--border-color) 25%, var(--card-bg) 50%, var(--border-color) 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 0.375rem;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }

        /* Mobile menu */
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.active {
            transform: translateX(0);
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Dashboard Container -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="hidden lg:flex flex-col w-64 min-h-screen border-r border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-800">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-chart-pie text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-tight">ServiceDash</h1>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Business Dashboard</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-6">
                <div class="space-y-2">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Main</p>
                        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400">
                            <i class="fas fa-home"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Appointments</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                            <i class="fas fa-users"></i>
                            <span>Customers</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                            <i class="fas fa-dollar-sign"></i>
                            <span>Revenue</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                            <i class="fas fa-chart-line"></i>
                            <span>Analytics</span>
                        </a>
                    </div>

                    <div class="pt-6">
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Settings</p>
                        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                            <i class="fas fa-cog"></i>
                            <span>General</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                            <i class="fas fa-user"></i>
                            <span>Profile</span>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- User Profile -->
            <div class="p-6 border-t border-gray-200 dark:border-gray-800">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold">
                        JD
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate">John Doe</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">Service Business Owner</p>
                    </div>
                    <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <i class="fas fa-chevron-down text-gray-500"></i>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Mobile Sidebar -->
        <div class="mobile-menu fixed inset-0 z-50 lg:hidden">
            <div class="fixed inset-0 bg-black bg-opacity-50" onclick="toggleMobileMenu()"></div>
            <div class="relative w-64 h-full bg-white dark:bg-gray-900">
                <div class="p-4 border-b border-gray-200 dark:border-gray-800">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                <i class="fas fa-chart-pie text-white text-lg"></i>
                            </div>
                            <h1 class="text-xl font-bold">ServiceDash</h1>
                        </div>
                        <button onclick="toggleMobileMenu()" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <nav class="p-4">
                    <!-- Mobile navigation items would go here -->
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <!-- Top Header -->
            <header class="sticky top-0 z-40 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm border-b border-gray-200 dark:border-gray-800">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <button onclick="toggleMobileMenu()" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div>
                                <h2 class="text-xl font-semibold">Dashboard Overview</h2>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Welcome back, John! Here's what's happening with your business today.</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <!-- Theme Toggle -->
                            <div class="theme-toggle" id="themeToggle"></div>
                            
                            <!-- Notifications -->
                            <button class="relative p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                                <i class="fas fa-bell"></i>
                                <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>
                            
                            <!-- Add New Button -->
                            <button class="btn-primary px-4 py-2 rounded-lg font-medium flex items-center space-x-2">
                                <i class="fas fa-plus"></i>
                                <span>New Appointment</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Revenue Card -->
                    <div class="card p-6 animate-slide-up" style="animation-delay: 0.1s">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Revenue This Month</p>
                                <h3 class="text-3xl font-bold mt-2">$8,450</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-green-600 dark:text-green-400 text-sm font-medium">
                                        <i class="fas fa-arrow-up mr-1"></i> 18.2%
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                                <i class="fas fa-dollar-sign text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Target: $10,000</span>
                                <span class="font-medium">84.5%</span>
                            </div>
                            <div class="mt-2 w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-green-500 to-emerald-600 rounded-full" style="width: 84.5%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Appointments Card -->
                    <div class="card p-6 animate-slide-up" style="animation-delay: 0.2s">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Upcoming Appointments</p>
                                <h3 class="text-3xl font-bold mt-2">12</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-blue-600 dark:text-blue-400 text-sm font-medium">
                                        3 today
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">· 5 this week</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center">
                                <i class="fas fa-calendar-check text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Next appointment:</span>
                                <span class="text-sm font-medium">Today, 10:30 AM</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Completion rate:</span>
                                <span class="text-sm font-medium">94%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Customers Card -->
                    <div class="card p-6 animate-slide-up" style="animation-delay: 0.3s">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Active Customers</p>
                                <h3 class="text-3xl font-bold mt-2">84</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-purple-600 dark:text-purple-400 text-sm font-medium">
                                        <i class="fas fa-user-plus mr-1"></i> +5
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">this month</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center">
                                <i class="fas fa-users text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 dark:text-gray-400">New this week</p>
                                <p class="text-lg font-semibold">12</p>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Repeat rate</p>
                                <p class="text-lg font-semibold">78%</p>
                            </div>
                        </div>
                    </div>

                    <!-- Satisfaction Card -->
                    <div class="card p-6 animate-slide-up" style="animation-delay: 0.4s">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Satisfaction Score</p>
                                <h3 class="text-3xl font-bold mt-2">4.8</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-600 dark:text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">(42 reviews)</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center">
                                <i class="fas fa-smile text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Positive reviews</span>
                                <span class="font-medium">92%</span>
                            </div>
                            <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-yellow-500 to-orange-600 rounded-full" style="width: 92%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calendar & Upcoming Appointments -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Calendar View -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold">Appointment Calendar</h3>
                            <div class="flex items-center space-x-2">
                                <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <span class="font-medium">November 2023</span>
                                <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Calendar Header -->
                        <div class="grid grid-cols-7 gap-1 mb-4">
                            <div class="text-center text-sm font-medium text-gray-500 dark:text-gray-400 py-2">Sun</div>
                            <div class="text-center text-sm font-medium text-gray-500 dark:text-gray-400 py-2">Mon</div>
                            <div class="text-center text-sm font-medium text-gray-500 dark:text-gray-400 py-2">Tue</div>
                            <div class="text-center text-sm font-medium text-gray-500 dark:text-gray-400 py-2">Wed</div>
                            <div class="text-center text-sm font-medium text-gray-500 dark:text-gray-400 py-2">Thu</div>
                            <div class="text-center text-sm font-medium text-gray-500 dark:text-gray-400 py-2">Fri</div>
                            <div class="text-center text-sm font-medium text-gray-500 dark:text-gray-400 py-2">Sat</div>
                        </div>

                        <!-- Calendar Days -->
                        <div class="grid grid-cols-7 gap-1" id="calendarDays">
                            <!-- Calendar days will be generated here -->
                        </div>

                        <!-- Calendar Legend -->
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Appointments</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-3 h-3 rounded-full bg-purple-500"></div>
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Follow-ups</span>
                                    </div>
                                </div>
                                <button class="btn-secondary px-4 py-2 rounded-lg text-sm font-medium">
                                    <i class="fas fa-plus mr-2"></i> Add Event
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Appointments -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold">Upcoming Appointments</h3>
                            <button class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                                View All <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>

                        <div class="space-y-4">
                            <!-- Appointment 1 -->
                            <div class="flex items-center p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-blue-300 dark:hover:border-blue-700 transition-colors">
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center mr-4">
                                    <i class="fas fa-tools text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold">AC Repair Service</h4>
                                    <div class="flex items-center space-x-4 mt-1">
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                            <i class="fas fa-user mr-2"></i>
                                            <span>John Smith</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                            <i class="fas fa-clock mr-2"></i>
                                            <span>10:30 AM</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="action-btn action-btn-call" title="Call">
                                        <i class="fas fa-phone"></i>
                                    </button>
                                    <button class="action-btn action-btn-email" title="Email">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Appointment 2 -->
                            <div class="flex items-center p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-purple-300 dark:hover:border-purple-700 transition-colors">
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center mr-4">
                                    <i class="fas fa-faucet text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold">Plumbing Inspection</h4>
                                    <div class="flex items-center space-x-4 mt-1">
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                            <i class="fas fa-user mr-2"></i>
                                            <span>Sarah Johnson</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                            <i class="fas fa-clock mr-2"></i>
                                            <span>2:00 PM</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="action-btn action-btn-call" title="Call">
                                        <i class="fas fa-phone"></i>
                                    </button>
                                    <button class="action-btn action-btn-email" title="Email">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Appointment 3 -->
                            <div class="flex items-center p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-yellow-300 dark:hover:border-yellow-700 transition-colors">
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center mr-4">
                                    <i class="fas fa-bolt text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold">Electrical Wiring</h4>
                                    <div class="flex items-center space-x-4 mt-1">
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                            <i class="fas fa-user mr-2"></i>
                                            <span>Michael Brown</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                            <i class="fas fa-clock mr-2"></i>
                                            <span>4:15 PM</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="action-btn action-btn-call" title="Call">
                                        <i class="fas fa-phone"></i>
                                    </button>
                                    <button class="action-btn action-btn-email" title="Email">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Appointment 4 -->
                            <div class="flex items-center p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-green-300 dark:hover:border-green-700 transition-colors">
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center mr-4">
                                    <i class="fas fa-paint-roller text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold">Interior Painting</h4>
                                    <div class="flex items-center space-x-4 mt-1">
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                            <i class="fas fa-user mr-2"></i>
                                            <span>Alex Williams</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                            <i class="fas fa-clock mr-2"></i>
                                            <span>Tomorrow, 9:00 AM</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="action-btn action-btn-call" title="Call">
                                        <i class="fas fa-phone"></i>
                                    </button>
                                    <button class="action-btn action-btn-email" title="Email">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer List -->
                <div class="card overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-semibold">Customer List</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Manage your customers and take quick actions</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="text" placeholder="Search customers..." class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent w-full sm:w-64">
                                </div>
                                <button class="btn-primary px-4 py-2 rounded-lg font-medium">
                                    <i class="fas fa-plus mr-2"></i> Add Customer
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full customer-table">
                            <thead>
                                <tr class="text-left text-sm font-medium text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700">
                                    <th class="pb-3 px-6 pt-4">Customer</th>
                                    <th class="pb-3 px-6 pt-4">Service</th>
                                    <th class="pb-3 px-6 pt-4">Last Appointment</th>
                                    <th class="pb-3 px-6 pt-4">Total Spent</th>
                                    <th class="pb-3 px-6 pt-4">Status</th>
                                    <th class="pb-3 px-6 pt-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Customer 1 -->
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-white font-semibold mr-3">
                                                JS
                                            </div>
                                            <div>
                                                <p class="font-medium">John Smith</p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">john.smith@email.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-md bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mr-2">
                                                <i class="fas fa-tools text-blue-600 dark:text-blue-400 text-sm"></i>
                                            </div>
                                            <span class="font-medium">AC Repair</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-medium">Nov 15, 2023</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">10:30 AM</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-medium">$1,250</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">3 services</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="status-badge status-active">
                                            <i class="fas fa-circle" style="font-size: 6px;"></i>
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <button class="action-btn action-btn-call" title="Call customer">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="action-btn action-btn-email" title="Send email">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn action-btn-invoice" title="Create invoice">
                                                <i class="fas fa-file-invoice"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Customer 2 -->
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-white font-semibold mr-3">
                                                SJ
                                            </div>
                                            <div>
                                                <p class="font-medium">Sarah Johnson</p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">sarah.j@email.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-md bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center mr-2">
                                                <i class="fas fa-faucet text-purple-600 dark:text-purple-400 text-sm"></i>
                                            </div>
                                            <span class="font-medium">Plumbing</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-medium">Nov 12, 2023</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">2:00 PM</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-medium">$2,480</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">5 services</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="status-badge status-active">
                                            <i class="fas fa-circle" style="font-size: 6px;"></i>
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <button class="action-btn action-btn-call" title="Call customer">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="action-btn action-btn-email" title="Send email">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn action-btn-invoice" title="Create invoice">
                                                <i class="fas fa-file-invoice"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Customer 3 -->
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center text-white font-semibold mr-3">
                                                MB
                                            </div>
                                            <div>
                                                <p class="font-medium">Michael Brown</p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">michael.b@email.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-md bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center mr-2">
                                                <i class="fas fa-bolt text-yellow-600 dark:text-yellow-400 text-sm"></i>
                                            </div>
                                            <span class="font-medium">Electrical</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-medium">Nov 10, 2023</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">4:15 PM</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-medium">$3,150</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">7 services</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="status-badge status-pending">
                                            <i class="fas fa-circle" style="font-size: 6px;"></i>
                                            Follow-up Needed
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <button class="action-btn action-btn-call" title="Call customer">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="action-btn action-btn-email" title="Send email">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn action-btn-invoice" title="Create invoice">
                                                <i class="fas fa-file-invoice"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Customer 4 -->
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white font-semibold mr-3">
                                                AW
                                            </div>
                                            <div>
                                                <p class="font-medium">Alex Williams</p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">alex.w@email.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-md bg-green-100 dark:bg-green-900/30 flex items-center justify-center mr-2">
                                                <i class="fas fa-paint-roller text-green-600 dark:text-green-400 text-sm"></i>
                                            </div>
                                            <span class="font-medium">Painting</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-medium">Nov 8, 2023</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">9:00 AM</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div>
                                            <p class="font-medium">$4,200</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">2 services</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="status-badge status-active">
                                            <i class="fas fa-circle" style="font-size: 6px;"></i>
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <button class="action-btn action-btn-call" title="Call customer">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="action-btn action-btn-email" title="Send email">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="action-btn action-btn-invoice" title="Create invoice">
                                                <i class="fas fa-file-invoice"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Table Footer -->
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                Showing 4 of 84 customers
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 disabled:opacity-50" disabled>
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="w-8 h-8 rounded-lg bg-blue-600 text-white font-medium">1</button>
                                <button class="w-8 h-8 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 font-medium">2</button>
                                <button class="w-8 h-8 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 font-medium">3</button>
                                <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
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
        
        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.querySelector('.mobile-menu');
            mobileMenu.classList.toggle('active');
        }
        
        // Generate calendar
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
                emptyDay.classList.add('h-10');
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
                
                // Add click event
                dayElement.addEventListener('click', () => {
                    // Remove selected class from all days
                    document.querySelectorAll('.calendar-day').forEach(d => {
                        d.classList.remove('selected');
                    });
                    // Add selected class to clicked day
                    dayElement.classList.add('selected');
                    
                    // In a real app, you would load appointments for this day
                    console.log(`Selected day: November ${day}, 2023`);
                });
                
                calendarDays.appendChild(dayElement);
            }
        }
        
        // Action button handlers
        document.querySelectorAll('.action-btn-call').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                // In a real app, this would initiate a phone call
                const customerName = this.closest('tr').querySelector('.font-medium').textContent;
                console.log(`Calling ${customerName}...`);
                alert(`Initiating call to ${customerName}. In a real app, this would connect to their phone number.`);
            });
        });
        
        document.querySelectorAll('.action-btn-email').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                // In a real app, this would open email composer
                const customerName = this.closest('tr').querySelector('.font-medium').textContent;
                console.log(`Emailing ${customerName}...`);
                alert(`Opening email composer for ${customerName}. In a real app, this would open your email client.`);
            });
        });
        
        document.querySelectorAll('.action-btn-invoice').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                // In a real app, this would open invoice creation
                const customerName = this.closest('tr').querySelector('.font-medium').textContent;
                console.log(`Creating invoice for ${customerName}...`);
                alert(`Creating invoice for ${customerName}. In a real app, this would open the invoice editor.`);
            });
        });
        
        // Appointment card click handlers
        document.querySelectorAll('.appointment-card').forEach(card => {
            card.addEventListener('click', function() {
                const appointmentName = this.querySelector('.font-semibold').textContent;
                console.log(`Viewing details for appointment: ${appointmentName}`);
            });
        });
        
        // Initialize the calendar when page loads
        document.addEventListener('DOMContentLoaded', generateCalendar);
        
        // Add smooth loading animation for stats cards
        const statsCards = document.querySelectorAll('.animate-slide-up');
        statsCards.forEach((card, index) => {
            card.style.animationDelay = `${(index + 1) * 0.1}s`;
        });
    </script>
</body>
</html>