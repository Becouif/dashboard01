            <div class="p-6 border-b border-gray-200 dark:border-gray-800">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-chart-pie text-white text-lg"></i>
                    </div>
                    <div>
                        <a href="{{route('dashboard')}}"><h1 class="text-xl font-bold tracking-tight">ServiceDash</h1>
                        @if (Route::has('appointment'))
                                                  <p class="text-xs text-gray-500 dark:text-gray-400">Appointment Management</p>
                        @endif
                        <p class="text-xs text-gray-500 dark:text-gray-400">Business Dashboard</p></a>
                    </div>
                </div>
            </div>