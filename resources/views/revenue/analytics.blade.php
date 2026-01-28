<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServiceDash | Analytics & Business Intelligence</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        /* KPI Cards */
        .kpi-card {
            position: relative;
            overflow: hidden;
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 80px;
            height: 80px;
            border-radius: 0 0 0 100%;
            opacity: 0.1;
            z-index: 0;
        }

        .kpi-revenue::before {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .kpi-customers::before {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }

        .kpi-appointments::before {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }

        .kpi-satisfaction::before {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        /* Chart containers */
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        /* Status badges */
        .trend-up {
            color: #10b981;
        }

        .trend-down {
            color: #ef4444;
        }

        .trend-neutral {
            color: #6b7280;
        }

        /* Metric cards */
        .metric-card {
            transition: all 0.3s ease;
        }

        .metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px -5px rgba(0, 0, 0, 0.1);
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

        /* Metric comparison bars */
        .comparison-bar {
            height: 6px;
            border-radius: 3px;
            overflow: hidden;
            background-color: var(--border-color);
        }

        .comparison-fill {
            height: 100%;
            border-radius: 3px;
        }

        /* Mobile menu */
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.active {
            transform: translateX(0);
        }

        /* Performance indicators */
        .performance-indicator {
            width: 100px;
            height: 100px;
            position: relative;
        }

        .performance-circle {
            fill: none;
            stroke-width: 8;
            stroke-linecap: round;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }

        /* Custom tooltip */
        .custom-tooltip {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            font-size: 0.875rem;
            z-index: 100;
        }

        /* Data grid */
        .data-grid {
            display: grid;
            gap: 1rem;
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
                                <h2 class="text-xl font-semibold">Business Analytics & Insights</h2>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Data-driven insights to grow your service business</p>
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
                                <select id="dateRange" class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent">
                                    <option value="7">Last 7 days</option>
                                    <option value="30" selected>Last 30 days</option>
                                    <option value="90">Last 90 days</option>
                                    <option value="365">Last 12 months</option>
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

            <!-- Analytics Tabs -->
            <div class="px-6 pt-6">
                <div class="flex space-x-1 border-b border-gray-200 dark:border-gray-700">
                    <button class="tab-button active" data-tab="overview">Overview</button>
                    <button class="tab-button" data-tab="performance">Performance</button>
                    <button class="tab-button" data-tab="customers">Customers</button>
                    <button class="tab-button" data-tab="revenue">Revenue</button>
                    <button class="tab-button" data-tab="growth">Growth</button>
                </div>
            </div>

            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- KPI Dashboard -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Revenue KPI -->
                    <div class="card p-6 kpi-card kpi-revenue animate-slide-up" style="animation-delay: 0.1s">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Monthly Revenue</p>
                                <h3 class="text-3xl font-bold mt-2">$24,580</h3>
                                <div class="flex items-center mt-2">
                                    <span class="trend-up text-sm font-medium">
                                        <i class="fas fa-arrow-up mr-1"></i> 18.2%
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white relative z-10">
                                <i class="fas fa-dollar-sign text-lg"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Year-to-date</span>
                                <span class="font-medium">$142,350</span>
                            </div>
                        </div>
                    </div>

                    <!-- Customers KPI -->
                    <div class="card p-6 kpi-card kpi-customers animate-slide-up" style="animation-delay: 0.2s">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Active Customers</p>
                                <h3 class="text-3xl font-bold mt-2">342</h3>
                                <div class="flex items-center mt-2">
                                    <span class="trend-up text-sm font-medium">
                                        <i class="fas fa-arrow-up mr-1"></i> 12.5%
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-white relative z-10">
                                <i class="fas fa-users text-lg"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">New this month</span>
                                <span class="font-medium">+42</span>
                            </div>
                        </div>
                    </div>

                    <!-- Appointments KPI -->
                    <div class="card p-6 kpi-card kpi-appointments animate-slide-up" style="animation-delay: 0.3s">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Completed Appointments</p>
                                <h3 class="text-3xl font-bold mt-2">156</h3>
                                <div class="flex items-center mt-2">
                                    <span class="trend-up text-sm font-medium">
                                        <i class="fas fa-arrow-up mr-1"></i> 8.7%
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-white relative z-10">
                                <i class="fas fa-calendar-check text-lg"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Completion rate</span>
                                <span class="font-medium">94.2%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Satisfaction KPI -->
                    <div class="card p-6 kpi-card kpi-satisfaction animate-slide-up" style="animation-delay: 0.4s">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Satisfaction Score</p>
                                <h3 class="text-3xl font-bold mt-2">4.8</h3>
                                <div class="flex items-center mt-2">
                                    <span class="trend-up text-sm font-medium">
                                        <i class="fas fa-arrow-up mr-1"></i> 0.2
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center text-white relative z-10">
                                <i class="fas fa-smile text-lg"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Based on 84 reviews</span>
                                <span class="font-medium">92% positive</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revenue & Growth Charts -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Revenue Trend Chart -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h3 class="text-lg font-semibold">Revenue Trend</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Monthly revenue performance over time</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="tab-button text-sm active" data-chart="revenue">Revenue</button>
                                <button class="tab-button text-sm" data-chart="growth">Growth</button>
                                <button class="tab-button text-sm" data-chart="forecast">Forecast</button>
                            </div>
                        </div>
                        
                        <div class="chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Avg. Monthly</p>
                                    <p class="text-xl font-bold">$21,450</p>
                                    <p class="text-xs trend-up">+12.5% YoY</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Best Month</p>
                                    <p class="text-xl font-bold">$28,900</p>
                                    <p class="text-xs text-gray-500">August 2023</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Projected Next</p>
                                    <p class="text-xl font-bold">$26,800</p>
                                    <p class="text-xs trend-up">+8.9%</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Performance -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold">Service Performance</h3>
                            <button class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                                View Details
                            </button>
                        </div>
                        
                        <div class="chart-container">
                            <canvas id="serviceChart"></canvas>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Most Popular Service</p>
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                                        <span class="font-medium">AC Repair</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">34% of total revenue</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Highest Margin</p>
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                                        <span class="font-medium">Electrical</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">42% profit margin</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer & Business Metrics -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Customer Acquisition -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold">Customer Acquisition</h3>
                            <button class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-medium">New Customers</span>
                                    <span class="font-bold">42</span>
                                </div>
                                <div class="comparison-bar">
                                    <div class="comparison-fill bg-gradient-to-r from-green-500 to-emerald-600" style="width: 85%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500 mt-1">
                                    <span>This month</span>
                                    <span>+18% vs last month</span>
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-medium">Repeat Customers</span>
                                    <span class="font-bold">78%</span>
                                </div>
                                <div class="comparison-bar">
                                    <div class="comparison-fill bg-gradient-to-r from-blue-500 to-cyan-600" style="width: 78%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500 mt-1">
                                    <span>Repeat rate</span>
                                    <span>+5% YoY</span>
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-medium">Customer Lifetime Value</span>
                                    <span class="font-bold">$2,450</span>
                                </div>
                                <div class="comparison-bar">
                                    <div class="comparison-fill bg-gradient-to-r from-purple-500 to-pink-600" style="width: 72%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500 mt-1">
                                    <span>Avg. per customer</span>
                                    <span>+12% YoY</span>
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-medium">Acquisition Cost</span>
                                    <span class="font-bold">$185</span>
                                </div>
                                <div class="comparison-bar">
                                    <div class="comparison-fill bg-gradient-to-r from-yellow-500 to-orange-600" style="width: 45%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500 mt-1">
                                    <span>Per new customer</span>
                                    <span>-8% vs last month</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Business Efficiency -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold">Business Efficiency</h3>
                            <div class="performance-indicator">
                                <svg viewBox="0 0 36 36" class="performance-circle">
                                    <path class="text-gray-200 dark:text-gray-700"
                                        stroke="currentColor"
                                        stroke-width="3"
                                        fill="none"
                                        d="M18 2.0845
                                            a 15.9155 15.9155 0 0 1 0 31.831
                                            a 15.9155 15.9155 0 0 1 0 -31.831"
                                    />
                                    <path class="text-green-500"
                                        stroke="currentColor"
                                        stroke-width="3"
                                        stroke-linecap="round"
                                        fill="none"
                                        stroke-dasharray="86, 100"
                                        d="M18 2.0845
                                            a 15.9155 15.9155 0 0 1 0 31.831
                                            a 15.9155 15.9155 0 0 1 0 -31.831"
                                    />
                                    <text x="18" y="20.5" class="text-lg font-bold fill-current text-gray-800 dark:text-gray-200 text-center" text-anchor="middle" dy="0.3em">86%</text>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-gray-800">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-md bg-green-100 dark:bg-green-900/30 flex items-center justify-center mr-3">
                                        <i class="fas fa-check text-green-600 dark:text-green-400"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">On-time Completion</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Appointment efficiency</p>
                                    </div>
                                </div>
                                <span class="font-bold">94%</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-gray-800">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-md bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mr-3">
                                        <i class="fas fa-clock text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Avg. Service Time</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Efficiency metric</p>
                                    </div>
                                </div>
                                <span class="font-bold">2.8h</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50 dark:bg-gray-800">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-md bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center mr-3">
                                        <i class="fas fa-dollar-sign text-purple-600 dark:text-purple-400"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Revenue per Hour</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Productivity</p>
                                    </div>
                                </div>
                                <span class="font-bold">$145</span>
                            </div>
                        </div>
                    </div>

                    <!-- Growth Metrics -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold">Growth Metrics</h3>
                            <button class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                                View Trends
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="text-center p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">MoM Growth</p>
                                    <p class="text-2xl font-bold trend-up">+12.5%</p>
                                    <p class="text-xs text-gray-500">Revenue growth</p>
                                </div>
                                <div class="text-center p-4 rounded-lg bg-gray-50 dark:bg-gray-800">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">YoY Growth</p>
                                    <p class="text-2xl font-bold trend-up">+28.4%</p>
                                    <p class="text-xs text-gray-500">Annual growth</p>
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-medium">Market Penetration</span>
                                    <span class="font-bold">34%</span>
                                </div>
                                <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-600 rounded-full" style="width: 34%"></div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Service area coverage</p>
                            </div>
                            
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-medium">Customer Retention</span>
                                    <span class="font-bold">92%</span>
                                </div>
                                <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-green-500 to-emerald-600 rounded-full" style="width: 92%"></div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Year-over-year</p>
                            </div>
                            
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-medium">Referral Rate</span>
                                    <span class="font-bold">24%</span>
                                </div>
                                <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-purple-500 to-pink-600 rounded-full" style="width: 24%"></div>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">New business from referrals</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Advanced Analytics -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Geographic Performance -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h3 class="text-lg font-semibold">Geographic Performance</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Revenue distribution by service area</p>
                            </div>
                            <button class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                                View Map
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-white font-semibold mr-3">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Downtown Area</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Primary service zone</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">$12,450</p>
                                    <p class="text-xs text-gray-500">38% of revenue</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white font-semibold mr-3">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Suburban Zone</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Secondary service area</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">$8,250</p>
                                    <p class="text-xs text-gray-500">25% of revenue</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center text-white font-semibold mr-3">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Business District</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Commercial clients</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">$7,850</p>
                                    <p class="text-xs text-gray-500">24% of revenue</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center text-white font-semibold mr-3">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Rural Areas</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Extended service zone</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold">$3,030</p>
                                    <p class="text-xs text-gray-500">13% of revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Predictive Analytics -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h3 class="text-lg font-semibold">Predictive Insights</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Forecasts and opportunity analysis</p>
                            </div>
                            <button class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                                <i class="fas fa-brain"></i>
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="p-4 rounded-lg bg-gradient-to-r from-blue-500/10 to-cyan-500/10 border border-blue-200 dark:border-blue-800">
                                <div class="flex items-center mb-2">
                                    <div class="w-8 h-8 rounded-md bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mr-3">
                                        <i class="fas fa-chart-line text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium">Revenue Forecast</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Next 30 days</p>
                                    </div>
                                    <span class="font-bold trend-up">+$4,200</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Based on current trends and seasonality</p>
                            </div>
                            
                            <div class="p-4 rounded-lg bg-gradient-to-r from-green-500/10 to-emerald-500/10 border border-green-200 dark:border-green-800">
                                <div class="flex items-center mb-2">
                                    <div class="w-8 h-8 rounded-md bg-green-100 dark:bg-green-900/30 flex items-center justify-center mr-3">
                                        <i class="fas fa-user-plus text-green-600 dark:text-green-400"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium">New Customers</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Expected next month</p>
                                    </div>
                                    <span class="font-bold">+38</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Based on acquisition trends and marketing</p>
                            </div>
                            
                            <div class="p-4 rounded-lg bg-gradient-to-r from-purple-500/10 to-pink-500/10 border border-purple-200 dark:border-purple-800">
                                <div class="flex items-center mb-2">
                                    <div class="w-8 h-8 rounded-md bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center mr-3">
                                        <i class="fas fa-calendar-alt text-purple-600 dark:text-purple-400"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium">Peak Service Period</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Expected demand surge</p>
                                    </div>
                                    <span class="font-bold">Dec 15-22</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Historical data suggests 42% increase in demand</p>
                            </div>
                            
                            <div class="p-4 rounded-lg bg-gradient-to-r from-yellow-500/10 to-orange-500/10 border border-yellow-200 dark:border-yellow-800">
                                <div class="flex items-center mb-2">
                                    <div class="w-8 h-8 rounded-md bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center mr-3">
                                        <i class="fas fa-lightbulb text-yellow-600 dark:text-yellow-400"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-medium">Growth Opportunity</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Service expansion</p>
                                    </div>
                                    <span class="font-bold">Electrical</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">High demand, 42% profit margin opportunity</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Analytics Detail Modal -->
    <div id="analyticsDetailModal" class="fixed inset-0 z-50 flex items-center justify-center hidden" style="background-color: rgba(0, 0, 0, 0.5); backdrop-filter: blur(4px);">
        <div class="card w-full max-w-4xl m-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold">Advanced Analytics Details</h3>
                    <button id="closeAnalyticsModal" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-6" id="analyticsDetailContent">
                <!-- Analytics details will be loaded here -->
            </div>
        </div>
    </div>

    <script>
        // Initialize theme toggle
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

        // Chart data
        const revenueData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Monthly Revenue',
                data: [18500, 19200, 21000, 21800, 22500, 23400, 24500, 28900, 26500, 27800, 24580, 26800],
                borderColor: '#4361ee',
                backgroundColor: 'rgba(67, 97, 238, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }, {
                label: 'Previous Year',
                data: [15200, 15800, 16500, 17200, 18000, 18800, 19500, 21000, 20500, 21500, 20800, 22500],
                borderColor: '#9ca3af',
                backgroundColor: 'transparent',
                borderWidth: 2,
                borderDash: [5, 5],
                tension: 0.4
            }]
        };

        const serviceData = {
            labels: ['AC Repair', 'Plumbing', 'Electrical', 'Painting', 'HVAC'],
            datasets: [{
                label: 'Revenue by Service',
                data: [12500, 9800, 15400, 7200, 10800],
                backgroundColor: [
                    'rgba(67, 97, 238, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(168, 85, 247, 0.8)',
                    'rgba(239, 68, 68, 0.8)'
                ],
                borderColor: [
                    '#4361ee',
                    '#10b981',
                    '#f59e0b',
                    '#a855f7',
                    '#ef4444'
                ],
                borderWidth: 1
            }]
        };

        // Initialize charts
        let revenueChart, serviceChart;

        function initializeCharts() {
            // Revenue Chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            revenueChart = new Chart(revenueCtx, {
                type: 'line',
                data: revenueData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: htmlElement.classList.contains('dark') ? '#f3f4f6' : '#111827'
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: htmlElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
                            titleColor: htmlElement.classList.contains('dark') ? '#f3f4f6' : '#111827',
                            bodyColor: htmlElement.classList.contains('dark') ? '#f3f4f6' : '#111827',
                            borderColor: htmlElement.classList.contains('dark') ? '#374151' : '#e5e7eb',
                            borderWidth: 1
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: htmlElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                color: htmlElement.classList.contains('dark') ? '#9ca3af' : '#6b7280'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: htmlElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                color: htmlElement.classList.contains('dark') ? '#9ca3af' : '#6b7280',
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'nearest'
                    }
                }
            });

            // Service Chart
            const serviceCtx = document.getElementById('serviceChart').getContext('2d');
            serviceChart = new Chart(serviceCtx, {
                type: 'bar',
                data: serviceData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: htmlElement.classList.contains('dark') ? '#f3f4f6' : '#111827'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += '$' + context.parsed.y.toLocaleString();
                                    return label;
                                }
                            },
                            backgroundColor: htmlElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
                            titleColor: htmlElement.classList.contains('dark') ? '#f3f4f6' : '#111827',
                            bodyColor: htmlElement.classList.contains('dark') ? '#f3f4f6' : '#111827',
                            borderColor: htmlElement.classList.contains('dark') ? '#374151' : '#e5e7eb',
                            borderWidth: 1
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: htmlElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                color: htmlElement.classList.contains('dark') ? '#9ca3af' : '#6b7280'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: htmlElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                color: htmlElement.classList.contains('dark') ? '#9ca3af' : '#6b7280',
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        }

        // Update charts for theme changes
        function updateChartColors() {
            if (revenueChart) {
                revenueChart.options.plugins.legend.labels.color = htmlElement.classList.contains('dark') ? '#f3f4f6' : '#111827';
                revenueChart.options.scales.x.grid.color = htmlElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
                revenueChart.options.scales.x.ticks.color = htmlElement.classList.contains('dark') ? '#9ca3af' : '#6b7280';
                revenueChart.options.scales.y.grid.color = htmlElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
                revenueChart.options.scales.y.ticks.color = htmlElement.classList.contains('dark') ? '#9ca3af' : '#6b7280';
                revenueChart.options.plugins.tooltip.backgroundColor = htmlElement.classList.contains('dark') ? '#1f2937' : '#ffffff';
                revenueChart.options.plugins.tooltip.titleColor = htmlElement.classList.contains('dark') ? '#f3f4f6' : '#111827';
                revenueChart.options.plugins.tooltip.bodyColor = htmlElement.classList.contains('dark') ? '#f3f4f6' : '#111827';
                revenueChart.options.plugins.tooltip.borderColor = htmlElement.classList.contains('dark') ? '#374151' : '#e5e7eb';
                revenueChart.update();
            }

            if (serviceChart) {
                serviceChart.options.plugins.legend.labels.color = htmlElement.classList.contains('dark') ? '#f3f4f6' : '#111827';
                serviceChart.options.scales.x.grid.color = htmlElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
                serviceChart.options.scales.x.ticks.color = htmlElement.classList.contains('dark') ? '#9ca3af' : '#6b7280';
                serviceChart.options.scales.y.grid.color = htmlElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
                serviceChart.options.scales.y.ticks.color = htmlElement.classList.contains('dark') ? '#9ca3af' : '#6b7280';
                serviceChart.options.plugins.tooltip.backgroundColor = htmlElement.classList.contains('dark') ? '#1f2937' : '#ffffff';
                serviceChart.options.plugins.tooltip.titleColor = htmlElement.classList.contains('dark') ? '#f3f4f6' : '#111827';
                serviceChart.options.plugins.tooltip.bodyColor = htmlElement.classList.contains('dark') ? '#f3f4f6' : '#111827';
                serviceChart.options.plugins.tooltip.borderColor = htmlElement.classList.contains('dark') ? '#374151' : '#e5e7eb';
                serviceChart.update();
            }
        }

        // Tab switching
        document.addEventListener('DOMContentLoaded', function() {
            initializeCharts();
            
            // Tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.addEventListener('click', function() {
                    const tab = this.getAttribute('data-tab');
                    
                    // Update tab buttons
                    document.querySelectorAll('.tab-button').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    this.classList.add('active');
                    
                    // Handle chart tab switching
                    if (this.hasAttribute('data-chart')) {
                        const chartType = this.getAttribute('data-chart');
                        updateRevenueChart(chartType);
                    }
                    
                    // In a real app, this would load different analytics views
                    console.log(`Switched to ${tab} analytics view`);
                });
            });
            
            // Date range selector
            const dateRange = document.getElementById('dateRange');
            dateRange.addEventListener('change', function() {
                const days = this.value;
                console.log(`Loading data for last ${days} days`);
                // In a real app, this would reload chart data
            });
            
            // Add smooth loading animation for stats cards
            const statsCards = document.querySelectorAll('.animate-slide-up');
            statsCards.forEach((card, index) => {
                card.style.animationDelay = `${(index + 1) * 0.1}s`;
            });
            
            // Mobile menu toggle
            window.toggleMobileMenu = function() {
                const mobileMenu = document.querySelector('.mobile-menu');
                mobileMenu.classList.toggle('active');
            }
        });

        // Update revenue chart based on selection
        function updateRevenueChart(type) {
            if (!revenueChart) return;
            
            // In a real app, this would load new data from an API
            switch(type) {
                case 'revenue':
                    revenueChart.data.datasets[0].label = 'Monthly Revenue';
                    revenueChart.data.datasets[0].data = [18500, 19200, 21000, 21800, 22500, 23400, 24500, 28900, 26500, 27800, 24580, 26800];
                    break;
                case 'growth':
                    revenueChart.data.datasets[0].label = 'Growth Rate (%)';
                    revenueChart.data.datasets[0].data = [12, 15, 18, 14, 16, 19, 22, 28, 18, 21, 18, 24];
                    break;
                case 'forecast':
                    revenueChart.data.datasets[0].label = 'Revenue Forecast';
                    revenueChart.data.datasets[0].data = [24580, 26800, 28500, 27200, 29800, 31200, 30500, 32800, 34200, 35800, 37200, 38500];
                    break;
            }
            
            revenueChart.update();
        }

        // Export analytics data
        function exportAnalyticsData() {
            const data = {
                revenue: revenueData,
                services: serviceData,
                kpis: {
                    monthlyRevenue: 24580,
                    activeCustomers: 342,
                    completedAppointments: 156,
                    satisfactionScore: 4.8
                }
            };
            
            const dataStr = JSON.stringify(data, null, 2);
            const dataBlob = new Blob([dataStr], {type: 'application/json'});
            const url = window.URL.createObjectURL(dataBlob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `analytics_export_${new Date().toISOString().split('T')[0]}.json`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            
            alert('Analytics data exported successfully!');
        }

        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.querySelector('.mobile-menu');
            mobileMenu.classList.toggle('active');
        }

        // Theme toggle also updates charts
        themeToggle.addEventListener('click', () => {
            setTimeout(updateChartColors, 100);
        });
    </script>
</body>
</html>