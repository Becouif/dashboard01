<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServiceDash | Revenue & Financial Analytics</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .status-paid {
            background-color: rgba(34, 197, 94, 0.1);
            color: rgb(21, 128, 61);
        }

        .dark .status-paid {
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

        .status-overdue {
            background-color: rgba(239, 68, 68, 0.1);
            color: rgb(185, 28, 28);
        }

        .dark .status-overdue {
            background-color: rgba(239, 68, 68, 0.2);
            color: rgb(248, 113, 113);
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

        /* Custom chart styling */
        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }

        /* Revenue trend indicators */
        .trend-up {
            color: #10b981;
        }

        .trend-down {
            color: #ef4444;
        }

        .trend-neutral {
            color: #6b7280;
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

        /* Mobile menu */
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.active {
            transform: translateX(0);
        }

        /* Transaction table styling */
        .transaction-table tr {
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.2s ease;
        }

        .transaction-table tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .dark .transaction-table tr:hover {
            background-color: rgba(67, 97, 238, 0.1);
        }

        /* Payment method icons */
        .payment-method {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
        }

        .payment-cash {
            background-color: rgba(16, 185, 129, 0.1);
            color: rgb(6, 95, 70);
        }

        .payment-card {
            background-color: rgba(59, 130, 246, 0.1);
            color: rgb(29, 78, 216);
        }

        .payment-bank {
            background-color: rgba(168, 85, 247, 0.1);
            color: rgb(126, 34, 206);
        }

        .payment-online {
            background-color: rgba(245, 158, 11, 0.1);
            color: rgb(180, 83, 9);
        }

        /* Revenue comparison bars */
        .comparison-bar {
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
        }

        .comparison-current {
            background: linear-gradient(90deg, #4361ee, #3a56d4);
        }

        .comparison-previous {
            background: linear-gradient(90deg, #9ca3af, #6b7280);
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
                        <p class="text-xs text-gray-500 dark:text-gray-400">Revenue Analytics</p>
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
                                <h2 class="text-xl font-semibold">Revenue & Financial Analytics</h2>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Track income, expenses, and financial performance</p>
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
                            
                            <!-- Date Range Selector -->
                            <div class="relative">
                                <select class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent">
                                    <option>This Month</option>
                                    <option>Last Month</option>
                                    <option>Last Quarter</option>
                                    <option>Last Year</option>
                                    <option>Custom Range</option>
                                </select>
                                <i class="fas fa-calendar absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                            
                            <!-- Export Button -->
                            <button class="btn-primary px-4 py-2 rounded-lg font-medium flex items-center space-x-2">
                                <i class="fas fa-file-export"></i>
                                <span>Export Report</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Revenue Summary -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Revenue -->
                    <div class="card p-6 animate-slide-up" style="animation-delay: 0.1s">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Total Revenue</p>
                                <h3 class="text-3xl font-bold mt-2">$24,580</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-green-600 dark:text-green-400 text-sm font-medium">
                                        <i class="fas fa-arrow-up mr-1"></i> 12.5%
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                                <i class="fas fa-money-bill-wave text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Year-to-date</span>
                                <span class="font-medium">$128,450</span>
                            </div>
                        </div>
                    </div>

                    <!-- Average Transaction -->
                    <div class="card p-6 animate-slide-up" style="animation-delay: 0.2s">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Avg. Transaction</p>
                                <h3 class="text-3xl font-bold mt-2">$245</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-green-600 dark:text-green-400 text-sm font-medium">
                                        <i class="fas fa-arrow-up mr-1"></i> 8.2%
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center">
                                <i class="fas fa-chart-bar text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Largest transaction</span>
                                <span class="font-medium">$1,850</span>
                            </div>
                        </div>
                    </div>

                    <!-- Outstanding Payments -->
                    <div class="card p-6 animate-slide-up" style="animation-delay: 0.3s">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Outstanding</p>
                                <h3 class="text-3xl font-bold mt-2">$4,250</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-red-600 dark:text-red-400 text-sm font-medium">
                                        <i class="fas fa-arrow-down mr-1"></i> 15.3%
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center">
                                <i class="fas fa-clock text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Overdue payments</span>
                                <span class="font-medium">$850</span>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue Target -->
                    <div class="card p-6 animate-slide-up" style="animation-delay: 0.4s">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Monthly Target</p>
                                <h3 class="text-3xl font-bold mt-2">82%</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-green-600 dark:text-green-400 text-sm font-medium">
                                        On track
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">+12 days remaining</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center">
                                <i class="fas fa-bullseye text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Target: $30,000</span>
                                <span class="font-medium">$24,580 / $30,000</span>
                            </div>
                            <div class="mt-2 w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-purple-500 to-pink-600 rounded-full" style="width: 82%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revenue Charts & Metrics -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Revenue Trend Chart -->
                    <div class="lg:col-span-2 card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h3 class="text-lg font-semibold">Revenue Trend</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Monthly revenue performance</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="tab-button text-sm active">Monthly</button>
                                <button class="tab-button text-sm">Quarterly</button>
                                <button class="tab-button text-sm">Yearly</button>
                            </div>
                        </div>
                        
                        <div class="chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">This Month</p>
                                    <p class="text-xl font-bold">$8,450</p>
                                    <p class="text-xs text-green-600 dark:text-green-400">
                                        <i class="fas fa-arrow-up mr-1"></i> 18.2%
                                    </p>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Last Month</p>
                                    <p class="text-xl font-bold">$7,150</p>
                                    <p class="text-xs text-green-600 dark:text-green-400">
                                        <i class="fas fa-arrow-up mr-1"></i> 5.3%
                                    </p>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Projected Next Month</p>
                                    <p class="text-xl font-bold">$9,200</p>
                                    <p class="text-xs text-blue-600 dark:text-blue-400">
                                        <i class="fas fa-chart-line mr-1"></i> +8.9%
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue by Service -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold">Revenue by Service</h3>
                            <button class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                                View Details
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <!-- AC Repair -->
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-md bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mr-2">
                                            <i class="fas fa-tools text-blue-600 dark:text-blue-400 text-sm"></i>
                                        </div>
                                        <span class="font-medium">AC Repair</span>
                                    </div>
                                    <span class="font-bold">$8,240</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 dark:text-gray-400">33% of total revenue</span>
                                    <span class="text-green-600 dark:text-green-400">+12.5%</span>
                                </div>
                                <div class="mt-1 w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-600 rounded-full" style="width: 33%"></div>
                                </div>
                            </div>
                            
                            <!-- Plumbing -->
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-md bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center mr-2">
                                            <i class="fas fa-faucet text-purple-600 dark:text-purple-400 text-sm"></i>
                                        </div>
                                        <span class="font-medium">Plumbing</span>
                                    </div>
                                    <span class="font-bold">$6,850</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 dark:text-gray-400">28% of total revenue</span>
                                    <span class="text-green-600 dark:text-green-400">+8.2%</span>
                                </div>
                                <div class="mt-1 w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-purple-500 to-pink-600 rounded-full" style="width: 28%"></div>
                                </div>
                            </div>
                            
                            <!-- Electrical -->
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-md bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center mr-2">
                                            <i class="fas fa-bolt text-yellow-600 dark:text-yellow-400 text-sm"></i>
                                        </div>
                                        <span class="font-medium">Electrical</span>
                                    </div>
                                    <span class="font-bold">$5,420</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 dark:text-gray-400">22% of total revenue</span>
                                    <span class="text-green-600 dark:text-green-400">+15.7%</span>
                                </div>
                                <div class="mt-1 w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-yellow-500 to-orange-600 rounded-full" style="width: 22%"></div>
                                </div>
                            </div>
                            
                            <!-- Painting -->
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-md bg-green-100 dark:bg-green-900/30 flex items-center justify-center mr-2">
                                            <i class="fas fa-paint-roller text-green-600 dark:text-green-400 text-sm"></i>
                                        </div>
                                        <span class="font-medium">Painting</span>
                                    </div>
                                    <span class="font-bold">$4,070</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600 dark:text-gray-400">17% of total revenue</span>
                                    <span class="text-red-600 dark:text-red-400">-3.2%</span>
                                </div>
                                <div class="mt-1 w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-green-500 to-emerald-600 rounded-full" style="width: 17%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Total Service Revenue</p>
                                <p class="font-bold">$24,580</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transaction History & Payment Methods -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Recent Transactions -->
                    <div class="lg:col-span-2 card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h3 class="text-lg font-semibold">Recent Transactions</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Latest payments and invoices</p>
                            </div>
                            <button class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                                View All <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full transaction-table">
                                <thead>
                                    <tr class="text-left text-sm font-medium text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700">
                                        <th class="pb-3 px-4 pt-4">Customer</th>
                                        <th class="pb-3 px-4 pt-4">Service</th>
                                        <th class="pb-3 px-4 pt-4">Date</th>
                                        <th class="pb-3 px-4 pt-4">Amount</th>
                                        <th class="pb-3 px-4 pt-4">Status</th>
                                        <th class="pb-3 px-4 pt-4">Payment</th>
                                    </tr>
                                </thead>
                                <tbody id="transactionsTable">
                                    <!-- Transactions will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Empty State -->
                        <div id="emptyTransactions" class="text-center py-12 hidden">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full mb-4">
                                <i class="fas fa-receipt text-gray-400 text-2xl"></i>
                            </div>
                            <h4 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-2">No transactions found</h4>
                            <p class="text-gray-600 dark:text-gray-400">Transactions will appear here as they occur</p>
                        </div>
                    </div>

                    <!-- Payment Methods & Quick Stats -->
                    <div class="space-y-6">
                        <!-- Payment Methods -->
                        <div class="card p-6">
                            <h3 class="text-lg font-semibold mb-6">Payment Methods</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="flex items-center">
                                            <div class="payment-method payment-cash mr-3">
                                                <i class="fas fa-money-bill"></i>
                                            </div>
                                            <span class="font-medium">Cash</span>
                                        </div>
                                        <span class="font-bold">42%</span>
                                    </div>
                                    <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-green-500 to-emerald-600 rounded-full" style="width: 42%"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="flex items-center">
                                            <div class="payment-method payment-card mr-3">
                                                <i class="fas fa-credit-card"></i>
                                            </div>
                                            <span class="font-medium">Credit/Debit Card</span>
                                        </div>
                                        <span class="font-bold">35%</span>
                                    </div>
                                    <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-600 rounded-full" style="width: 35%"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="flex items-center">
                                            <div class="payment-method payment-bank mr-3">
                                                <i class="fas fa-university"></i>
                                            </div>
                                            <span class="font-medium">Bank Transfer</span>
                                        </div>
                                        <span class="font-bold">18%</span>
                                    </div>
                                    <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-purple-500 to-pink-600 rounded-full" style="width: 18%"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="flex items-center">
                                            <div class="payment-method payment-online mr-3">
                                                <i class="fas fa-globe"></i>
                                            </div>
                                            <span class="font-medium">Online Payment</span>
                                        </div>
                                        <span class="font-bold">5%</span>
                                    </div>
                                    <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-yellow-500 to-orange-600 rounded-full" style="width: 5%"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Avg. Payment Time</p>
                                    <p class="font-bold">3.2 days</p>
                                </div>
                            </div>
                        </div>

                        <!-- Revenue Comparison -->
                        <div class="card p-6">
                            <h3 class="text-lg font-semibold mb-6">Monthly Comparison</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600 dark:text-gray-400">This Month</span>
                                        <span class="font-medium">$8,450</span>
                                    </div>
                                    <div class="comparison-bar">
                                        <div class="comparison-current h-full rounded-full" style="width: 100%"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600 dark:text-gray-400">Last Month</span>
                                        <span class="font-medium">$7,150</span>
                                    </div>
                                    <div class="comparison-bar">
                                        <div class="comparison-previous h-full rounded-full" style="width: 84.6%"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600 dark:text-gray-400">Same Month Last Year</span>
                                        <span class="font-medium">$6,820</span>
                                    </div>
                                    <div class="comparison-bar">
                                        <div class="comparison-previous h-full rounded-full" style="width: 80.7%"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Growth Rate</p>
                                        <p class="text-lg font-bold text-green-600 dark:text-green-400">+18.2%</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">YoY Growth</p>
                                        <p class="text-lg font-bold text-green-600 dark:text-green-400">+23.9%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Customers & Invoices -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Top Customers by Revenue -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h3 class="text-lg font-semibold">Top Customers</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Highest revenue contributors</p>
                            </div>
                            <button class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                                View All
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <!-- Customer 1 -->
                            <div class="flex items-center p-3 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-white font-semibold mr-3">
                                    JS
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium">John Smith</p>
                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-tools mr-2"></i>
                                        <span>AC Repair</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">$3,450</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">5 services</p>
                                </div>
                            </div>
                            
                            <!-- Customer 2 -->
                            <div class="flex items-center p-3 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-white font-semibold mr-3">
                                    SJ
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium">Sarah Johnson</p>
                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-faucet mr-2"></i>
                                        <span>Plumbing</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">$2,980</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">4 services</p>
                                </div>
                            </div>
                            
                            <!-- Customer 3 -->
                            <div class="flex items-center p-3 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center text-white font-semibold mr-3">
                                    MB
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium">Michael Brown</p>
                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-bolt mr-2"></i>
                                        <span>Electrical</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">$2,750</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">3 services</p>
                                </div>
                            </div>
                            
                            <!-- Customer 4 -->
                            <div class="flex items-center p-3 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white font-semibold mr-3">
                                    AW
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium">Alex Williams</p>
                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-paint-roller mr-2"></i>
                                        <span>Painting</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">$2,150</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">2 services</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Top 4 customers revenue</p>
                                <p class="font-bold">$11,330</p>
                            </div>
                        </div>
                    </div>

                    <!-- Outstanding Invoices -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h3 class="text-lg font-semibold">Outstanding Invoices</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Pending and overdue payments</p>
                            </div>
                            <button class="btn-primary px-4 py-2 rounded-lg font-medium text-sm">
                                <i class="fas fa-plus mr-2"></i> Create Invoice
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <!-- Invoice 1 -->
                            <div class="flex items-center justify-between p-3 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div>
                                    <p class="font-medium">INV-2023-045</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">John Smith • AC Repair</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">$450</p>
                                    <span class="status-badge status-overdue">Overdue</span>
                                </div>
                            </div>
                            
                            <!-- Invoice 2 -->
                            <div class="flex items-center justify-between p-3 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div>
                                    <p class="font-medium">INV-2023-046</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Sarah Johnson • Plumbing</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">$320</p>
                                    <span class="status-badge status-pending">Due in 3 days</span>
                                </div>
                            </div>
                            
                            <!-- Invoice 3 -->
                            <div class="flex items-center justify-between p-3 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div>
                                    <p class="font-medium">INV-2023-047</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Michael Brown • Electrical</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">$680</p>
                                    <span class="status-badge status-pending">Due in 7 days</span>
                                </div>
                            </div>
                            
                            <!-- Invoice 4 -->
                            <div class="flex items-center justify-between p-3 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div>
                                    <p class="font-medium">INV-2023-048</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Alex Williams • Painting</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">$1,250</p>
                                    <span class="status-badge status-pending">Due in 14 days</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Total outstanding</p>
                                <p class="font-bold">$2,700</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Revenue Detail Modal -->
    <div id="revenueDetailModal" class="fixed inset-0 z-50 flex items-center justify-center hidden" style="background-color: rgba(0, 0, 0, 0.5); backdrop-filter: blur(4px);">
        <div class="card w-full max-w-2xl m-4">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold">Transaction Details</h3>
                    <button id="closeRevenueModal" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-6" id="revenueDetailContent">
                <!-- Revenue details will be loaded here -->
            </div>
        </div>
    </div>

    <script>
        // Sample transaction data
        const sampleTransactions = [
            {
                id: 1,
                customer: {
                    name: "John Smith",
                    initials: "JS"
                },
                service: "AC Repair",
                serviceType: "ac",
                date: "2023-11-15",
                amount: 450,
                status: "paid",
                paymentMethod: "cash",
                invoiceId: "INV-2023-045"
            },
            {
                id: 2,
                customer: {
                    name: "Sarah Johnson",
                    initials: "SJ"
                },
                service: "Plumbing Inspection",
                serviceType: "plumbing",
                date: "2023-11-14",
                amount: 320,
                status: "pending",
                paymentMethod: "card",
                invoiceId: "INV-2023-046"
            },
            {
                id: 3,
                customer: {
                    name: "Michael Brown",
                    initials: "MB"
                },
                service: "Electrical Wiring",
                serviceType: "electrical",
                date: "2023-11-13",
                amount: 680,
                status: "paid",
                paymentMethod: "bank",
                invoiceId: "INV-2023-047"
            },
            {
                id: 4,
                customer: {
                    name: "Alex Williams",
                    initials: "AW"
                },
                service: "Interior Painting",
                serviceType: "painting",
                date: "2023-11-12",
                amount: 1250,
                status: "paid",
                paymentMethod: "online",
                invoiceId: "INV-2023-048"
            },
            {
                id: 5,
                customer: {
                    name: "Emily Davis",
                    initials: "ED"
                },
                service: "AC Maintenance",
                serviceType: "ac",
                date: "2023-11-11",
                amount: 120,
                status: "overdue",
                paymentMethod: "cash",
                invoiceId: "INV-2023-049"
            },
            {
                id: 6,
                customer: {
                    name: "Robert Wilson",
                    initials: "RW"
                },
                service: "Water Heater Repair",
                serviceType: "plumbing",
                date: "2023-11-10",
                amount: 275,
                status: "paid",
                paymentMethod: "card",
                invoiceId: "INV-2023-050"
            },
            {
                id: 7,
                customer: {
                    name: "Lisa Anderson",
                    initials: "LA"
                },
                service: "Light Fixture Installation",
                serviceType: "electrical",
                date: "2023-11-09",
                amount: 195,
                status: "pending",
                paymentMethod: "bank",
                invoiceId: "INV-2023-051"
            }
        ];

        // State management
        let transactions = [...sampleTransactions];

        // DOM Elements
        const themeToggle = document.getElementById('themeToggle');
        const htmlElement = document.documentElement;
        const transactionsTable = document.getElementById('transactionsTable');
        const emptyTransactions = document.getElementById('emptyTransactions');
        const revenueDetailModal = document.getElementById('revenueDetailModal');
        const revenueDetailContent = document.getElementById('revenueDetailContent');
        const closeRevenueModal = document.getElementById('closeRevenueModal');

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            // Load transactions
            renderTransactions();
            initializeRevenueChart();
            
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
            
            // Tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.addEventListener('click', function() {
                    document.querySelectorAll('.tab-button').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    this.classList.add('active');
                    
                    // In a real app, this would update the chart data
                    console.log(`Switched to ${this.textContent} view`);
                });
            });
            
            // Modal close
            closeRevenueModal.addEventListener('click', () => {
                revenueDetailModal.classList.add('hidden');
            });
            
            // Close modal when clicking outside
            revenueDetailModal.addEventListener('click', (e) => {
                if (e.target === revenueDetailModal) {
                    revenueDetailModal.classList.add('hidden');
                }
            });
            
            // Add smooth loading animation for stats cards
            const statsCards = document.querySelectorAll('.animate-slide-up');
            statsCards.forEach((card, index) => {
                card.style.animationDelay = `${(index + 1) * 0.1}s`;
            });
        });

        // Render transactions
        function renderTransactions() {
            transactionsTable.innerHTML = '';
            
            if (transactions.length === 0) {
                emptyTransactions.classList.remove('hidden');
                return;
            }
            
            emptyTransactions.classList.add('hidden');
            
            // Sort by date (newest first)
            transactions.sort((a, b) => new Date(b.date) - new Date(a.date));
            
            // Render transaction rows
            transactions.forEach(transaction => {
                const row = document.createElement('tr');
                
                // Format date
                const transactionDate = new Date(transaction.date);
                const formattedDate = transactionDate.toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric'
                });
                
                // Status badge
                let statusBadgeClass = '';
                let statusText = '';
                
                switch(transaction.status) {
                    case 'paid':
                        statusBadgeClass = 'status-paid';
                        statusText = 'Paid';
                        break;
                    case 'pending':
                        statusBadgeClass = 'status-pending';
                        statusText = 'Pending';
                        break;
                    case 'overdue':
                        statusBadgeClass = 'status-overdue';
                        statusText = 'Overdue';
                        break;
                }
                
                // Service badge
                let serviceBadgeClass = '';
                switch(transaction.serviceType) {
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
                
                // Payment method
                let paymentMethodClass = '';
                let paymentMethodIcon = '';
                let paymentMethodText = '';
                
                switch(transaction.paymentMethod) {
                    case 'cash':
                        paymentMethodClass = 'payment-cash';
                        paymentMethodIcon = 'fas fa-money-bill';
                        paymentMethodText = 'Cash';
                        break;
                    case 'card':
                        paymentMethodClass = 'payment-card';
                        paymentMethodIcon = 'fas fa-credit-card';
                        paymentMethodText = 'Card';
                        break;
                    case 'bank':
                        paymentMethodClass = 'payment-bank';
                        paymentMethodIcon = 'fas fa-university';
                        paymentMethodText = 'Bank';
                        break;
                    case 'online':
                        paymentMethodClass = 'payment-online';
                        paymentMethodIcon = 'fas fa-globe';
                        paymentMethodText = 'Online';
                        break;
                }
                
                row.innerHTML = `
                    <td class="px-4 py-3">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-white font-semibold text-xs mr-2">
                                ${transaction.customer.initials}
                            </div>
                            <span class="font-medium">${transaction.customer.name}</span>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <span class="service-badge ${serviceBadgeClass}">${transaction.service}</span>
                    </td>
                    <td class="px-4 py-3 text-gray-600 dark:text-gray-400">${formattedDate}</td>
                    <td class="px-4 py-3 font-bold">$${transaction.amount}</td>
                    <td class="px-4 py-3">
                        <span class="status-badge ${statusBadgeClass}">${statusText}</span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center">
                            <div class="payment-method ${paymentMethodClass} mr-2">
                                <i class="${paymentMethodIcon}"></i>
                            </div>
                            <span>${paymentMethodText}</span>
                        </div>
                    </td>
                `;
                
                // Add click event to view details
                row.addEventListener('click', () => {
                    viewTransactionDetails(transaction.id);
                });
                
                transactionsTable.appendChild(row);
            });
        }

        // View transaction details
        function viewTransactionDetails(id) {
            const transaction = transactions.find(t => t.id === id);
            if (!transaction) return;
            
            // Format date
            const transactionDate = new Date(transaction.date);
            const formattedDate = transactionDate.toLocaleDateString('en-US', {
                weekday: 'long',
                month: 'long',
                day: 'numeric',
                year: 'numeric'
            });
            
            // Status badge
            let statusBadgeClass = '';
            let statusText = '';
            
            switch(transaction.status) {
                case 'paid':
                    statusBadgeClass = 'status-paid';
                    statusText = 'Paid';
                    break;
                case 'pending':
                    statusBadgeClass = 'status-pending';
                    statusText = 'Pending';
                    break;
                case 'overdue':
                    statusBadgeClass = 'status-overdue';
                    statusText = 'Overdue';
                    break;
            }
            
            // Payment method
            let paymentMethodClass = '';
            let paymentMethodIcon = '';
            let paymentMethodText = '';
            
            switch(transaction.paymentMethod) {
                case 'cash':
                    paymentMethodClass = 'payment-cash';
                    paymentMethodIcon = 'fas fa-money-bill';
                    paymentMethodText = 'Cash Payment';
                    break;
                case 'card':
                    paymentMethodClass = 'payment-card';
                    paymentMethodIcon = 'fas fa-credit-card';
                    paymentMethodText = 'Credit/Debit Card';
                    break;
                case 'bank':
                    paymentMethodClass = 'payment-bank';
                    paymentMethodIcon = 'fas fa-university';
                    paymentMethodText = 'Bank Transfer';
                    break;
                case 'online':
                    paymentMethodClass = 'payment-online';
                    paymentMethodIcon = 'fas fa-globe';
                    paymentMethodText = 'Online Payment';
                    break;
            }
            
            revenueDetailContent.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="flex items-start mb-6">
                            <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-white font-semibold text-xl mr-4">
                                ${transaction.customer.initials}
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold">${transaction.customer.name}</h4>
                                <p class="text-gray-600 dark:text-gray-400">${transaction.service}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Invoice ID</p>
                                <p class="font-medium">${transaction.invoiceId}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Transaction Date</p>
                                <p class="font-medium">${formattedDate}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Payment Method</p>
                                <div class="flex items-center">
                                    <div class="payment-method ${paymentMethodClass} mr-2">
                                        <i class="${paymentMethodIcon}"></i>
                                    </div>
                                    <span class="font-medium">${paymentMethodText}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="mb-6">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Amount</p>
                            <p class="text-3xl font-bold">$${transaction.amount}</p>
                            <span class="status-badge ${statusBadgeClass}">${statusText}</span>
                        </div>
                        
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Service Fee</span>
                                <span>$${(transaction.amount * 0.85).toFixed(2)}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Tax (10%)</span>
                                <span>$${(transaction.amount * 0.10).toFixed(2)}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Processing Fee</span>
                                <span>$${(transaction.amount * 0.05).toFixed(2)}</span>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-2 mt-2">
                                <div class="flex justify-between font-bold">
                                    <span>Total</span>
                                    <span>$${transaction.amount}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex space-x-3">
                                <button class="btn-primary px-4 py-2 rounded-lg font-medium flex-1">
                                    <i class="fas fa-print mr-2"></i> Print Receipt
                                </button>
                                <button class="btn-secondary px-4 py-2 rounded-lg font-medium flex-1">
                                    <i class="fas fa-envelope mr-2"></i> Email Receipt
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            revenueDetailModal.classList.remove('hidden');
        }

        // Initialize revenue chart
        function initializeRevenueChart() {
            const ctx = document.getElementById('revenueChart');
            if (!ctx) return;
            
            // Create a simple chart using div elements (no external chart library)
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const revenueData = [5200, 5800, 6200, 7100, 7800, 8200, 8900, 8400, 9200, 8700, 8450, 9200];
            const previousYearData = [4800, 5200, 5800, 6100, 6500, 7200, 7800, 7500, 8100, 7900, 6820, 7500];
            
            const maxRevenue = Math.max(...revenueData, ...previousYearData);
            
            // Create chart bars
            const chartContainer = document.querySelector('.chart-container');
            if (chartContainer) {
                chartContainer.innerHTML = '';
                
                const chartBars = document.createElement('div');
                chartBars.className = 'flex items-end justify-between h-full pt-8';
                
                months.forEach((month, index) => {
                    const barContainer = document.createElement('div');
                    barContainer.className = 'flex flex-col items-center flex-1 mx-1';
                    
                    const currentHeight = (revenueData[index] / maxRevenue) * 100;
                    const previousHeight = (previousYearData[index] / maxRevenue) * 100;
                    
                    barContainer.innerHTML = `
                        <div class="flex flex-col items-center w-full h-full">
                            <div class="relative w-3/4 flex justify-center">
                                <div class="absolute bottom-0 w-2 bg-gray-300 dark:bg-gray-600 rounded-t" style="height: ${previousHeight}%"></div>
                                <div class="absolute bottom-0 w-4 bg-gradient-to-t from-blue-500 to-cyan-600 rounded-t" style="height: ${currentHeight}%"></div>
                            </div>
                            <div class="mt-2 text-xs text-gray-600 dark:text-gray-400">${month}</div>
                        </div>
                    `;
                    
                    chartBars.appendChild(barContainer);
                });
                
                chartContainer.appendChild(chartBars);
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