            <!-- Navigation -->
            <nav class="flex-1 p-6">
                <div class="space-y-2">
                    <div>
                        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Main</p>
                        <a href="{{route('dashboard')}}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400">
                            <i class="fas fa-home"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                        <a href="{{route('appointment')}}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Appointments</span>
                        </a>
                        <a href="{{route('customer')}}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                            <i class="fas fa-users"></i>
                            <span>Customers</span>
                        </a>
                        <a href="{{route('revenue')}}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                            <i class="fas fa-dollar-sign"></i>
                            <span>Revenue</span>
                        </a>
                        <a href="{{route('analytics')}}" class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
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