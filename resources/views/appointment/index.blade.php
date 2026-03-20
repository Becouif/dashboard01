<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServiceDash | Appointment Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
      <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=DM+Mono:wght@400&display=swap" rel="stylesheet"/>
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

        /* start of list styling  */
          body { font-family: 'DM Sans', sans-serif; }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(6px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    tbody tr:nth-child(1) { animation: fadeInUp 0.2s ease 0.05s both; }
    tbody tr:nth-child(2) { animation: fadeInUp 0.2s ease 0.10s both; }
    tbody tr:nth-child(3) { animation: fadeInUp 0.2s ease 0.15s both; }
    tbody tr:nth-child(4) { animation: fadeInUp 0.2s ease 0.20s both; }
    tbody tr:nth-child(5) { animation: fadeInUp 0.2s ease 0.25s both; }
    </style>
</head>
<body class="min-h-screen">
    <!-- Dashboard Container -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="hidden lg:flex flex-col w-64 min-h-screen border-r border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
            <!-- Logo -->
            @include('layouts.brand')

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
                    @include('layouts.nav')
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
                            <a href="#appointment-form"><button id="openAppointmentModal" class="btn-primary px-4 py-2 rounded-lg font-medium flex items-center space-x-2">
                                <i class="fas fa-plus"></i>
                                <span>New Appointment</span>
                            </button></a>
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
                    <div class="lg:col-span-1" id="appointment-form">
                        <div class="card p-6">
                            <h3 class="text-lg font-semibold mb-6">Create New Appointment</h3>
                            
                            <form id="appointmentForm" action="{{route('appointment.save')}}" method="POST" >@csrf
                                <!-- Customer Selection -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Customer</label>
                                    <select name="customer" id="customerSelect" class="@error('customer')
                                        is-invalid
                                    @enderror w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent">
                                        <option value="">Select a customer</option>
                                        @foreach ($customers as $key=>$customer)
                                        <option  value="{{$customer->id}}">{{ $customer->first_name }} {{ $customer->last_name }} {{ $customer->email }}</option>
                                        @endforeach
                                    </select>
                                    @error('customer')
                                        <p style="color:red;">{{$message}}</p>
                                    @enderror
                                </div>

                                <!-- Service Type -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Service Type</label>
                                    <!-- start of foreach for services list  -->

                                    <div class="grid grid-cols-2 gap-2">
 
                                        @foreach ($services as $key=>$service)
                                        <label class="flex items-center p-3 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-purple-300 dark:hover:border-purple-700 transition-colors">
                                            <input type="radio" name="service" value="{{$service->id}}" class="mr-3">
                                            <div class="flex items-center flex-1">
                                                <div class="w-8 h-8 rounded-md bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center mr-2">
                                                    <i class="fas fa-faucet text-purple-600 dark:text-purple-400"></i>
                                                </div>
                                                <span class="font-medium">{{$service->name}}</span>
                                            </div>
                                        </label>
                                        @endforeach
                                        @error('service')
                                            <p style="color:red;">{{$message}}</p>
                                        @enderror
                                    </div>
                                    
                                </div>

                                <!-- Date & Time -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date & Time</label>
                                    <div class="grid grid-cols-2 gap-3">
                                        <input type="date" name="date" id="appointmentDate" class="@error('date')
                                            is-invalid
                                        @enderror py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent">
                                        @error('date')
                                        <p style="color:red;">{{$message}}</p>
                                            
                                        @enderror
                                        <input type="time" name="time" id="appointmentTime" class="@error('time')
                                            is-invalid
                                        @enderror py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent">
                                        @error('time')
                                            <p style="color:red;">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Duration -->
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Duration</label>
                                    <div class="grid grid-cols-4 gap-2">
                                        
                                        <button type="button" class="duration-btn py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-700" data-duration="30">30 min <input type="hidden" name="duration"  value="30"></button>
                                        <button type="button" class="duration-btn py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-700" data-duration="60">1 hour <input type="hidden" name="duration" value="60"></button>
                                        <button type="button" class="duration-btn py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-700" data-duration="90">1.5 hours <input type="hidden" name="duration" value="90"></button>
                                        <button type="button"  class="duration-btn py-2 rounded-lg border border-gray-300 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-700" data-duration="120">2 hours <input type="hidden" name="duration" value="120"></button>
                                    </div>
                                    @error('duration')
                                        <p style="color:red;">{{$message}}</p>
                                    @enderror
                                </div>

                                <!-- Notes -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notes</label>
                                    <textarea id="appointmentNotes" name="note" rows="3" class=" @error('note')
                                        is-invalid
                                    @enderror px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent" placeholder="Add any special instructions or notes...">{{old('note')}}</textarea>
                                    @error('note')
                                        <p style="color:red;">{{$message}}</p>
                                    @enderror
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
                        <!-- appointment list go here -->
                         @if(count($appointments)> 0)
                            <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                        
                                <!-- Head -->
                                <thead>
                                <tr class="border-b border-gray-800">
                                    <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider px-5 py-3">Customer</th>
                                    <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider px-4 py-3">Date</th>
                                    <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider px-4 py-3">Time</th>
                                    <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider px-4 py-3">Service</th>
                                    <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider px-4 py-3">Price</th>
                                    <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider px-4 py-3">Payment Status</th>
                                    <th class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider px-4 py-3">Notes</th>
                                    <th class="px-5 py-3"></th>
                                </tr>
                                </thead>
                        
                                <!-- Body -->
                                <tbody class="divide-y divide-gray-800/60">
                                @foreach ($appointments as $key=>$appointment)
                                <!-- Row 1 -->
                                <tr class="group hover:bg-gray-50 transition-colors">
                                    <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-900 text-blue-300 flex items-center justify-center text-xs font-semibold shrink-0">EJ</div>
                                        <div>
                                        <p class="font-medium text-gray-800 leading-tight">Emma Johnson</p>
                                        <p class="text-xs text-gray-400 font-mono">APT-001</p>
                                        </div>
                                    </div>
                                    </td>
                                    <td class="px-4 py-3.5 text-gray-500">Mar 21, 2026</td>
                                    <td class="px-4 py-3.5 text-gray-700">:00 AM</td>
                                    <td class="px-4 py-3.5">
                                    <span class="inline-flex items-center gap-1.5 text-gray-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-400 shrink-0"></span>Check-up
                                    </span>
                                    </td>
                                    
                                    <td class="px-4 py-3.5 text-gray-400">Price</td>
                                    <td class="px-4 py-3.5">
                                    <span class="inline-flex items-center text-xs font-medium px-2.5 py-1 rounded-full bg-green-900/60 text-green-300 border border-green-800/60">Confirmed</span>
                                    </td>
                                    <td class="px-4 py-3.5 text-gray-400">Note</td>
                                    <td class="px-5 py-3.5 text-right">
                                    <button class="opacity-0 group-hover:opacity-100 text-xs text-gray-500 hover:text-gray-700 border border-gray-200 hover:border-gray-400 px-2.5 py-1 rounded-md transition-all">View</button>
                                    </td>
                                </tr> 
                                @endforeach
                                
                        
                                </tbody>
                            </table>
                        </div>

                    
                        <!-- Card footer -->
                        <div class="px-5 py-3 border-t border-gray-800 flex items-center justify-between">
                        <p class="text-xs text-gray-600">Showing 5 of 5 appointments</p>
                        <div class="flex items-center gap-1">
                            <button class="text-xs text-gray-500 hover:text-gray-300 border border-gray-800 hover:border-gray-700 px-2.5 py-1 rounded-md transition-colors">Previous</button>
                            <button class="text-xs text-gray-500 hover:text-gray-300 border border-gray-800 hover:border-gray-700 px-2.5 py-1 rounded-md transition-colors">Next</button>
                        </div>
                        </div>
                        @else 
                        <div>no appointment yet</div>
                        @endif
                    
                    </div>
                        <!-- end of d fist  -->
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

    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: {
            sans: ['DM Sans', 'sans-serif'],
            mono: ['DM Mono', 'monospace'],
          }
        }
      }
    }
  
 
  

  

        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.querySelector('.mobile-menu');
            mobileMenu.classList.toggle('active');
        }
    </script>
</body>
</html>