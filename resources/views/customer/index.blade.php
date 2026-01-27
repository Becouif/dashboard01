<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServiceDash | Customer Management</title>
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

        .status-inactive {
            background-color: rgba(156, 163, 175, 0.1);
            color: rgb(107, 114, 128);
        }

        .dark .status-inactive {
            background-color: rgba(156, 163, 175, 0.2);
            color: rgb(156, 163, 175);
        }

        .status-premium {
            background-color: rgba(168, 85, 247, 0.1);
            color: rgb(126, 34, 206);
        }

        .dark .status-premium {
            background-color: rgba(168, 85, 247, 0.2);
            color: rgb(192, 132, 252);
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

        .action-btn-view {
            background-color: rgba(59, 130, 246, 0.1);
            color: rgb(29, 78, 216);
        }

        .action-btn-view:hover {
            background-color: rgb(29, 78, 216);
            color: white;
        }

        .action-btn-edit {
            background-color: rgba(16, 185, 129, 0.1);
            color: rgb(6, 95, 70);
        }

        .action-btn-edit:hover {
            background-color: rgb(6, 95, 70);
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

        /* Customer type badges */
        .customer-type-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .type-regular {
            background-color: rgba(59, 130, 246, 0.1);
            color: rgb(29, 78, 216);
        }

        .type-business {
            background-color: rgba(168, 85, 247, 0.1);
            color: rgb(126, 34, 206);
        }

        .type-premium {
            background-color: rgba(245, 158, 11, 0.1);
            color: rgb(180, 83, 9);
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

        /* Mobile menu */
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.active {
            transform: translateX(0);
        }

        /* Form styling */
        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .form-required::after {
            content: " *";
            color: #ef4444;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }

        /* Customer card */
        .customer-card {
            transition: all 0.3s ease;
        }

        .customer-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
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
                        <p class="text-xs text-gray-500 dark:text-gray-400">Customer Management</p>
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
                                <h2 class="text-xl font-semibold">Customer Management</h2>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Manage your customer database and relationships</p>
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
                            
                            <!-- Add New Customer Button -->
                            <button id="openAddCustomerModal" class="btn-primary px-4 py-2 rounded-lg font-medium flex items-center space-x-2">
                                <i class="fas fa-user-plus"></i>
                                <span>Add Customer</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="p-6">
                <!-- Customer Stats -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Customers -->
                    <div class="card p-6 animate-slide-up" style="animation-delay: 0.1s">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Total Customers</p>
                                <h3 class="text-3xl font-bold mt-2" id="totalCustomers">0</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-green-600 dark:text-green-400 text-sm font-medium">
                                        <i class="fas fa-arrow-up mr-1"></i> 12.5%
                                    </span>
                                    <span class="text-gray-500 text-sm ml-2">vs last month</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center">
                                <i class="fas fa-users text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">New this week</span>
                                <span class="font-medium" id="newThisWeek">0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Active Customers -->
                    <div class="card p-6 animate-slide-up" style="animation-delay: 0.2s">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Active Customers</p>
                                <h3 class="text-3xl font-bold mt-2" id="activeCustomers">0</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-green-600 dark:text-green-400 text-sm font-medium">
                                        78% of total
                                    </span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                                <i class="fas fa-user-check text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Repeat rate</span>
                                <span class="font-medium">82%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Premium Customers -->
                    <div class="card p-6 animate-slide-up" style="animation-delay: 0.3s">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Premium Customers</p>
                                <h3 class="text-3xl font-bold mt-2" id="premiumCustomers">0</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-purple-600 dark:text-purple-400 text-sm font-medium">
                                        <i class="fas fa-crown mr-1"></i> 24% of revenue
                                    </span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center">
                                <i class="fas fa-crown text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Avg. spend</span>
                                <span class="font-medium">$1,850</span>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Satisfaction -->
                    <div class="card p-6 animate-slide-up" style="animation-delay: 0.4s">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">Satisfaction Score</p>
                                <h3 class="text-3xl font-bold mt-2">4.7</h3>
                                <div class="flex items-center mt-2">
                                    <span class="text-yellow-600 dark:text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-500 to-orange-600 flex items-center justify-center">
                                <i class="fas fa-smile text-white text-lg"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Based on 156 reviews</span>
                                <span class="font-medium">94% positive</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer List Tabs -->
                <div class="mb-8">
                    <div class="flex space-x-1 border-b border-gray-200 dark:border-gray-700">
                        <button class="tab-button active" data-tab="all">All Customers</button>
                        <button class="tab-button" data-tab="active">Active</button>
                        <button class="tab-button" data-tab="premium">Premium</button>
                        <button class="tab-button" data-tab="inactive">Inactive</button>
                        <button class="tab-button" data-tab="recent">Recently Added</button>
                    </div>
                </div>

                <!-- Customer List Header -->
                <div class="card overflow-hidden mb-6">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-semibold" id="customerListTitle">All Customers</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1" id="customerListSubtitle">Showing all customers in your database</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="relative">
                                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input type="text" id="customerSearch" placeholder="Search customers..." class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent w-full md:w-64 form-input">
                                </div>
                                <button class="btn-secondary px-4 py-2 rounded-lg font-medium flex items-center space-x-2">
                                    <i class="fas fa-filter"></i>
                                    <span>Filter</span>
                                </button>
                                <button id="exportCustomers" class="btn-secondary px-4 py-2 rounded-lg font-medium flex items-center space-x-2">
                                    <i class="fas fa-file-export"></i>
                                    <span>Export</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Customer List -->
                    <div class="overflow-x-auto">
                        <table class="w-full customer-table">
                            <thead>
                                <tr class="text-left text-sm font-medium text-gray-700 dark:text-gray-300 border-b border-gray-200 dark:border-gray-700">
                                    <th class="pb-3 px-6 pt-4">Customer</th>
                                    <th class="pb-3 px-6 pt-4">Contact</th>
                                    <th class="pb-3 px-6 pt-4">Type</th>
                                    <th class="pb-3 px-6 pt-4">Total Spent</th>
                                    <th class="pb-3 px-6 pt-4">Last Service</th>
                                    <th class="pb-3 px-6 pt-4">Status</th>
                                    <th class="pb-3 px-6 pt-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="customerTableBody">
                                <!-- Customer rows will be loaded here dynamically -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Empty State -->
                    <div id="emptyCustomerState" class="empty-state hidden">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full mb-4">
                            <i class="fas fa-users text-gray-400 text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-2">No customers found</h4>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">Try changing your filters or add a new customer</p>
                        <button id="addFirstCustomer" class="btn-primary px-6 py-3 rounded-lg text-white font-medium">
                            <i class="fas fa-user-plus mr-2"></i> Add First Customer
                        </button>
                    </div>

                    <!-- Loading State -->
                    <div id="loadingState" class="empty-state">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-full mb-4">
                            <i class="fas fa-spinner fa-spin text-blue-600 dark:text-blue-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">Loading customers...</p>
                    </div>

                    <!-- Table Footer -->
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                Showing <span id="showingCount">0</span> of <span id="totalCount">0</span> customers
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 disabled:opacity-50" id="prevPage" disabled>
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="w-8 h-8 rounded-lg bg-blue-600 text-white font-medium">1</button>
                                <button class="w-8 h-8 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 font-medium">2</button>
                                <button class="w-8 h-8 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 font-medium">3</button>
                                <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800" id="nextPage">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity & Quick Stats -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Recent Activity -->
                    <div class="lg:col-span-2 card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold">Recent Customer Activity</h3>
                            <button class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                                View All <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                        
                        <div class="space-y-4" id="recentActivity">
                            <!-- Activity items will be loaded here -->
                        </div>

                        <!-- Empty Activity State -->
                        <div id="emptyActivityState" class="text-center py-8">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-100 dark:bg-gray-800 rounded-full mb-3">
                                <i class="fas fa-history text-gray-400"></i>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400">No recent activity</p>
                        </div>
                    </div>

                    <!-- Customer Segmentation -->
                    <div class="card p-6">
                        <h3 class="text-lg font-semibold mb-6">Customer Segmentation</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                                        <span class="font-medium">Regular Customers</span>
                                    </div>
                                    <span class="font-bold" id="regularCount">0</span>
                                </div>
                                <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-600 rounded-full" style="width: 60%"></div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 rounded-full bg-purple-500 mr-2"></div>
                                        <span class="font-medium">Business Customers</span>
                                    </div>
                                    <span class="font-bold" id="businessCount">0</span>
                                </div>
                                <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-purple-500 to-pink-600 rounded-full" style="width: 25%"></div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
                                        <span class="font-medium">Premium Customers</span>
                                    </div>
                                    <span class="font-bold" id="premiumSegmentCount">0</span>
                                </div>
                                <div class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-yellow-500 to-orange-600 rounded-full" style="width: 15%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Total Customer Value</p>
                                <p class="font-bold" id="totalCustomerValue">$0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Add Customer Modal -->
    <div id="addCustomerModal" class="fixed inset-0 z-50 flex items-center justify-center hidden modal-overlay">
        <div class="modal-content card w-full max-w-2xl m-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold">Add New Customer</h3>
                    <button id="closeAddCustomerModal" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <div class="p-6">
                <form id="customerForm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Information -->
                        <div class="md:col-span-2">
                            <h4 class="text-lg font-semibold mb-4">Personal Information</h4>
                        </div>
                        
                        <div>
                            <label class="form-label form-required" for="firstName">First Name</label>
                            <input type="text" id="firstName" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent form-input">
                        </div>
                        
                        <div>
                            <label class="form-label form-required" for="lastName">Last Name</label>
                            <input type="text" id="lastName" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent form-input">
                        </div>
                        
                        <div>
                            <label class="form-label form-required" for="email">Email Address</label>
                            <input type="email" id="email" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent form-input">
                        </div>
                        
                        <div>
                            <label class="form-label" for="phone">Phone Number</label>
                            <input type="tel" id="phone" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent form-input">
                        </div>
                        
                        <!-- Address Information -->
                        <div class="md:col-span-2 mt-2">
                            <h4 class="text-lg font-semibold mb-4">Address Information</h4>
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="form-label" for="address">Street Address</label>
                            <input type="text" id="address" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent form-input">
                        </div>
                        
                        <div>
                            <label class="form-label" for="city">City</label>
                            <input type="text" id="city" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent form-input">
                        </div>
                        
                        <div>
                            <label class="form-label" for="state">State</label>
                            <input type="text" id="state" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent form-input">
                        </div>
                        
                        <div>
                            <label class="form-label" for="zipCode">ZIP Code</label>
                            <input type="text" id="zipCode" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent form-input">
                        </div>
                        
                        <!-- Customer Details -->
                        <div class="md:col-span-2 mt-2">
                            <h4 class="text-lg font-semibold mb-4">Customer Details</h4>
                        </div>
                        
                        <div>
                            <label class="form-label form-required" for="customerType">Customer Type</label>
                            <select id="customerType" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent form-input">
                                <option value="">Select type</option>
                                <option value="regular">Regular</option>
                                <option value="business">Business</option>
                                <option value="premium">Premium</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="form-label form-required" for="status">Status</label>
                            <select id="status" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent form-input">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="form-label" for="company">Company (Optional)</label>
                            <input type="text" id="company" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent form-input">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="form-label" for="notes">Notes</label>
                            <textarea id="notes" rows="3" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent form-input" placeholder="Add any notes about this customer..."></textarea>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <button type="button" id="cancelAddCustomer" class="btn-secondary px-6 py-3 rounded-lg font-medium">
                            Cancel
                        </button>
                        <button type="submit" class="btn-primary px-6 py-3 rounded-lg text-white font-medium flex items-center space-x-2">
                            <i class="fas fa-user-plus"></i>
                            <span>Add Customer</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Customer Detail Modal -->
    <div id="customerDetailModal" class="fixed inset-0 z-50 flex items-center justify-center hidden modal-overlay">
        <div class="modal-content card w-full max-w-3xl m-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold">Customer Details</h3>
                    <button id="closeDetailModal" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-6" id="customerDetailContent">
                <!-- Customer details will be loaded here -->
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
                <h3 class="text-xl font-semibold mb-2" id="successTitle">Customer Added!</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6" id="successMessage">The new customer has been added to your database.</p>
                <button id="closeSuccessModal" class="btn-primary px-6 py-3 rounded-lg text-white font-medium">
                    Continue
                </button>
            </div>
        </div>
    </div>

    <script>
        // Sample customer data
        const sampleCustomers = [
            {
                id: 1,
                firstName: "John",
                lastName: "Smith",
                email: "john.smith@email.com",
                phone: "(555) 123-4567",
                address: "123 Main Street",
                city: "San Francisco",
                state: "CA",
                zipCode: "94105",
                company: "TechCorp Inc",
                customerType: "business",
                status: "active",
                totalSpent: 3450,
                lastService: "2023-11-15",
                servicesCount: 5,
                joinDate: "2022-03-10",
                notes: "Regular customer, prefers AC services"
            },
            {
                id: 2,
                firstName: "Sarah",
                lastName: "Johnson",
                email: "sarah.j@email.com",
                phone: "(555) 987-6543",
                address: "456 Oak Avenue",
                city: "New York",
                state: "NY",
                zipCode: "10001",
                company: "Design Studio LLC",
                customerType: "premium",
                status: "active",
                totalSpent: 5280,
                lastService: "2023-11-14",
                servicesCount: 8,
                joinDate: "2021-11-05",
                notes: "Premium customer, high-value projects"
            },
            {
                id: 3,
                firstName: "Michael",
                lastName: "Brown",
                email: "michael.b@email.com",
                phone: "(555) 456-7890",
                address: "789 Pine Road",
                city: "Chicago",
                state: "IL",
                zipCode: "60601",
                company: "",
                customerType: "regular",
                status: "active",
                totalSpent: 1850,
                lastService: "2023-11-12",
                servicesCount: 3,
                joinDate: "2023-02-15",
                notes: "New customer, electrical services"
            },
            {
                id: 4,
                firstName: "Alex",
                lastName: "Williams",
                email: "alex.w@email.com",
                phone: "(555) 321-0987",
                address: "101 Elm Street",
                city: "Seattle",
                state: "WA",
                zipCode: "98101",
                company: "Green Energy Co",
                customerType: "business",
                status: "active",
                totalSpent: 4200,
                lastService: "2023-11-10",
                servicesCount: 4,
                joinDate: "2022-08-20",
                notes: "Business account, multiple locations"
            },
            {
                id: 5,
                firstName: "Emily",
                lastName: "Davis",
                email: "emily.d@email.com",
                phone: "(555) 654-3210",
                address: "202 Maple Drive",
                city: "Austin",
                state: "TX",
                zipCode: "73301",
                company: "",
                customerType: "regular",
                status: "inactive",
                totalSpent: 950,
                lastService: "2023-08-15",
                servicesCount: 2,
                joinDate: "2023-01-10",
                notes: "Moved out of service area"
            },
            {
                id: 6,
                firstName: "Robert",
                lastName: "Wilson",
                email: "robert.w@email.com",
                phone: "(555) 789-0123",
                address: "303 Cedar Lane",
                city: "Boston",
                state: "MA",
                zipCode: "02101",
                company: "Wilson Consulting",
                customerType: "premium",
                status: "active",
                totalSpent: 6250,
                lastService: "2023-11-08",
                servicesCount: 7,
                joinDate: "2021-05-12",
                notes: "Long-term premium customer"
            },
            {
                id: 7,
                firstName: "Lisa",
                lastName: "Anderson",
                email: "lisa.a@email.com",
                phone: "(555) 234-5678",
                address: "404 Birch Court",
                city: "Denver",
                state: "CO",
                zipCode: "80201",
                company: "Anderson Enterprises",
                customerType: "business",
                status: "active",
                totalSpent: 3850,
                lastService: "2023-11-05",
                servicesCount: 6,
                joinDate: "2022-09-30",
                notes: "Business customer, regular maintenance"
            },
            {
                id: 8,
                firstName: "David",
                lastName: "Martinez",
                email: "david.m@email.com",
                phone: "(555) 876-5432",
                address: "505 Spruce Way",
                city: "Miami",
                state: "FL",
                zipCode: "33101",
                company: "",
                customerType: "regular",
                status: "active",
                totalSpent: 1250,
                lastService: "2023-10-28",
                servicesCount: 2,
                joinDate: "2023-03-25",
                notes: "New customer, happy with first service"
            }
        ];

        // Sample activity data
        const sampleActivities = [
            {
                id: 1,
                type: "added",
                customerName: "David Martinez",
                timestamp: "2 hours ago",
                details: "New customer added to database"
            },
            {
                id: 2,
                type: "service",
                customerName: "John Smith",
                timestamp: "Yesterday, 3:45 PM",
                details: "AC repair service completed"
            },
            {
                id: 3,
                type: "updated",
                customerName: "Sarah Johnson",
                timestamp: "Nov 14, 2023",
                details: "Contact information updated"
            },
            {
                id: 4,
                type: "service",
                customerName: "Michael Brown",
                timestamp: "Nov 12, 2023",
                details: "Electrical wiring service"
            },
            {
                id: 5,
                type: "added",
                customerName: "Alex Williams",
                timestamp: "Nov 10, 2023",
                details: "New business customer added"
            }
        ];

        // State management
        let customers = [...sampleCustomers];
        let activities = [...sampleActivities];
        let currentTab = 'all';
        let currentPage = 1;
        const itemsPerPage = 5;

        // DOM Elements
        const themeToggle = document.getElementById('themeToggle');
        const htmlElement = document.documentElement;
        const customerTableBody = document.getElementById('customerTableBody');
        const emptyCustomerState = document.getElementById('emptyCustomerState');
        const loadingState = document.getElementById('loadingState');
        const customerSearch = document.getElementById('customerSearch');
        const customerListTitle = document.getElementById('customerListTitle');
        const customerListSubtitle = document.getElementById('customerListSubtitle');
        const tabButtons = document.querySelectorAll('.tab-button');
        const recentActivity = document.getElementById('recentActivity');
        const emptyActivityState = document.getElementById('emptyActivityState');
        
        // Stats elements
        const totalCustomersEl = document.getElementById('totalCustomers');
        const newThisWeekEl = document.getElementById('newThisWeek');
        const activeCustomersEl = document.getElementById('activeCustomers');
        const premiumCustomersEl = document.getElementById('premiumCustomers');
        const regularCountEl = document.getElementById('regularCount');
        const businessCountEl = document.getElementById('businessCount');
        const premiumSegmentCountEl = document.getElementById('premiumSegmentCount');
        const totalCustomerValueEl = document.getElementById('totalCustomerValue');
        const showingCountEl = document.getElementById('showingCount');
        const totalCountEl = document.getElementById('totalCount');
        
        // Modal elements
        const addCustomerModal = document.getElementById('addCustomerModal');
        const openAddCustomerModal = document.getElementById('openAddCustomerModal');
        const closeAddCustomerModal = document.getElementById('closeAddCustomerModal');
        const cancelAddCustomer = document.getElementById('cancelAddCustomer');
        const customerForm = document.getElementById('customerForm');
        const customerDetailModal = document.getElementById('customerDetailModal');
        const customerDetailContent = document.getElementById('customerDetailContent');
        const closeDetailModal = document.getElementById('closeDetailModal');
        const successModal = document.getElementById('successModal');
        const successTitle = document.getElementById('successTitle');
        const successMessage = document.getElementById('successMessage');
        const closeSuccessModal = document.getElementById('closeSuccessModal');
        const addFirstCustomer = document.getElementById('addFirstCustomer');
        const exportCustomers = document.getElementById('exportCustomers');
        const prevPage = document.getElementById('prevPage');
        const nextPage = document.getElementById('nextPage');

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            // Load customers and activities
            setTimeout(() => {
                renderCustomers();
                renderActivities();
                updateStats();
                loadingState.style.display = 'none';
            }, 800); // Simulate loading delay
            
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
            
            // Search functionality
            customerSearch.addEventListener('input', function() {
                renderCustomers();
            });
            
            // Modal open/close
            openAddCustomerModal.addEventListener('click', () => {
                addCustomerModal.classList.remove('hidden');
            });
            
            closeAddCustomerModal.addEventListener('click', () => {
                addCustomerModal.classList.add('hidden');
                customerForm.reset();
            });
            
            cancelAddCustomer.addEventListener('click', () => {
                addCustomerModal.classList.add('hidden');
                customerForm.reset();
            });
            
            closeDetailModal.addEventListener('click', () => {
                customerDetailModal.classList.add('hidden');
            });
            
            closeSuccessModal.addEventListener('click', () => {
                successModal.classList.add('hidden');
            });
            
            // Form submission
            customerForm.addEventListener('submit', function(e) {
                e.preventDefault();
                addNewCustomer();
            });
            
            // Add first customer button
            addFirstCustomer.addEventListener('click', () => {
                addCustomerModal.classList.remove('hidden');
            });
            
            // Export customers
            exportCustomers.addEventListener('click', () => {
                exportCustomersToCSV();
            });
            
            // Pagination
            prevPage.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    renderCustomers();
                    updatePaginationButtons();
                }
            });
            
            nextPage.addEventListener('click', () => {
                const filteredCustomers = filterCustomers();
                const totalPages = Math.ceil(filteredCustomers.length / itemsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    renderCustomers();
                    updatePaginationButtons();
                }
            });
            
            // Close modals when clicking outside
            addCustomerModal.addEventListener('click', (e) => {
                if (e.target === addCustomerModal) {
                    addCustomerModal.classList.add('hidden');
                    customerForm.reset();
                }
            });
            
            customerDetailModal.addEventListener('click', (e) => {
                if (e.target === customerDetailModal) {
                    customerDetailModal.classList.add('hidden');
                }
            });
            
            successModal.addEventListener('click', (e) => {
                if (e.target === successModal) {
                    successModal.classList.add('hidden');
                }
            });
            
            // Add smooth loading animation for stats cards
            const statsCards = document.querySelectorAll('.animate-slide-up');
            statsCards.forEach((card, index) => {
                card.style.animationDelay = `${(index + 1) * 0.1}s`;
            });
        });

        // Switch tab
        function switchTab(tab) {
            currentTab = tab;
            currentPage = 1; // Reset to first page
            
            // Update tab buttons
            tabButtons.forEach(button => {
                if (button.getAttribute('data-tab') === tab) {
                    button.classList.add('active');
                } else {
                    button.classList.remove('active');
                }
            });
            
            // Update list title and subtitle
            let title = '';
            let subtitle = '';
            
            switch(tab) {
                case 'all':
                    title = 'All Customers';
                    subtitle = 'Showing all customers in your database';
                    break;
                case 'active':
                    title = 'Active Customers';
                    subtitle = 'Customers with active service relationships';
                    break;
                case 'premium':
                    title = 'Premium Customers';
                    subtitle = 'High-value and premium service customers';
                    break;
                case 'inactive':
                    title = 'Inactive Customers';
                    subtitle = 'Customers with no recent activity';
                    break;
                case 'recent':
                    title = 'Recently Added';
                    subtitle = 'Customers added in the last 30 days';
                    break;
            }
            
            customerListTitle.textContent = title;
            customerListSubtitle.textContent = subtitle;
            
            // Render customers
            renderCustomers();
            updatePaginationButtons();
        }

        // Filter customers based on current tab and search
        function filterCustomers() {
            let filtered = customers;
            
            // Apply tab filter
            if (currentTab !== 'all') {
                switch(currentTab) {
                    case 'active':
                        filtered = filtered.filter(c => c.status === 'active');
                        break;
                    case 'premium':
                        filtered = filtered.filter(c => c.customerType === 'premium');
                        break;
                    case 'inactive':
                        filtered = filtered.filter(c => c.status === 'inactive');
                        break;
                    case 'recent':
                        // Show customers added in last 30 days
                        const thirtyDaysAgo = new Date();
                        thirtyDaysAgo.setDate(thirtyDaysAgo.getDate() - 30);
                        filtered = filtered.filter(c => {
                            const joinDate = new Date(c.joinDate);
                            return joinDate >= thirtyDaysAgo;
                        });
                        break;
                }
            }
            
            // Apply search filter
            const searchTerm = customerSearch.value.toLowerCase();
            if (searchTerm) {
                filtered = filtered.filter(customer => {
                    const fullName = `${customer.firstName} ${customer.lastName}`.toLowerCase();
                    const email = customer.email.toLowerCase();
                    const phone = customer.phone ? customer.phone.toLowerCase() : '';
                    const company = customer.company ? customer.company.toLowerCase() : '';
                    
                    return fullName.includes(searchTerm) ||
                           email.includes(searchTerm) ||
                           phone.includes(searchTerm) ||
                           company.includes(searchTerm);
                });
            }
            
            return filtered;
        }

        // Render customers
        function renderCustomers() {
            customerTableBody.innerHTML = '';
            
            const filteredCustomers = filterCustomers();
            const totalCustomers = filteredCustomers.length;
            
            // Calculate pagination
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedCustomers = filteredCustomers.slice(startIndex, endIndex);
            
            // Show empty state if no customers
            if (paginatedCustomers.length === 0) {
                emptyCustomerState.classList.remove('hidden');
                customerTableBody.innerHTML = '';
                return;
            }
            
            emptyCustomerState.classList.add('hidden');
            
            // Sort by last service date (newest first)
            paginatedCustomers.sort((a, b) => new Date(b.lastService) - new Date(a.lastService));
            
            // Render customer rows
            paginatedCustomers.forEach(customer => {
                const row = document.createElement('tr');
                
                // Format last service date
                const lastServiceDate = new Date(customer.lastService);
                const formattedDate = lastServiceDate.toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric',
                    year: 'numeric'
                });
                
                // Status badge
                let statusBadgeClass = '';
                let statusText = '';
                
                switch(customer.status) {
                    case 'active':
                        statusBadgeClass = 'status-active';
                        statusText = 'Active';
                        break;
                    case 'inactive':
                        statusBadgeClass = 'status-inactive';
                        statusText = 'Inactive';
                        break;
                }
                
                // Customer type badge
                let typeBadgeClass = '';
                let typeText = '';
                
                switch(customer.customerType) {
                    case 'regular':
                        typeBadgeClass = 'type-regular';
                        typeText = 'Regular';
                        break;
                    case 'business':
                        typeBadgeClass = 'type-business';
                        typeText = 'Business';
                        break;
                    case 'premium':
                        typeBadgeClass = 'type-premium';
                        typeText = 'Premium';
                        break;
                }
                
                // Get initials for avatar
                const initials = `${customer.firstName.charAt(0)}${customer.lastName.charAt(0)}`.toUpperCase();
                
                row.innerHTML = `
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-white font-semibold mr-3">
                                ${initials}
                            </div>
                            <div>
                                <p class="font-medium">${customer.firstName} ${customer.lastName}</p>
                                ${customer.company ? `<p class="text-sm text-gray-600 dark:text-gray-400">${customer.company}</p>` : ''}
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div>
                            <p class="font-medium">${customer.email}</p>
                            ${customer.phone ? `<p class="text-sm text-gray-600 dark:text-gray-400">${customer.phone}</p>` : ''}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="customer-type-badge ${typeBadgeClass}">${typeText}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div>
                            <p class="font-medium">$${customer.totalSpent.toLocaleString()}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">${customer.servicesCount} services</p>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div>
                            <p class="font-medium">${formattedDate}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">${customer.servicesCount > 0 ? `${customer.servicesCount} services` : 'No services yet'}</p>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="status-badge ${statusBadgeClass}">${statusText}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <button class="action-btn action-btn-view" onclick="viewCustomer(${customer.id})" title="View details">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="action-btn action-btn-edit" onclick="editCustomer(${customer.id})" title="Edit customer">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="action-btn action-btn-delete" onclick="deleteCustomer(${customer.id})" title="Delete customer">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                customerTableBody.appendChild(row);
            });
            
            // Update counts
            showingCountEl.textContent = paginatedCustomers.length;
            totalCountEl.textContent = totalCustomers;
        }

        // Render activities
        function renderActivities() {
            recentActivity.innerHTML = '';
            
            if (activities.length === 0) {
                emptyActivityState.classList.remove('hidden');
                return;
            }
            
            emptyActivityState.classList.add('hidden');
            
            // Show latest 5 activities
            const recentActivities = activities.slice(0, 5);
            
            recentActivities.forEach(activity => {
                const activityElement = document.createElement('div');
                activityElement.className = 'flex items-center p-3 rounded-lg border border-gray-200 dark:border-gray-700';
                
                // Activity icon and color
                let icon = 'fas fa-user-plus';
                let bgColor = 'bg-blue-100 dark:bg-blue-900/30';
                let iconColor = 'text-blue-600 dark:text-blue-400';
                
                switch(activity.type) {
                    case 'added':
                        icon = 'fas fa-user-plus';
                        bgColor = 'bg-green-100 dark:bg-green-900/30';
                        iconColor = 'text-green-600 dark:text-green-400';
                        break;
                    case 'service':
                        icon = 'fas fa-tools';
                        bgColor = 'bg-purple-100 dark:bg-purple-900/30';
                        iconColor = 'text-purple-600 dark:text-purple-400';
                        break;
                    case 'updated':
                        icon = 'fas fa-edit';
                        bgColor = 'bg-yellow-100 dark:bg-yellow-900/30';
                        iconColor = 'text-yellow-600 dark:text-yellow-400';
                        break;
                }
                
                activityElement.innerHTML = `
                    <div class="${bgColor} p-2 rounded-lg mr-3">
                        <i class="${icon} ${iconColor}"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium">${activity.customerName}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">${activity.details}</p>
                    </div>
                    <div class="text-sm text-gray-500">${activity.timestamp}</div>
                `;
                
                recentActivity.appendChild(activityElement);
            });
        }

        // Update stats
        function updateStats() {
            const total = customers.length;
            const active = customers.filter(c => c.status === 'active').length;
            const premium = customers.filter(c => c.customerType === 'premium').length;
            
            // Calculate new this week (simplified)
            const weekAgo = new Date();
            weekAgo.setDate(weekAgo.getDate() - 7);
            const newThisWeek = customers.filter(c => {
                const joinDate = new Date(c.joinDate);
                return joinDate >= weekAgo;
            }).length;
            
            // Calculate customer segmentation
            const regular = customers.filter(c => c.customerType === 'regular').length;
            const business = customers.filter(c => c.customerType === 'business').length;
            const premiumCount = customers.filter(c => c.customerType === 'premium').length;
            
            // Calculate total customer value
            const totalValue = customers.reduce((sum, customer) => sum + customer.totalSpent, 0);
            
            totalCustomersEl.textContent = total;
            newThisWeekEl.textContent = newThisWeek;
            activeCustomersEl.textContent = active;
            premiumCustomersEl.textContent = premium;
            regularCountEl.textContent = regular;
            businessCountEl.textContent = business;
            premiumSegmentCountEl.textContent = premiumCount;
            totalCustomerValueEl.textContent = `$${totalValue.toLocaleString()}`;
        }

        // Add new customer
        function addNewCustomer() {
            // Get form values
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const address = document.getElementById('address').value;
            const city = document.getElementById('city').value;
            const state = document.getElementById('state').value;
            const zipCode = document.getElementById('zipCode').value;
            const company = document.getElementById('company').value;
            const customerType = document.getElementById('customerType').value;
            const status = document.getElementById('status').value;
            const notes = document.getElementById('notes').value;
            
            // Validate required fields
            if (!firstName || !lastName || !email || !customerType || !status) {
                alert('Please fill in all required fields');
                return;
            }
            
            // Create new customer object
            const newCustomer = {
                id: customers.length > 0 ? Math.max(...customers.map(c => c.id)) + 1 : 1,
                firstName,
                lastName,
                email,
                phone,
                address,
                city,
                state,
                zipCode,
                company,
                customerType,
                status,
                totalSpent: 0,
                lastService: new Date().toISOString().split('T')[0],
                servicesCount: 0,
                joinDate: new Date().toISOString().split('T')[0],
                notes
            };
            
            // Add to customers array
            customers.unshift(newCustomer);
            
            // Add to recent activities
            const activity = {
                id: activities.length + 1,
                type: "added",
                customerName: `${firstName} ${lastName}`,
                timestamp: "Just now",
                details: "New customer added to database"
            };
            
            activities.unshift(activity);
            
            // Update UI
            renderCustomers();
            renderActivities();
            updateStats();
            updatePaginationButtons();
            
            // Show success modal
            successTitle.textContent = 'Customer Added Successfully!';
            successMessage.textContent = `${firstName} ${lastName} has been added to your customer database.`;
            successModal.classList.remove('hidden');
            
            // Close add customer modal and reset form
            addCustomerModal.classList.add('hidden');
            customerForm.reset();
            
            // Switch to recent tab
            switchTab('recent');
        }

        // View customer details
        function viewCustomer(id) {
            const customer = customers.find(c => c.id === id);
            if (!customer) return;
            
            // Format dates
            const joinDate = new Date(customer.joinDate);
            const lastServiceDate = new Date(customer.lastService);
            const formattedJoinDate = joinDate.toLocaleDateString('en-US', {
                weekday: 'long',
                month: 'long',
                day: 'numeric',
                year: 'numeric'
            });
            const formattedLastService = lastServiceDate.toLocaleDateString('en-US', {
                month: 'long',
                day: 'numeric',
                year: 'numeric'
            });
            
            // Status badge
            let statusBadgeClass = '';
            let statusText = '';
            
            switch(customer.status) {
                case 'active':
                    statusBadgeClass = 'status-active';
                    statusText = 'Active';
                    break;
                case 'inactive':
                    statusBadgeClass = 'status-inactive';
                    statusText = 'Inactive';
                    break;
            }
            
            // Customer type badge
            let typeBadgeClass = '';
            let typeText = '';
            
            switch(customer.customerType) {
                case 'regular':
                    typeBadgeClass = 'type-regular';
                    typeText = 'Regular Customer';
                    break;
                case 'business':
                    typeBadgeClass = 'type-business';
                    typeText = 'Business Customer';
                    break;
                case 'premium':
                    typeBadgeClass = 'type-premium';
                    typeText = 'Premium Customer';
                    break;
            }
            
            // Get initials for avatar
            const initials = `${customer.firstName.charAt(0)}${customer.lastName.charAt(0)}`.toUpperCase();
            
            customerDetailContent.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <div class="flex items-start mb-6">
                            <div class="w-20 h-20 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center text-white font-semibold text-2xl mr-4">
                                ${initials}
                            </div>
                            <div>
                                <h4 class="text-2xl font-semibold">${customer.firstName} ${customer.lastName}</h4>
                                <div class="flex items-center space-x-3 mt-2">
                                    <span class="customer-type-badge ${typeBadgeClass}">${typeText}</span>
                                    <span class="status-badge ${statusBadgeClass}">${statusText}</span>
                                </div>
                                ${customer.company ? `<p class="text-gray-600 dark:text-gray-400 mt-1">${customer.company}</p>` : ''}
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Email Address</p>
                                <p class="font-medium">${customer.email}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Phone Number</p>
                                <p class="font-medium">${customer.phone || 'Not provided'}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Member Since</p>
                                <p class="font-medium">${formattedJoinDate}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Last Service</p>
                                <p class="font-medium">${formattedLastService}</p>
                            </div>
                        </div>
                        
                        ${customer.address || customer.city || customer.state ? `
                        <div class="mb-6">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Address</p>
                            <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                <p class="text-gray-700 dark:text-gray-300">
                                    ${customer.address ? `${customer.address}<br>` : ''}
                                    ${customer.city ? `${customer.city}, ` : ''}${customer.state || ''} ${customer.zipCode || ''}
                                </p>
                            </div>
                        </div>
                        ` : ''}
                        
                        ${customer.notes ? `
                        <div class="mb-6">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Notes</p>
                            <div class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                <p class="text-gray-700 dark:text-gray-300">${customer.notes}</p>
                            </div>
                        </div>
                        ` : ''}
                    </div>
                    
                    <div>
                        <div class="card p-4 mb-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Customer Stats</p>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span>Total Services</span>
                                    <span class="font-bold">${customer.servicesCount}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Total Spent</span>
                                    <span class="font-bold">$${customer.totalSpent.toLocaleString()}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Avg. Service Value</span>
                                    <span class="font-bold">$${customer.servicesCount > 0 ? Math.round(customer.totalSpent / customer.servicesCount) : 0}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card p-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Quick Actions</p>
                            <div class="space-y-2">
                                <button class="w-full btn-primary py-2 rounded-lg font-medium" onclick="scheduleAppointment(${customer.id})">
                                    <i class="fas fa-calendar-plus mr-2"></i> Schedule Appointment
                                </button>
                                <button class="w-full btn-secondary py-2 rounded-lg font-medium" onclick="sendMessage(${customer.id})">
                                    <i class="fas fa-envelope mr-2"></i> Send Message
                                </button>
                                <button class="w-full btn-secondary py-2 rounded-lg font-medium" onclick="createInvoice(${customer.id})">
                                    <i class="fas fa-file-invoice-dollar mr-2"></i> Create Invoice
                                </button>
                                <button class="w-full btn-secondary py-2 rounded-lg font-medium text-red-600 dark:text-red-400" onclick="deleteCustomer(${customer.id})">
                                    <i class="fas fa-trash-alt mr-2"></i> Delete Customer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            customerDetailModal.classList.remove('hidden');
        }

        // Edit customer
        function editCustomer(id) {
            const customer = customers.find(c => c.id === id);
            if (!customer) return;
            
            // In a real app, this would populate the form with customer data
            // and show an edit modal instead of add modal
            alert(`Editing customer: ${customer.firstName} ${customer.lastName}. In a real app, this would open an edit form.`);
        }

        // Delete customer
        function deleteCustomer(id) {
            const customer = customers.find(c => c.id === id);
            if (!customer) return;
            
            if (confirm(`Are you sure you want to delete ${customer.firstName} ${customer.lastName}? This action cannot be undone.`)) {
                const customerIndex = customers.findIndex(c => c.id === id);
                if (customerIndex !== -1) {
                    customers.splice(customerIndex, 1);
                    
                    // Add to recent activities
                    const activity = {
                        id: activities.length + 1,
                        type: "deleted",
                        customerName: `${customer.firstName} ${customer.lastName}`,
                        timestamp: "Just now",
                        details: "Customer removed from database"
                    };
                    
                    activities.unshift(activity);
                    
                    // Update UI
                    renderCustomers();
                    renderActivities();
                    updateStats();
                    updatePaginationButtons();
                    
                    // Close detail modal if open
                    customerDetailModal.classList.add('hidden');
                    
                    alert(`Customer ${customer.firstName} ${customer.lastName} has been deleted.`);
                }
            }
        }

        // Update pagination buttons
        function updatePaginationButtons() {
            const filteredCustomers = filterCustomers();
            const totalPages = Math.ceil(filteredCustomers.length / itemsPerPage);
            
            prevPage.disabled = currentPage === 1;
            nextPage.disabled = currentPage === totalPages || totalPages === 0;
        }

        // Export customers to CSV
        function exportCustomersToCSV() {
            const filteredCustomers = filterCustomers();
            
            if (filteredCustomers.length === 0) {
                alert('No customers to export');
                return;
            }
            
            // Create CSV content
            let csvContent = "First Name,Last Name,Email,Phone,Company,Type,Status,Total Spent,Last Service\n";
            
            filteredCustomers.forEach(customer => {
                const row = [
                    customer.firstName,
                    customer.lastName,
                    customer.email,
                    customer.phone || '',
                    customer.company || '',
                    customer.customerType,
                    customer.status,
                    customer.totalSpent,
                    customer.lastService
                ];
                
                csvContent += row.join(',') + '\n';
            });
            
            // Create download link
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `customers_${new Date().toISOString().split('T')[0]}.csv`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            
            alert(`Exported ${filteredCustomers.length} customers to CSV file`);
        }

        // Customer action functions
        function scheduleAppointment(id) {
            const customer = customers.find(c => c.id === id);
            if (customer) {
                alert(`Scheduling appointment for ${customer.firstName} ${customer.lastName}. In a real app, this would open the appointment scheduler.`);
            }
        }

        function sendMessage(id) {
            const customer = customers.find(c => c.id === id);
            if (customer) {
                alert(`Sending message to ${customer.firstName} ${customer.lastName} at ${customer.email}. In a real app, this would open your email client.`);
            }
        }

        function createInvoice(id) {
            const customer = customers.find(c => c.id === id);
            if (customer) {
                alert(`Creating invoice for ${customer.firstName} ${customer.lastName}. In a real app, this would open the invoice creation form.`);
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