<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServiceDash | Appointment Management</title>
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

        .status-pending {
            background-color: rgba(245, 158, 11, 0.1);
            color: rgb(180, 83, 9);
        }

        .dark .status-pending {
            background-color: rgba(245, 158, 11, 0.2);
            color: rgb(253, 186, 116);
        }

        .status-confirmed {
            background-color: rgba(34, 197, 94, 0.1);
            color: rgb(21, 128, 61);
        }

        .dark .status-confirmed {
            background-color: rgba(34, 197, 94, 0.2);
            color: rgb(74, 222, 128);
        }

        .status-completed {
            background-color: rgba(59, 130, 246, 0.1);
            color: rgb(29, 78, 216);
        }

        .dark .status-completed {
            background-color: rgba(59, 130, 246, 0.2);
            color: rgb(96, 165, 250);
        }

        .status-cancelled {
            background-color: rgba(239, 68, 68, 0.1);
            color: rgb(185, 28, 28);
        }

        .dark .status-cancelled {
            background-color: rgba(239, 68, 68, 0.2);
            color: rgb(248, 113, 113);
        }

        /* Appointment card styling */
        .appointment-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .appointment-card.pending {
            border-left-color: #f59e0b;
        }

        .appointment-card.confirmed {
            border-left-color: #10b981;
        }

        .appointment-card.completed {
            border-left-color: #3b82f6;
        }

        .appointment-card.cancelled {
            border-left-color: #ef4444;
        }

        /* Service type colors */
        .service-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .service-ac {
            background-color: rgba(59, 130, 246, 0.1);
            color: rgb(29, 78, 216);
        }

        .service-plumbing {
            background-color: rgba(168, 85, 247, 0.1);
            color: rgb(126, 34, 206);
        }

        .service-electrical {
            background-color: rgba(245, 158, 11, 0.1);
            color: rgb(180, 83, 9);
        }

        .service-painting {
            background-color: rgba(16, 185, 129, 0.1);
            color: rgb(6, 95, 70);
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

        .action-btn-edit {
            background-color: rgba(59, 130, 246, 0.1);
            color: rgb(29, 78, 216);
        }

        .action-btn-edit:hover {
            background-color: rgb(29, 78, 216);
            color: white;
        }

        .action-btn-delete {
            background-color: rgba(239, 68, 68, 0.1);
            color: rgb(185, 28, 28);
        }

        .action-btn-delete:hover {
            background-color: rgb(185, 28, 28);
            color: white;
        }

        .action-btn-complete {
            background-color: rgba(16, 185, 129, 0.1);
            color: rgb(6, 95, 70);
        }

        .action-btn-complete:hover {
            background-color: rgb(6, 95, 70);
            color: white;
        }

        /* Tab styling */
        .tab-button {
            padding: 0.75rem 1.5rem;
            border-bottom: 2px solid transparent;
            transition: all 0.2s ease;
            font-weight: 500;
            cursor: pointer;
        }

        .tab-button.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        /* Modal styling */
        .modal-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        .modal-content {
            animation: slideUp 0.3s ease-out;
        }

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

        /* Animation for appointment cards */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }

        /* Mobile menu */
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.active {
            transform: translateX(0);
        }

        /* Calendar styling */
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
                        <p class="text-xs text-gray-500 dark:text-gray-400">Appointment Management</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            @include('layouts.nav')

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
                                <h2 class="text-xl font-semibold">Appointment Management</h2>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Schedule, manage, and track all your service appointments</p>
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
                            
                            <!-- Add New Appointment Button -->
                            <button id="openAppointmentModal" class="btn-primary px-4 py-2 rounded-lg font-medium flex items-center space-x-2">
                                <i class="fas fa-plus"></i>
                                <span>New Appointment</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Appointment Stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Appointments -->
                    <div class="card p-6 animate-fade-in">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Total Appointments</p>
                                <h3 class="text-3xl font-bold mt-2" id="totalAppointments">0</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-green-600 dark:text-green-400 text-sm font-medium">
                                        <i class="fas fa-arrow-up mr-1"></i> 12%
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">vs last week</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center">
                                <i class="fas fa-calendar-alt text-white text-lg"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Appointments -->
                    <div class="card p-6 animate-fade-in" style="animation-delay: 0.1s">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Pending</p>
                                <h3 class="text-3xl font-bold mt-2" id="pendingAppointments">0</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-600 dark:text-yellow-400 text-sm font-medium">
                                        3 today
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">· 8 this week</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center">
                                <i class="fas fa-clock text-white text-lg"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Confirmed Appointments -->
                    <div class="card p-6 animate-fade-in" style="animation-delay: 0.2s">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Confirmed</p>
                                <h3 class="text-3xl font-bold mt-2" id="confirmedAppointments">0</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-green-600 dark:text-green-400 text-sm font-medium">
                                        5 today
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">· 14 this week</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                                <i class="fas fa-check-circle text-white text-lg"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Completed Appointments -->
                    <div class="card p-6 animate-fade-in" style="animation-delay: 0.3s">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Completed</p>
                                <h3 class="text-3xl font-bold mt-2" id="completedAppointments">0</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-blue-600 dark:text-blue-400 text-sm font-medium">
                                        92%
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">completion rate</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center">
                                <i class="fas fa-flag-checkered text-white text-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Appointment Tabs -->
                <div class="mb-8">
                    <div class="flex space-x-1 border-b border-gray-200 dark:border-gray-700">
                        <button class="tab-button active" data-tab="upcoming">Upcoming</button>
                        <button class="tab-button" data-tab="pending">Pending</button>
                        <button class="tab-button" data-tab="confirmed">Confirmed</button>
                        <button class="tab-button" data-tab="completed">Completed</button>
                        <button class="tab-button" data-tab="cancelled">Cancelled</button>
                    </div>
                </div>

                <!-- Appointment Lists -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Left Column: Create Appointment Form -->
                    <div class="lg:col-span-1">
                        <div class="card p-6">
                            <h3 class="text-lg font-semibold mb-6">Create New Appointment</h3>
                            
                            <form id="appointmentForm">
                                <!-- Customer Selection -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Customer</label>
                                    <select id="customerSelect" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent">
                                        <option value="">Select a customer</option>
                                        <option value="1">John Smith (john.smith@email.com)</option>
                                        <option value="2">Sarah Johnson (sarah.j@email.com)</option>
                                        <option value="3">Michael Brown (michael.b@email.com)</option>
                                        <option value="4">Alex Williams (alex.w@email.com)</option>
                                        <option value="5">Emily Davis (emily.d@email.com)</option>
                                    </select>
                                </div>

                                <!-- Service Type -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Service Type</label>
                                    <div class="grid grid-cols-2 gap-2">
                                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-blue-300 dark:hover:border-blue-700">
                                            <input type="radio" name="serviceType" value="ac" class="mr-3">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-md bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mr-2">
                                                    <i class="fas fa-tools text-blue-600 dark:text-blue-400"></i>
                                                </div>
                                                <span>AC Repair</span>
                                            </div>
                                        </label>
                                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-purple-300 dark:hover:border-purple-700">
                                            <input type="radio" name="serviceType" value="plumbing" class="mr-3">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-md bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center mr-2">
                                                    <i class="fas fa-faucet text-purple-600 dark:text-purple-400"></i>
                                                </div>
                                                <span>Plumbing</span>
                                            </div>
                                        </label>
                                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-yellow-300 dark:hover:border-yellow-700">
                                            <input type="radio" name="serviceType" value="electrical" class="mr-3">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-md bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center mr-2">
                                                    <i class="fas fa-bolt text-yellow-600 dark:text-yellow-400"></i>
                                                </div>
                                                <span>Electrical</span>
                                            </div>
                                        </label>
                                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-green-300 dark:hover:border-green-700">
                                            <input type="radio" name="serviceType" value="painting" class="mr-3">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-md bg-green-100 dark:bg-green-900/30 flex items-center justify-center mr-2">
                                                    <i class="fas fa-paint-roller text-green-600 dark:text-green-400"></i>
                                                </div>
                                                <span>Painting</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Date & Time -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date & Time</label>
                                    <div class="grid grid-cols-2 gap-3">
                                        <input type="date" id="appointmentDate" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent">
                                        <input type="time" id="appointmentTime" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent">
                                    </div>
                                </div>

                                <!-- Duration -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Duration</label>
                                    <div class="grid grid-cols-4 gap-2">
                                        <button type="button" class="duration-btn py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-700" data-duration="30">30 min</button>
                                        <button type="button" class="duration-btn py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-700" data-duration="60">1 hour</button>
                                        <button type="button" class="duration-btn py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-700" data-duration="90">1.5 hours</button>
                                        <button type="button" class="duration-btn py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-700" data-duration="120">2 hours</button>
                                    </div>
                                </div>

                                <!-- Notes -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notes</label>
                                    <textarea id="appointmentNotes" rows="3" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent" placeholder="Add any special instructions or notes..."></textarea>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="w-full btn-primary py-3 rounded-lg font-medium flex items-center justify-center space-x-2">
                                    <i class="fas fa-calendar-plus"></i>
                                    <span>Schedule Appointment</span>
                                </button>
                            </form>
                        </div>

                        <!-- Quick Calendar -->
                        <div class="card p-6 mt-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold">Quick Calendar</h3>
                                <div class="flex items-center space-x-2">
                                    <button class="p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" id="prevMonth">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <span class="font-medium text-sm" id="currentMonth">November 2023</span>
                                    <button class="p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" id="nextMonth">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="grid grid-cols-7 gap-1 mb-2">
                                <div class="text-center text-xs font-medium text-gray-500 dark:text-gray-400 py-1">Sun</div>
                                <div class="text-center text-xs font-medium text-gray-500 dark:text-gray-400 py-1">Mon</div>
                                <div class="text-center text-xs font-medium text-gray-500 dark:text-gray-400 py-1">Tue</div>
                                <div class="text-center text-xs font-medium text-gray-500 dark:text-gray-400 py-1">Wed</div>
                                <div class="text-center text-xs font-medium text-gray-500 dark:text-gray-400 py-1">Thu</div>
                                <div class="text-center text-xs font-medium text-gray-500 dark:text-gray-400 py-1">Fri</div>
                                <div class="text-center text-xs font-medium text-gray-500 dark:text-gray-400 py-1">Sat</div>
                            </div>
                            <div class="grid grid-cols-7 gap-1" id="quickCalendar">
                                <!-- Calendar days will be generated here -->
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Appointment List -->
                    <div class="lg:col-span-2">
                        <div class="card">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    <div>
                                        <h3 class="text-lg font-semibold" id="appointmentListTitle">Upcoming Appointments</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1" id="appointmentListSubtitle">Appointments scheduled for the next 7 days</p>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="relative">
                                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                            <input type="text" id="appointmentSearch" placeholder="Search appointments..." class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent w-full sm:w-64">
                                        </div>
                                        <button class="btn-secondary px-4 py-2 rounded-lg font-medium flex items-center space-x-2">
                                            <i class="fas fa-filter"></i>
                                            <span>Filter</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Appointment List -->
                            <div class="overflow-y-auto max-h-[600px]" id="appointmentList">
                                <!-- Appointments will be dynamically loaded here -->
                            </div>

                            <!-- Empty State -->
                            <div id="emptyAppointmentState" class="text-center py-12 hidden">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full mb-4">
                                    <i class="fas fa-calendar text-gray-400 text-2xl"></i>
                                </div>
                                <h4 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-2">No appointments found</h4>
                                <p class="text-gray-600 dark:text-gray-400 mb-6">Try changing your filters or create a new appointment</p>
                                <button id="createFirstAppointment" class="btn-primary px-6 py-3 rounded-lg text-white font-medium">
                                    <i class="fas fa-plus mr-2"></i> Create First Appointment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Appointment Detail Modal -->
    <div id="appointmentDetailModal" class="fixed inset-0 z-50 flex items-center justify-center hidden modal-overlay">
        <div class="modal-content card w-full max-w-2xl m-4">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold">Appointment Details</h3>
                    <button id="closeDetailModal" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-6" id="appointmentDetailContent">
                <!-- Appointment details will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center hidden modal-overlay">
        <div class="modal-content card w-full max-w-md m-4">
            <div class="p-8 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full mb-4">
                    <i class="fas fa-check text-green-600 dark:text-green-400 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2" id="successTitle">Appointment Created!</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6" id="successMessage">Your appointment has been scheduled successfully.</p>
                <button id="closeSuccessModal" class="btn-primary px-6 py-3 rounded-lg text-white font-medium">
                    Continue
                </button>
            </div>
        </div>
    </div>

    <script>
        // Sample appointment data
        const sampleAppointments = [
            {
                id: 1,
                customer: {
                    name: "John Smith",
                    email: "john.smith@email.com",
                    phone: "(555) 123-4567",
                    initials: "JS"
                },
                serviceType: "ac",
                serviceName: "AC Repair",
                date: "2023-11-20",
                time: "10:30",
                duration: 90,
                status: "pending",
                notes: "AC unit not cooling properly. Check refrigerant levels.",
                amount: 245,
                createdAt: "2023-11-15"
            },
            {
                id: 2,
                customer: {
                    name: "Sarah Johnson",
                    email: "sarah.j@email.com",
                    phone: "(555) 987-6543",
                    initials: "SJ"
                },
                serviceType: "plumbing",
                serviceName: "Plumbing Inspection",
                date: "2023-11-20",
                time: "14:00",
                duration: 60,
                status: "confirmed",
                notes: "Kitchen sink leaking. Need to replace faucet.",
                amount: 180,
                createdAt: "2023-11-14"
            },
            {
                id: 3,
                customer: {
                    name: "Michael Brown",
                    email: "michael.b@email.com",
                    phone: "(555) 456-7890",
                    initials: "MB"
                },
                serviceType: "electrical",
                serviceName: "Electrical Wiring",
                date: "2023-11-21",
                time: "16:15",
                duration: 120,
                status: "pending",
                notes: "Install new outlets in living room.",
                amount: 320,
                createdAt: "2023-11-13"
            },
            {
                id: 4,
                customer: {
                    name: "Alex Williams",
                    email: "alex.w@email.com",
                    phone: "(555) 321-0987",
                    initials: "AW"
                },
                serviceType: "painting",
                serviceName: "Interior Painting",
                date: "2023-11-22",
                time: "09:00",
                duration: 240,
                status: "confirmed",
                notes: "Paint living room walls. Customer selected 'Seafoam Green' color.",
                amount: 450,
                createdAt: "2023-11-10"
            },
            {
                id: 5,
                customer: {
                    name: "Emily Davis",
                    email: "emily.d@email.com",
                    phone: "(555) 654-3210",
                    initials: "ED"
                },
                serviceType: "ac",
                serviceName: "AC Maintenance",
                date: "2023-11-19",
                time: "11:00",
                duration: 60,
                status: "completed",
                notes: "Regular seasonal maintenance completed.",
                amount: 120,
                createdAt: "2023-11-05"
            },
            {
                id: 6,
                customer: {
                    name: "Robert Wilson",
                    email: "robert.w@email.com",
                    phone: "(555) 789-0123",
                    initials: "RW"
                },
                serviceType: "plumbing",
                serviceName: "Water Heater Repair",
                date: "2023-11-18",
                time: "13:30",
                duration: 90,
                status: "completed",
                notes: "Replaced heating element. System working properly now.",
                amount: 275,
                createdAt: "2023-11-01"
            },
            {
                id: 7,
                customer: {
                    name: "Lisa Anderson",
                    email: "lisa.a@email.com",
                    phone: "(555) 234-5678",
                    initials: "LA"
                },
                serviceType: "electrical",
                serviceName: "Light Fixture Installation",
                date: "2023-11-17",
                time: "15:00",
                duration: 60,
                status: "cancelled",
                notes: "Customer cancelled due to scheduling conflict.",
                amount: 0,
                createdAt: "2023-10-28"
            }
        ];

        // State management
        let appointments = [...sampleAppointments];
        let currentTab = 'upcoming';
        let currentCalendarMonth = new Date().getMonth();
        let currentCalendarYear = new Date().getFullYear();

        // DOM Elements
        const themeToggle = document.getElementById('themeToggle');
        const htmlElement = document.documentElement;
        const appointmentForm = document.getElementById('appointmentForm');
        const appointmentList = document.getElementById('appointmentList');
        const emptyAppointmentState = document.getElementById('emptyAppointmentState');
        const appointmentSearch = document.getElementById('appointmentSearch');
        const appointmentListTitle = document.getElementById('appointmentListTitle');
        const appointmentListSubtitle = document.getElementById('appointmentListSubtitle');
        const tabButtons = document.querySelectorAll('.tab-button');
        const durationButtons = document.querySelectorAll('.duration-btn');
        const appointmentDetailModal = document.getElementById('appointmentDetailModal');
        const appointmentDetailContent = document.getElementById('appointmentDetailContent');
        const closeDetailModal = document.getElementById('closeDetailModal');
        const successModal = document.getElementById('successModal');
        const successTitle = document.getElementById('successTitle');
        const successMessage = document.getElementById('successMessage');
        const closeSuccessModal = document.getElementById('closeSuccessModal');
        const createFirstAppointment = document.getElementById('createFirstAppointment');
        const openAppointmentModal = document.getElementById('openAppointmentModal');
        const quickCalendar = document.getElementById('quickCalendar');
        const currentMonthElement = document.getElementById('currentMonth');
        const prevMonthBtn = document.getElementById('prevMonth');
        const nextMonthBtn = document.getElementById('nextMonth');
        
        // Stats elements
        const totalAppointmentsEl = document.getElementById('totalAppointments');
        const pendingAppointmentsEl = document.getElementById('pendingAppointments');
        const confirmedAppointmentsEl = document.getElementById('confirmedAppointments');
        const completedAppointmentsEl = document.getElementById('completedAppointments');

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            // Load appointments
            renderAppointments();
            updateStats();
            generateQuickCalendar();
            
            // Theme toggle
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                htmlElement.classList.add('dark');
            }
            
            themeToggle.addEventListener('click', () => {
                htmlElement.classList.toggle('dark');
                localStorage.setItem('theme', htmlElement.classList.contains('dark') ? 'dark' : 'light');
            });
            
            // Tab switching
            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const tab = this.getAttribute('data-tab');
                    switchTab(tab);
                });
            });
            
            // Duration button selection
            durationButtons.forEach(button => {
                button.addEventListener('click', function() {
                    durationButtons.forEach(btn => {
                        btn.classList.remove('btn-primary');
                        btn.classList.add('border-gray-300', 'dark:border-gray-600');
                    });
                    this.classList.add('btn-primary');
                    this.classList.remove('border-gray-300', 'dark:border-gray-600');
                });
            });
            
            // Form submission
            appointmentForm.addEventListener('submit', function(e) {
                e.preventDefault();
                createNewAppointment();
            });
            
            // Search functionality
            appointmentSearch.addEventListener('input', function() {
                renderAppointments();
            });
            
            // Modal close buttons
            closeDetailModal.addEventListener('click', () => {
                appointmentDetailModal.classList.add('hidden');
            });
            
            closeSuccessModal.addEventListener('click', () => {
                successModal.classList.add('hidden');
            });
            
            // Close modals when clicking outside
            appointmentDetailModal.addEventListener('click', (e) => {
                if (e.target === appointmentDetailModal) {
                    appointmentDetailModal.classList.add('hidden');
                }
            });
            
            successModal.addEventListener('click', (e) => {
                if (e.target === successModal) {
                    successModal.classList.add('hidden');
                }
            });
            
            // Create first appointment button
            createFirstAppointment.addEventListener('click', () => {
                // In a real app, this would open the form
                appointmentForm.scrollIntoView({ behavior: 'smooth' });
            });
            
            // Calendar navigation
            prevMonthBtn.addEventListener('click', () => {
                currentCalendarMonth--;
                if (currentCalendarMonth < 0) {
                    currentCalendarMonth = 11;
                    currentCalendarYear--;
                }
                generateQuickCalendar();
            });
            
            nextMonthBtn.addEventListener('click', () => {
                currentCalendarMonth++;
                if (currentCalendarMonth > 11) {
                    currentCalendarMonth = 0;
                    currentCalendarYear++;
                }
                generateQuickCalendar();
            });
        });

        // Switch tab
        function switchTab(tab) {
            currentTab = tab;
            
            // Update tab buttons
            tabButtons.forEach(button => {
                if (button.getAttribute('data-tab') === tab) {
                    button.classList.add('active');
                } else {
                    button.classList.remove('active');
                }
            });
            
            // Update list title
            let title = '';
            let subtitle = '';
            
            switch(tab) {
                case 'upcoming':
                    title = 'Upcoming Appointments';
                    subtitle = 'Appointments scheduled for the next 7 days';
                    break;
                case 'pending':
                    title = 'Pending Appointments';
                    subtitle = 'Appointments awaiting confirmation';
                    break;
                case 'confirmed':
                    title = 'Confirmed Appointments';
                    subtitle = 'Appointments confirmed by customers';
                    break;
                case 'completed':
                    title = 'Completed Appointments';
                    subtitle = 'Successfully completed appointments';
                    break;
                case 'cancelled':
                    title = 'Cancelled Appointments';
                    subtitle = 'Cancelled or rescheduled appointments';
                    break;
            }
            
            appointmentListTitle.textContent = title;
            appointmentListSubtitle.textContent = subtitle;
            
            // Render appointments
            renderAppointments();
        }

        // Render appointments
        function renderAppointments() {
            appointmentList.innerHTML = '';
            
            // Filter appointments based on current tab
            let filteredAppointments = appointments.filter(appointment => {
                if (currentTab === 'upcoming') {
                    // Show pending and confirmed appointments for upcoming dates
                    const appointmentDate = new Date(appointment.date);
                    const today = new Date();
                    const weekFromNow = new Date();
                    weekFromNow.setDate(today.getDate() + 7);
                    
                    return (appointment.status === 'pending' || appointment.status === 'confirmed') &&
                           appointmentDate >= today &&
                           appointmentDate <= weekFromNow;
                } else {
                    return appointment.status === currentTab;
                }
            });
            
            // Apply search filter
            const searchTerm = appointmentSearch.value.toLowerCase();
            if (searchTerm) {
                filteredAppointments = filteredAppointments.filter(appointment => {
                    return appointment.customer.name.toLowerCase().includes(searchTerm) ||
                           appointment.serviceName.toLowerCase().includes(searchTerm) ||
                           appointment.notes.toLowerCase().includes(searchTerm);
                });
            }
            
            // Show empty state if no appointments
            if (filteredAppointments.length === 0) {
                emptyAppointmentState.classList.remove('hidden');
                return;
            }
            
            emptyAppointmentState.classList.add('hidden');
            
            // Sort by date (soonest first)
            filteredAppointments.sort((a, b) => {
                if (a.date === b.date) {
                    return a.time.localeCompare(b.time);
                }
                return new Date(a.date) - new Date(b.date);
            });
            
            // Render appointment cards
            filteredAppointments.forEach(appointment => {
                const appointmentCard = document.createElement('div');
                appointmentCard.className = `appointment-card border-b border-gray-200 dark:border-gray-700 p-6 last:border-b-0 ${appointment.status}`;
                appointmentCard.dataset.id = appointment.id;
                
                // Format date
                const appointmentDate = new Date(appointment.date);
                const formattedDate = appointmentDate.toLocaleDateString('en-US', {
                    weekday: 'short',
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric'
                });
                
                // Format time
                const [hours, minutes] = appointment.time.split(':');
                const formattedTime = new Date(0, 0, 0, hours, minutes).toLocaleTimeString('en-US', {
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true
                });
                
                // Format duration
                const durationHours = Math.floor(appointment.duration / 60);
                const durationMinutes = appointment.duration % 60;
                let durationText = '';
                if (durationHours > 0) {
                    durationText += `${durationHours} hr`;
                    if (durationHours > 1) durationText += 's';
                    if (durationMinutes > 0) durationText += ' ';
                }
                if (durationMinutes > 0) {
                    durationText += `${durationMinutes} min`;
                }
                
                // Status badge
                let statusBadgeClass = '';
                let statusText = '';
                
                switch(appointment.status) {
                    case 'pending':
                        statusBadgeClass = 'status-pending';
                        statusText = 'Pending';
                        break;
                    case 'confirmed':
                        statusBadgeClass = 'status-confirmed';
                        statusText = 'Confirmed';
                        break;
                    case 'completed':
                        statusBadgeClass = 'status-completed';
                        statusText = 'Completed';
                        break;
                    case 'cancelled':
                        statusBadgeClass = 'status-cancelled';
                        statusText = 'Cancelled';
                        break;
                }
                
                // Service badge
                let serviceBadgeClass = '';
                switch(appointment.serviceType) {
                    case 'ac':
                        serviceBadgeClass = 'service-ac';
                        break;
                    case 'plumbing':
                        serviceBadgeClass = 'service-plumbing';
                        break;
                    case 'electrical':
                        serviceBadgeClass = 'service-electrical';
                        break;
                    case 'painting':
                        serviceBadgeClass = 'service-painting';
                        break;
                }
                
                appointmentCard.innerHTML = `
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-start">
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-white font-semibold mr-4 flex-shrink-0">
                                    ${appointment.customer.initials}
                                </div>
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center gap-2 mb-2">
                                        <h4 class="font-semibold">${appointment.customer.name}</h4>
                                        <span class="service-badge ${serviceBadgeClass}">${appointment.serviceName}</span>
                                        <span class="status-badge ${statusBadgeClass}">${statusText}</span>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-day mr-2"></i>
                                            <span>${formattedDate}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-clock mr-2"></i>
                                            <span>${formattedTime} (${durationText})</span>
                                        </div>
                                        ${appointment.amount > 0 ? `
                                        <div class="flex items-center">
                                            <i class="fas fa-dollar-sign mr-2"></i>
                                            <span>$${appointment.amount}</span>
                                        </div>
                                        ` : ''}
                                    </div>
                                    ${appointment.notes ? `
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-3">${appointment.notes}</p>
                                    ` : ''}
                                </div>
                            </div>
                        </div>
                        <div class="flex space-x-2 flex-shrink-0">
                            ${appointment.status === 'pending' ? `
                            <button class="action-btn action-btn-complete" onclick="completeAppointment(${appointment.id})" title="Mark as complete">
                                <i class="fas fa-check"></i>
                            </button>
                            ` : ''}
                            ${appointment.status !== 'completed' && appointment.status !== 'cancelled' ? `
                            <button class="action-btn action-btn-edit" onclick="editAppointment(${appointment.id})" title="Edit appointment">
                                <i class="fas fa-edit"></i>
                            </button>
                            ` : ''}
                            <button class="action-btn action-btn-delete" onclick="deleteAppointment(${appointment.id})" title="Delete appointment">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                `;
                
                // Add click event to view details
                appointmentCard.addEventListener('click', (e) => {
                    if (!e.target.closest('.action-btn')) {
                        viewAppointmentDetails(appointment.id);
                    }
                });
                
                appointmentList.appendChild(appointmentCard);
            });
        }

        // Update stats
        function updateStats() {
            const total = appointments.length;
            const pending = appointments.filter(a => a.status === 'pending').length;
            const confirmed = appointments.filter(a => a.status === 'confirmed').length;
            const completed = appointments.filter(a => a.status === 'completed').length;
            
            totalAppointmentsEl.textContent = total;
            pendingAppointmentsEl.textContent = pending;
            confirmedAppointmentsEl.textContent = confirmed;
            completedAppointmentsEl.textContent = completed;
        }

        // Create new appointment
        function createNewAppointment() {
            // Get form values
            const customerSelect = document.getElementById('customerSelect');
            const customerValue = customerSelect.value;
            const serviceType = document.querySelector('input[name="serviceType"]:checked');
            const date = document.getElementById('appointmentDate').value;
            const time = document.getElementById('appointmentTime').value;
            const notes = document.getElementById('appointmentNotes').value;
            
            // Validate form
            if (!customerValue || !serviceType || !date || !time) {
                showError('Please fill in all required fields');
                return;
            }
            
            // Get customer info
            let customerInfo = {
                name: "New Customer",
                email: "customer@email.com",
                phone: "(555) 000-0000",
                initials: "NC"
            };
            
            // In a real app, this would fetch customer data from database
            switch(customerValue) {
                case '1':
                    customerInfo = {
                        name: "John Smith",
                        email: "john.smith@email.com",
                        phone: "(555) 123-4567",
                        initials: "JS"
                    };
                    break;
                case '2':
                    customerInfo = {
                        name: "Sarah Johnson",
                        email: "sarah.j@email.com",
                        phone: "(555) 987-6543",
                        initials: "SJ"
                    };
                    break;
                case '3':
                    customerInfo = {
                        name: "Michael Brown",
                        email: "michael.b@email.com",
                        phone: "(555) 456-7890",
                        initials: "MB"
                    };
                    break;
                case '4':
                    customerInfo = {
                        name: "Alex Williams",
                        email: "alex.w@email.com",
                        phone: "(555) 321-0987",
                        initials: "AW"
                    };
                    break;
                case '5':
                    customerInfo = {
                        name: "Emily Davis",
                        email: "emily.d@email.com",
                        phone: "(555) 654-3210",
                        initials: "ED"
                    };
                    break;
            }
            
            // Get service info
            let serviceName = '';
            switch(serviceType.value) {
                case 'ac':
                    serviceName = 'AC Repair';
                    break;
                case 'plumbing':
                    serviceName = 'Plumbing';
                    break;
                case 'electrical':
                    serviceName = 'Electrical';
                    break;
                case 'painting':
                    serviceName = 'Painting';
                    break;
            }
            
            // Create new appointment
            const newAppointment = {
                id: appointments.length > 0 ? Math.max(...appointments.map(a => a.id)) + 1 : 1,
                customer: customerInfo,
                serviceType: serviceType.value,
                serviceName: serviceName,
                date: date,
                time: time,
                duration: 60, // Default duration
                status: 'pending',
                notes: notes,
                amount: 0, // Would calculate based on service
                createdAt: new Date().toISOString().split('T')[0]
            };
            
            // Add to appointments array
            appointments.unshift(newAppointment);
            
            // Update UI
            renderAppointments();
            updateStats();
            generateQuickCalendar();
            
            // Show success modal
            successTitle.textContent = 'Appointment Created!';
            successMessage.textContent = `Appointment for ${customerInfo.name} has been scheduled for ${new Date(date).toLocaleDateString()} at ${time}.`;
            successModal.classList.remove('hidden');
            
            // Reset form
            appointmentForm.reset();
            
            // Switch to pending tab
            switchTab('pending');
        }

        // View appointment details
        function viewAppointmentDetails(id) {
            const appointment = appointments.find(a => a.id === id);
            if (!appointment) return;
            
            // Format date
            const appointmentDate = new Date(appointment.date);
            const formattedDate = appointmentDate.toLocaleDateString('en-US', {
                weekday: 'long',
                month: 'long',
                day: 'numeric',
                year: 'numeric'
            });
            
            // Format time
            const [hours, minutes] = appointment.time.split(':');
            const formattedTime = new Date(0, 0, 0, hours, minutes).toLocaleTimeString('en-US', {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });
            
            // Status badge
            let statusBadgeClass = '';
            let statusText = '';
            
            switch(appointment.status) {
                case 'pending':
                    statusBadgeClass = 'status-pending';
                    statusText = 'Pending';
                    break;
                case 'confirmed':
                    statusBadgeClass = 'status-confirmed';
                    statusText = 'Confirmed';
                    break;
                case 'completed':
                    statusBadgeClass = 'status-completed';
                    statusText = 'Completed';
                    break;
                case 'cancelled':
                    statusBadgeClass = 'status-cancelled';
                    statusText = 'Cancelled';
                    break;
            }
            
            // Service badge
            let serviceBadgeClass = '';
            let serviceIcon = '';
            
            switch(appointment.serviceType) {
                case 'ac':
                    serviceBadgeClass = 'service-ac';
                    serviceIcon = 'fas fa-tools';
                    break;
                case 'plumbing':
                    serviceBadgeClass = 'service-plumbing';
                    serviceIcon = 'fas fa-faucet';
                    break;
                case 'electrical':
                    serviceBadgeClass = 'service-electrical';
                    serviceIcon = 'fas fa-bolt';
                    break;
                case 'painting':
                    serviceBadgeClass = 'service-painting';
                    serviceIcon = 'fas fa-paint-roller';
                    break;
            }
            
            appointmentDetailContent.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <div class="flex items-start mb-6">
                            <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-white font-semibold text-xl mr-4">
                                ${appointment.customer.initials}
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold">${appointment.customer.name}</h4>
                                <p class="text-gray-600 dark:text-gray-400">${appointment.customer.email}</p>
                                <p class="text-gray-600 dark:text-gray-400">${appointment.customer.phone}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Service</p>
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-md bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mr-2">
                                        <i class="${serviceIcon} text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                    <span class="font-medium">${appointment.serviceName}</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Status</p>
                                <span class="status-badge ${statusBadgeClass}">${statusText}</span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Date</p>
                                <p class="font-medium">${formattedDate}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Time</p>
                                <p class="font-medium">${formattedTime}</p>
                            </div>
                        </div>
                        
                        ${appointment.notes ? `
                        <div class="mb-6">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Notes</p>
                            <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                <p class="text-gray-700 dark:text-gray-300">${appointment.notes}</p>
                            </div>
                        </div>
                        ` : ''}
                    </div>
                    
                    <div class="md:col-span-1">
                        <div class="card p-4 mb-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Appointment Actions</p>
                            <div class="space-y-2">
                                ${appointment.status === 'pending' ? `
                                <button class="w-full btn-primary py-2 rounded-lg font-medium" onclick="confirmAppointment(${appointment.id})">
                                    <i class="fas fa-check mr-2"></i> Confirm
                                </button>
                                <button class="w-full btn-secondary py-2 rounded-lg font-medium" onclick="rescheduleAppointment(${appointment.id})">
                                    <i class="fas fa-calendar-alt mr-2"></i> Reschedule
                                </button>
                                ` : ''}
                                ${appointment.status === 'confirmed' ? `
                                <button class="w-full btn-primary py-2 rounded-lg font-medium" onclick="completeAppointment(${appointment.id})">
                                    <i class="fas fa-flag-checkered mr-2"></i> Mark Complete
                                </button>
                                ` : ''}
                                <button class="w-full btn-secondary py-2 rounded-lg font-medium text-red-600 dark:text-red-400" onclick="cancelAppointment(${appointment.id})">
                                    <i class="fas fa-times mr-2"></i> Cancel Appointment
                                </button>
                            </div>
                        </div>
                        
                        <div class="card p-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Quick Contact</p>
                            <div class="space-y-2">
                                <button class="w-full flex items-center justify-center space-x-2 py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:border-green-500 dark:hover:border-green-500 transition-colors" onclick="callCustomer('${appointment.customer.phone}')">
                                    <i class="fas fa-phone text-green-600 dark:text-green-400"></i>
                                    <span>Call Customer</span>
                                </button>
                                <button class="w-full flex items-center justify-center space-x-2 py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:border-blue-500 dark:hover:border-blue-500 transition-colors" onclick="emailCustomer('${appointment.customer.email}')">
                                    <i class="fas fa-envelope text-blue-600 dark:text-blue-400"></i>
                                    <span>Send Email</span>
                                </button>
                                <button class="w-full flex items-center justify-center space-x-2 py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:border-purple-500 dark:hover:border-purple-500 transition-colors" onclick="createInvoice(${appointment.id})">
                                    <i class="fas fa-file-invoice-dollar text-purple-600 dark:text-purple-400"></i>
                                    <span>Create Invoice</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            appointmentDetailModal.classList.remove('hidden');
        }

        // Generate quick calendar
        function generateQuickCalendar() {
            quickCalendar.innerHTML = '';
            
            // Update month display
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            currentMonthElement.textContent = `${monthNames[currentCalendarMonth]} ${currentCalendarYear}`;
            
            // Get first day of month
            const firstDay = new Date(currentCalendarYear, currentCalendarMonth, 1);
            const firstDayIndex = firstDay.getDay(); // 0 = Sunday, 1 = Monday, etc.
            
            // Get days in month
            const daysInMonth = new Date(currentCalendarYear, currentCalendarMonth + 1, 0).getDate();
            
            // Get today's date
            const today = new Date();
            const isCurrentMonth = today.getMonth() === currentCalendarMonth && today.getFullYear() === currentCalendarYear;
            
            // Add empty cells for days before the first day of the month
            for (let i = 0; i < firstDayIndex; i++) {
                const emptyDay = document.createElement('div');
                emptyDay.classList.add('h-8');
                quickCalendar.appendChild(emptyDay);
            }
            
            // Add days of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = document.createElement('div');
                dayElement.classList.add('calendar-day', 'text-sm');
                dayElement.textContent = day;
                
                // Mark today
                if (isCurrentMonth && day === today.getDate()) {
                    dayElement.classList.add('today');
                }
                
                // Check if day has appointments
                const hasAppointment = appointments.some(appointment => {
                    const appointmentDate = new Date(appointment.date);
                    return appointmentDate.getDate() === day && 
                           appointmentDate.getMonth() === currentCalendarMonth && 
                           appointmentDate.getFullYear() === currentCalendarYear;
                });
                
                if (hasAppointment) {
                    dayElement.classList.add('has-appointment');
                }
                
                // Add click event
                dayElement.addEventListener('click', () => {
                    // In a real app, this would filter appointments by date
                    console.log(`Selected date: ${currentCalendarYear}-${currentCalendarMonth + 1}-${day}`);
                });
                
                quickCalendar.appendChild(dayElement);
            }
        }

        // Appointment actions
        function completeAppointment(id) {
            const appointment = appointments.find(a => a.id === id);
            if (appointment) {
                appointment.status = 'completed';
                renderAppointments();
                updateStats();
                appointmentDetailModal.classList.add('hidden');
                showSuccess('Appointment marked as completed!');
            }
        }

        function confirmAppointment(id) {
            const appointment = appointments.find(a => a.id === id);
            if (appointment) {
                appointment.status = 'confirmed';
                renderAppointments();
                updateStats();
                appointmentDetailModal.classList.add('hidden');
                showSuccess('Appointment confirmed!');
            }
        }

        function cancelAppointment(id) {
            if (confirm('Are you sure you want to cancel this appointment? This action cannot be undone.')) {
                const appointment = appointments.find(a => a.id === id);
                if (appointment) {
                    appointment.status = 'cancelled';
                    renderAppointments();
                    updateStats();
                    appointmentDetailModal.classList.add('hidden');
                    showSuccess('Appointment cancelled.');
                }
            }
        }

        function deleteAppointment(id) {
            if (confirm('Are you sure you want to delete this appointment? This action cannot be undone.')) {
                const appointmentIndex = appointments.findIndex(a => a.id === id);
                if (appointmentIndex !== -1) {
                    appointments.splice(appointmentIndex, 1);
                    renderAppointments();
                    updateStats();
                    showSuccess('Appointment deleted.');
                }
            }
        }

        function editAppointment(id) {
            const appointment = appointments.find(a => a.id === id);
            if (appointment) {
                // In a real app, this would populate the form with appointment data
                alert(`Editing appointment for ${appointment.customer.name}. In a real app, this would open the form with pre-filled data.`);
            }
        }

        function rescheduleAppointment(id) {
            const appointment = appointments.find(a => a.id === id);
            if (appointment) {
                alert(`Rescheduling appointment for ${appointment.customer.name}. In a real app, this would open a rescheduling modal.`);
            }
        }

        function callCustomer(phone) {
            alert(`Calling ${phone}. In a real app, this would initiate a phone call.`);
        }

        function emailCustomer(email) {
            alert(`Opening email composer for ${email}. In a real app, this would open your email client.`);
        }

        function createInvoice(id) {
            const appointment = appointments.find(a => a.id === id);
            if (appointment) {
                alert(`Creating invoice for ${appointment.customer.name}. In a real app, this would open the invoice creation form.`);
            }
        }

        function showSuccess(message) {
            successTitle.textContent = 'Success!';
            successMessage.textContent = message;
            successModal.classList.remove('hidden');
        }

        function showError(message) {
            alert(`Error: ${message}`);
        }

        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.querySelector('.mobile-menu');
            mobileMenu.classList.toggle('active');
        }
    </script>
</body>
</html>