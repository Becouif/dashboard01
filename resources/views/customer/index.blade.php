<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashboardPro | Customer Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom styles matching dashboard aesthetic */
        .dashboard-card {
            background: linear-gradient(145deg, #ffffff, #f8fafc);
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.08), 0 2px 4px -1px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }
        
        .dashboard-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04);
        }
        
        .form-input-focus:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }
        
        .dashboard-header {
            background: linear-gradient(90deg, #4f46e5 0%, #7c73e6 100%);
        }
        
        .btn-primary {
            background: linear-gradient(90deg, #4f46e5 0%, #7c73e6 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(90deg, #4338ca 0%, #6d63d9 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        }
        
        .btn-secondary {
            background: #f1f5f9;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: #e2e8f0;
        }
        
        .status-active {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .status-inactive {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .status-premium {
            background-color: #e0e7ff;
            color: #3730a3;
        }
        
        .tab-active {
            border-bottom: 3px solid #4f46e5;
            color: #4f46e5;
            font-weight: 600;
        }
        
        .customer-row:hover {
            background-color: #f8fafc;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from { transform: translateX(20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        .animate-slide-in {
            animation: slideIn 0.4s ease-out;
        }
        
        /* Modal overlay */
        .modal-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="dashboard-header text-white shadow-lg">
            <div class="container mx-auto px-4 py-6">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white p-2 rounded-lg">
                            <i class="fas fa-users text-indigo-600 text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold">DashboardPro</h1>
                            <p class="text-indigo-100 text-sm">Customer Management System</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="hidden md:flex items-center space-x-3">
                            <div class="relative">
                                <i class="fas fa-bell text-white"></i>
                                <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                            </div>
                            <div class="flex items-center space-x-2 bg-white/20 p-2 rounded-lg">
                                <i class="fas fa-user-circle"></i>
                                <span>Sales Manager</span>
                            </div>
                        </div>
                        <button class="p-2 hover:bg-white/20 rounded-lg transition">
                            <i class="fas fa-cog"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Left Sidebar -->
                <div class="lg:w-1/4">
                    <div class="dashboard-card rounded-xl p-6 mb-6">
                        <h2 class="font-bold text-lg mb-4 text-gray-700">Navigation</h2>
                        <nav class="space-y-2">
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:bg-indigo-50 hover:text-indigo-700 transition">
                                <i class="fas fa-tachometer-alt w-5"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg bg-indigo-50 text-indigo-700 font-medium">
                                <i class="fas fa-users w-5"></i>
                                <span>Customers</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:bg-indigo-50 hover:text-indigo-700 transition">
                                <i class="fas fa-shopping-cart w-5"></i>
                                <span>Orders</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:bg-indigo-50 hover:text-indigo-700 transition">
                                <i class="fas fa-chart-line w-5"></i>
                                <span>Analytics</span>
                            </a>
                            <a href="#" class="flex items-center space-x-3 p-3 rounded-lg text-gray-600 hover:bg-indigo-50 hover:text-indigo-700 transition">
                                <i class="fas fa-cog w-5"></i>
                                <span>Settings</span>
                            </a>
                        </nav>
                        
                        <div class="border-t my-6 pt-6">
                            <h3 class="font-bold text-sm mb-3 text-gray-500 uppercase">Customer Stats</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Total Customers</span>
                                    <span class="font-bold" id="totalCustomers">0</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Active</span>
                                    <span class="font-bold" id="activeCustomers">0</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Premium</span>
                                    <span class="font-bold" id="premiumCustomers">0</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">New This Month</span>
                                    <span class="font-bold" id="newThisMonth">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dashboard-card rounded-xl p-6">
                        <h3 class="font-bold text-lg mb-4 text-gray-700">Quick Actions</h3>
                        <div class="space-y-3">
                            <button id="addCustomerBtn" class="w-full btn-primary text-white py-3 rounded-lg font-medium flex items-center justify-center space-x-2">
                                <i class="fas fa-user-plus"></i>
                                <span>Add New Customer</span>
                            </button>
                            <button class="w-full btn-secondary py-3 rounded-lg font-medium flex items-center justify-center space-x-2">
                                <i class="fas fa-file-export"></i>
                                <span>Export Customers</span>
                            </button>
                            <button class="w-full btn-secondary py-3 rounded-lg font-medium flex items-center justify-center space-x-2">
                                <i class="fas fa-filter"></i>
                                <span>Filter Customers</span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Main Content Area -->
                <div class="lg:w-3/4">
                    <!-- Page Header -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Customer Management</h2>
                            <p class="text-gray-600">Add, view, and manage your customer database</p>
                        </div>
                        <div class="flex space-x-3 mt-4 md:mt-0">
                            <div class="relative">
                                <input type="text" placeholder="Search customers..." 
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                            <button class="btn-primary px-4 py-2 rounded-lg text-white font-medium flex items-center space-x-2">
                                <i class="fas fa-sync-alt"></i>
                                <span>Refresh</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Tabs -->
                    <div class="flex border-b mb-8">
                        <button id="viewCustomersTab" class="tab-active px-6 py-3 font-medium">All Customers</button>
                        <button id="addCustomerTab" class="px-6 py-3 font-medium text-gray-600 hover:text-gray-800">Add Customer</button>
                        <button class="px-6 py-3 font-medium text-gray-600 hover:text-gray-800">Segments</button>
                    </div>
                    
                    <!-- Customer List View -->
                    <div id="customersListView" class="dashboard-card rounded-xl p-6 animate-fade-in">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800">Customer Directory</h3>
                            <div class="text-sm text-gray-600">
                                Showing <span id="showingCount">0</span> of <span id="totalCount">0</span> customers
                            </div>
                        </div>
                        
                        <!-- Customer Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-3 px-4 font-medium text-gray-700">Customer</th>
                                        <th class="text-left py-3 px-4 font-medium text-gray-700">Contact</th>
                                        <th class="text-left py-3 px-4 font-medium text-gray-700">Status</th>
                                        <th class="text-left py-3 px-4 font-medium text-gray-700">Customer Since</th>
                                        <th class="text-left py-3 px-4 font-medium text-gray-700">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="customersTableBody">
                                    <!-- Customer rows will be dynamically inserted here -->
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Empty State -->
                        <div id="emptyState" class="text-center py-12 hidden">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                                <i class="fas fa-users text-gray-400 text-2xl"></i>
                            </div>
                            <h4 class="text-lg font-medium text-gray-800 mb-2">No customers yet</h4>
                            <p class="text-gray-600 mb-6">Get started by adding your first customer</p>
                            <button id="addFirstCustomerBtn" class="btn-primary px-6 py-3 rounded-lg text-white font-medium">
                                <i class="fas fa-user-plus mr-2"></i>
                                Add First Customer
                            </button>
                        </div>
                        
                        <!-- Loading State -->
                        <div id="loadingState" class="text-center py-12">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 rounded-full mb-4">
                                <i class="fas fa-spinner fa-spin text-indigo-600 text-2xl"></i>
                            </div>
                            <p class="text-gray-600">Loading customers...</p>
                        </div>
                    </div>
                    
                    <!-- Add Customer Form (Hidden by default) -->
                    <div id="addCustomerForm" class="dashboard-card rounded-xl p-6 hidden">
                        <div class="flex justify-between items-center mb-8">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Add New Customer</h3>
                                <p class="text-gray-600">Fill in the customer details below</p>
                            </div>
                            <button id="closeFormBtn" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        
                        <form id="customerForm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="customerName">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="customerName" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input-focus focus:outline-none"
                                        placeholder="John Smith">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="customerEmail">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" id="customerEmail" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input-focus focus:outline-none"
                                        placeholder="customer@example.com">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="customerPhone">
                                        Phone Number
                                    </label>
                                    <input type="tel" id="customerPhone"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input-focus focus:outline-none"
                                        placeholder="(123) 456-7890">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="customerCompany">
                                        Company
                                    </label>
                                    <input type="text" id="customerCompany"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input-focus focus:outline-none"
                                        placeholder="Company Name">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="customerType">
                                        Customer Type <span class="text-red-500">*</span>
                                    </label>
                                    <select id="customerType" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input-focus focus:outline-none">
                                        <option value="" disabled selected>Select type</option>
                                        <option value="individual">Individual</option>
                                        <option value="business">Business</option>
                                        <option value="enterprise">Enterprise</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="customerStatus">
                                        Status <span class="text-red-500">*</span>
                                    </label>
                                    <select id="customerStatus" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input-focus focus:outline-none">
                                        <option value="active" selected>Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="premium">Premium</option>
                                    </select>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="customerAddress">
                                        Address
                                    </label>
                                    <input type="text" id="customerAddress"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input-focus focus:outline-none"
                                        placeholder="123 Main St, City, State, ZIP">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2" for="customerNotes">
                                        Notes
                                    </label>
                                    <textarea id="customerNotes" rows="3"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg form-input-focus focus:outline-none"
                                        placeholder="Additional notes about this customer..."></textarea>
                                </div>
                            </div>
                            
                            <div class="flex justify-end space-x-4 pt-6 border-t">
                                <button type="button" id="cancelFormBtn" class="btn-secondary px-6 py-3 rounded-lg font-medium">
                                    Cancel
                                </button>
                                <button type="submit" class="btn-primary px-6 py-3 rounded-lg text-white font-medium flex items-center space-x-2">
                                    <i class="fas fa-user-plus"></i>
                                    <span>Add Customer</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Recent Activity -->
                    <div class="mt-8 dashboard-card rounded-xl p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Recent Customer Activity</h3>
                        <div class="space-y-4" id="recentActivity">
                            <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                    <i class="fas fa-user-plus text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium">No recent customer activity</p>
                                    <p class="text-sm text-gray-600">Add customers to see activity here</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="border-t bg-white mt-12">
            <div class="container mx-auto px-4 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-gray-600 mb-4 md:mb-0">
                        <p>&copy; 2023 DashboardPro. Customer Management System v2.1</p>
                    </div>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-600 hover:text-indigo-600 transition">Help Center</a>
                        <a href="#" class="text-gray-600 hover:text-indigo-600 transition">API Docs</a>
                        <a href="#" class="text-gray-600 hover:text-indigo-600 transition">Status</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 flex items-center justify-center z-50 hidden modal-overlay">
        <div class="dashboard-card rounded-xl p-8 max-w-md mx-4 animate-slide-in">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <i class="fas fa-check text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Customer Added Successfully!</h3>
                <p class="text-gray-600 mb-6">The new customer has been added to your database.</p>
                <button id="closeModalBtn" class="btn-primary px-6 py-3 rounded-lg text-white font-medium">
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
                name: "Alex Johnson",
                email: "alex.johnson@email.com",
                phone: "(555) 123-4567",
                company: "TechCorp Inc",
                type: "Business",
                status: "active",
                joinDate: "2023-01-15",
                address: "123 Tech Street, San Francisco, CA"
            },
            {
                id: 2,
                name: "Maria Rodriguez",
                email: "maria.rodriguez@email.com",
                phone: "(555) 987-6543",
                company: "Design Studio",
                type: "Enterprise",
                status: "premium",
                joinDate: "2022-11-03",
                address: "456 Design Ave, New York, NY"
            },
            {
                id: 3,
                name: "James Wilson",
                email: "james.wilson@email.com",
                phone: "(555) 456-7890",
                company: "Wilson Consulting",
                type: "Individual",
                status: "active",
                joinDate: "2023-03-22",
                address: "789 Consultant Blvd, Chicago, IL"
            },
            {
                id: 4,
                name: "Sarah Chen",
                email: "sarah.chen@email.com",
                phone: "(555) 321-0987",
                company: "Green Energy Co",
                type: "Business",
                status: "inactive",
                joinDate: "2022-08-10",
                address: "101 Green Way, Seattle, WA"
            }
        ];

        // State management
        let customers = [...sampleCustomers];
        let recentActivities = [];

        // DOM Elements
        const customersListView = document.getElementById('customersListView');
        const addCustomerForm = document.getElementById('addCustomerForm');
        const viewCustomersTab = document.getElementById('viewCustomersTab');
        const addCustomerTab = document.getElementById('addCustomerTab');
        const addCustomerBtn = document.getElementById('addCustomerBtn');
        const addFirstCustomerBtn = document.getElementById('addFirstCustomerBtn');
        const closeFormBtn = document.getElementById('closeFormBtn');
        const cancelFormBtn = document.getElementById('cancelFormBtn');
        const customerForm = document.getElementById('customerForm');
        const customersTableBody = document.getElementById('customersTableBody');
        const emptyState = document.getElementById('emptyState');
        const loadingState = document.getElementById('loadingState');
        const successModal = document.getElementById('successModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const recentActivityContainer = document.getElementById('recentActivity');
        
        // Stats elements
        const totalCustomersEl = document.getElementById('totalCustomers');
        const activeCustomersEl = document.getElementById('activeCustomers');
        const premiumCustomersEl = document.getElementById('premiumCustomers');
        const newThisMonthEl = document.getElementById('newThisMonth');
        const showingCountEl = document.getElementById('showingCount');
        const totalCountEl = document.getElementById('totalCount');

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            // Load customers
            setTimeout(() => {
                renderCustomers();
                updateStats();
                loadingState.classList.add('hidden');
                
                if (customers.length === 0) {
                    emptyState.classList.remove('hidden');
                }
            }, 800); // Simulate loading delay
            
            // Event listeners for tabs
            viewCustomersTab.addEventListener('click', () => {
                switchToViewCustomers();
            });
            
            addCustomerTab.addEventListener('click', () => {
                switchToAddCustomer();
            });
            
            // Event listeners for buttons
            addCustomerBtn.addEventListener('click', () => {
                switchToAddCustomer();
            });
            
            addFirstCustomerBtn.addEventListener('click', () => {
                switchToAddCustomer();
            });
            
            closeFormBtn.addEventListener('click', () => {
                switchToViewCustomers();
            });
            
            cancelFormBtn.addEventListener('click', () => {
                switchToViewCustomers();
                customerForm.reset();
            });
            
            // Form submission
            customerForm.addEventListener('submit', function(e) {
                e.preventDefault();
                addNewCustomer();
            });
            
            // Modal close
            closeModalBtn.addEventListener('click', () => {
                successModal.classList.add('hidden');
            });
            
            // Close modal when clicking outside
            successModal.addEventListener('click', (e) => {
                if (e.target === successModal) {
                    successModal.classList.add('hidden');
                }
            });
        });

        // Switch to view customers tab
        function switchToViewCustomers() {
            addCustomerForm.classList.add('hidden');
            customersListView.classList.remove('hidden');
            
            viewCustomersTab.classList.add('tab-active');
            viewCustomersTab.classList.remove('text-gray-600', 'hover:text-gray-800');
            
            addCustomerTab.classList.remove('tab-active');
            addCustomerTab.classList.add('text-gray-600', 'hover:text-gray-800');
        }

        // Switch to add customer tab
        function switchToAddCustomer() {
            customersListView.classList.add('hidden');
            addCustomerForm.classList.remove('hidden');
            
            addCustomerTab.classList.add('tab-active');
            addCustomerTab.classList.remove('text-gray-600', 'hover:text-gray-800');
            
            viewCustomersTab.classList.remove('tab-active');
            viewCustomersTab.classList.add('text-gray-600', 'hover:text-gray-800');
            
            // Clear form
            customerForm.reset();
        }

        // Render customers table
        function renderCustomers() {
            customersTableBody.innerHTML = '';
            
            if (customers.length === 0) {
                emptyState.classList.remove('hidden');
                return;
            }
            
            emptyState.classList.add('hidden');
            
            customers.forEach(customer => {
                const row = document.createElement('tr');
                row.className = 'border-b border-gray-100 customer-row transition-all duration-200';
                
                // Status badge
                let statusClass = '';
                let statusText = '';
                
                switch(customer.status) {
                    case 'active':
                        statusClass = 'status-active';
                        statusText = 'Active';
                        break;
                    case 'inactive':
                        statusClass = 'status-inactive';
                        statusText = 'Inactive';
                        break;
                    case 'premium':
                        statusClass = 'status-premium';
                        statusText = 'Premium';
                        break;
                }
                
                // Format date
                const joinDate = new Date(customer.joinDate);
                const formattedDate = joinDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
                
                row.innerHTML = `
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-indigo-600"></i>
                            </div>
                            <div>
                                <div class="font-medium text-gray-900">${customer.name}</div>
                                <div class="text-sm text-gray-600">${customer.company || 'No company'}</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4">
                        <div class="text-gray-900">${customer.email}</div>
                        <div class="text-sm text-gray-600">${customer.phone || 'No phone'}</div>
                    </td>
                    <td class="py-4 px-4">
                        <span class="px-3 py-1 rounded-full text-sm font-medium ${statusClass}">${statusText}</span>
                    </td>
                    <td class="py-4 px-4 text-gray-700">${formattedDate}</td>
                    <td class="py-4 px-4">
                        <div class="flex space-x-2">
                            <button class="text-indigo-600 hover:text-indigo-800 p-1" onclick="viewCustomer(${customer.id})">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="text-gray-600 hover:text-gray-800 p-1" onclick="editCustomer(${customer.id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="text-red-600 hover:text-red-800 p-1" onclick="deleteCustomer(${customer.id})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                customersTableBody.appendChild(row);
            });
            
            // Update counts
            showingCountEl.textContent = customers.length;
            totalCountEl.textContent = customers.length;
        }

        // Add new customer
        function addNewCustomer() {
            // Get form values
            const name = document.getElementById('customerName').value;
            const email = document.getElementById('customerEmail').value;
            const phone = document.getElementById('customerPhone').value;
            const company = document.getElementById('customerCompany').value;
            const type = document.getElementById('customerType').value;
            const status = document.getElementById('customerStatus').value;
            const address = document.getElementById('customerAddress').value;
            const notes = document.getElementById('customerNotes').value;
            
            // Create new customer object
            const newCustomer = {
                id: customers.length > 0 ? Math.max(...customers.map(c => c.id)) + 1 : 1,
                name,
                email,
                phone,
                company,
                type,
                status,
                address,
                notes,
                joinDate: new Date().toISOString().split('T')[0]
            };
            
            // Add to customers array
            customers.unshift(newCustomer);
            
            // Add to recent activities
            const activity = {
                type: 'added',
                customerName: name,
                timestamp: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}),
                date: new Date().toLocaleDateString('en-US', {month: 'short', day: 'numeric'})
            };
            
            recentActivities.unshift(activity);
            
            // Update UI
            renderCustomers();
            updateStats();
            updateRecentActivity();
            
            // Show success modal
            successModal.classList.remove('hidden');
            
            // Reset form and switch to view
            customerForm.reset();
            setTimeout(() => {
                switchToViewCustomers();
            }, 500);
        }

        // Update stats
        function updateStats() {
            const total = customers.length;
            const active = customers.filter(c => c.status === 'active').length;
            const premium = customers.filter(c => c.status === 'premium').length;
            
            // Calculate new this month (simplified)
            const currentMonth = new Date().getMonth();
            const currentYear = new Date().getFullYear();
            const newThisMonth = customers.filter(c => {
                const joinDate = new Date(c.joinDate);
                return joinDate.getMonth() === currentMonth && joinDate.getFullYear() === currentYear;
            }).length;
            
            totalCustomersEl.textContent = total;
            activeCustomersEl.textContent = active;
            premiumCustomersEl.textContent = premium;
            newThisMonthEl.textContent = newThisMonth;
        }

        // Update recent activity
        function updateRecentActivity() {
            recentActivityContainer.innerHTML = '';
            
            if (recentActivities.length === 0) {
                recentActivityContainer.innerHTML = `
                    <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-user-plus text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-medium">No recent customer activity</p>
                            <p class="text-sm text-gray-600">Add customers to see activity here</p>
                        </div>
                    </div>
                `;
                return;
            }
            
            // Show latest 3 activities
            const recent = recentActivities.slice(0, 3);
            
            recent.forEach(activity => {
                const activityEl = document.createElement('div');
                activityEl.className = 'flex items-center p-3 bg-green-50 rounded-lg';
                
                let icon = 'fa-user-plus';
                let color = 'text-green-600';
                let bgColor = 'bg-green-100';
                let actionText = 'added';
                
                if (activity.type === 'updated') {
                    icon = 'fa-edit';
                    color = 'text-blue-600';
                    bgColor = 'bg-blue-100';
                    actionText = 'updated';
                } else if (activity.type === 'deleted') {
                    icon = 'fa-trash-alt';
                    color = 'text-red-600';
                    bgColor = 'bg-red-100';
                    actionText = 'deleted';
                }
                
                activityEl.innerHTML = `
                    <div class="${bgColor} p-2 rounded-lg mr-3">
                        <i class="fas ${icon} ${color}"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium">Customer ${activity.customerName} ${actionText}</p>
                        <p class="text-sm text-gray-600">${activity.date} at ${activity.timestamp}</p>
                    </div>
                `;
                
                recentActivityContainer.appendChild(activityEl);
            });
        }

        // Customer actions
        function viewCustomer(id) {
            const customer = customers.find(c => c.id === id);
            alert(`Viewing customer: ${customer.name}\nEmail: ${customer.email}\nPhone: ${customer.phone}\nStatus: ${customer.status}`);
        }

        function editCustomer(id) {
            const customer = customers.find(c => c.id === id);
            
            // Populate form with customer data
            document.getElementById('customerName').value = customer.name;
            document.getElementById('customerEmail').value = customer.email;
            document.getElementById('customerPhone').value = customer.phone;
            document.getElementById('customerCompany').value = customer.company;
            document.getElementById('customerType').value = customer.type.toLowerCase();
            document.getElementById('customerStatus').value = customer.status;
            document.getElementById('customerAddress').value = customer.address;
            document.getElementById('customerNotes').value = customer.notes || '';
            
            // Switch to form
            switchToAddCustomer();
            
            // Change form title and button
            document.querySelector('#addCustomerForm h3').textContent = 'Edit Customer';
            document.querySelector('#addCustomerForm p').textContent = 'Update customer details';
            const submitBtn = customerForm.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-save"></i><span>Update Customer</span>';
            
            // Update form submission
            const originalSubmit = customerForm.onsubmit;
            customerForm.onsubmit = function(e) {
                e.preventDefault();
                
                // Update customer
                customer.name = document.getElementById('customerName').value;
                customer.email = document.getElementById('customerEmail').value;
                customer.phone = document.getElementById('customerPhone').value;
                customer.company = document.getElementById('customerCompany').value;
                customer.type = document.getElementById('customerType').value;
                customer.status = document.getElementById('customerStatus').value;
                customer.address = document.getElementById('customerAddress').value;
                customer.notes = document.getElementById('customerNotes').value;
                
                // Add to recent activities
                const activity = {
                    type: 'updated',
                    customerName: customer.name,
                    timestamp: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}),
                    date: new Date().toLocaleDateString('en-US', {month: 'short', day: 'numeric'})
                };
                
                recentActivities.unshift(activity);
                
                // Update UI
                renderCustomers();
                updateStats();
                updateRecentActivity();
                
                // Show success message
                alert(`Customer ${customer.name} updated successfully!`);
                
                // Reset form and switch to view
                customerForm.reset();
                customerForm.onsubmit = originalSubmit;
                switchToViewCustomers();
                
                // Reset form title and button
                document.querySelector('#addCustomerForm h3').textContent = 'Add New Customer';
                document.querySelector('#addCustomerForm p').textContent = 'Fill in the customer details below';
                submitBtn.innerHTML = '<i class="fas fa-user-plus"></i><span>Add Customer</span>';
            };
        }

        function deleteCustomer(id) {
            if (confirm('Are you sure you want to delete this customer? This action cannot be undone.')) {
                const customerIndex = customers.findIndex(c => c.id === id);
                const customerName = customers[customerIndex].name;
                
                // Add to recent activities
                const activity = {
                    type: 'deleted',
                    customerName: customerName,
                    timestamp: new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}),
                    date: new Date().toLocaleDateString('en-US', {month: 'short', day: 'numeric'})
                };
                
                recentActivities.unshift(activity);
                
                // Remove customer
                customers.splice(customerIndex, 1);
                
                // Update UI
                renderCustomers();
                updateStats();
                updateRecentActivity();
                
                alert(`Customer ${customerName} deleted successfully.`);
            }
        }
    </script>
</body>
</html>