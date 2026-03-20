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
                                <a href="{{route('customer.add')}}">
                                <i class="fas fa-user-plus"></i>
                                <span>Add Customer</span></a>
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
                                <h3 class="text-3xl font-bold mt-2" id="totalCustomers">{{$counts}}</h3>
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
                                    <th class="pb-3 px-6 pt-4">Service Count</th>
                                   
                                    <th class="pb-3 px-6 pt-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="customerTableBody">
                                <!-- Customer rows will be loaded here dynamically -->
                                 @if (count($customers) > 0)
                                    @foreach ($customers as $key=>$customer)
                                    <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-800/30">
                                        <td class="px-6 py-4">{{$customer->first_name}} {{$customer->last_name}}</td>
                                        <td class="px-6 py-4">{{$customer->phone}}<br>{{$customer->email}}</td>
                                        <td class="px-6 py-4">VIP</td>
                                        <td class="px-6 py-4">₴{{$customer->total_spent}}</td>
                                        <td class="px-6 py-4">{{$customer->service_count}}</td>
                                        <td class="px-6 py-4 text-right">
                                            <button class="text-blue-600 dark:text-blue-400">View</button>
                                        </td>
                                    </tr>
                                    @endforeach


                                @endif

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

      

        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.querySelector('.mobile-menu');
            mobileMenu.classList.toggle('active');
        }
    </script>
</body>
</html>