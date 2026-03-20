<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Customer | ServiceDash</title>
    <!-- Using same Tailwind + Font Awesome + base styles from the dashboard, with minimal adjustments for a standalone form -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* keeping the core design tokens & utility classes consistent with the original */
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 1rem;
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

        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
            outline: none;
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

        /* subtle animation */
        @keyframes gentleFade {
            0% { opacity:0; transform: translateY(10px); }
            100% { opacity:1; transform: translateY(0); }
        }
        .animate-form {
            animation: gentleFade 0.5s ease forwards;
        }

        /* custom scrollbar (as original) */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(156,163,175,0.5); border-radius: 4px; }
    </style>
</head>
<body class="light">  <!-- class "light" can be toggled, but we keep simple; you can embed theme toggle if needed -->
    <!-- standalone ADD CUSTOMER FORM page with dedicated brand logo space (no sidebar, no header, only form) -->
    <div class="w-full max-w-3xl mx-auto animate-form">
        <!-- Brand logo space — exactly as requested: make space for brandlogo (prominent, above form) -->
        <div class="text-center mb-8">

            @include('layouts.brand')
        </div>

        <!-- main form card (exactly the same design as modal but full page, and with added space) -->
        <div class="card w-full p-6 md:p-8">
            <div class="mb-6 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <h3 class="text-2xl font-semibold flex items-center"><i class="fas fa-user-plus text-primary mr-3 text-blue-600"></i>Add new customer</h3>
                <!-- optional back button (could be a link to customer list) — not required but user-friendly -->
                <a href="{{route('customer')}}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline flex items-center"><i class="fas fa-arrow-left mr-1"></i> Back</a>
            </div>
            
            <!-- ========== THE FULL ADD CUSTOMER FORM (exactly from modal, but arranged for page) ========= -->
            <form id="customerFormPage" action="{{route('customer.store')}}" method="post">@csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="md:col-span-2">
                        <h4 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200"><i class="fas fa-user-circle mr-2 text-blue-500"></i>Personal Information</h4>
                    </div>
                    
                    <div>
                        <label class="form-label form-required" for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" required 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent form-input">
                    </div>
                    
                    <div>
                        <label class="form-label form-required" for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" required 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent form-input">
                    </div>
                    
                    <div>
                        <label class="form-label form-required" for="email">Email Address</label>
                        <input type="email" id="email" name="email" required 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent form-input">
                    </div>
                    
                    <div>
                        <label class="form-label" for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-transparent form-input">
                    </div>
                    

                    
                </div>
                
                <!-- Form Actions (submit / cancel) -->
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 mt-10 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="button"
                            class="btn-secondary px-8 py-3 rounded-lg font-medium order-2 sm:order-1">
                            <a href="{{route('customer')}}">
                        <i class="fas fa-times mr-2"></i>Cancel</a>
                    </button>
                    <button type="submit" 
                            class="btn-primary px-8 py-3 rounded-lg text-white font-medium flex items-center justify-center space-x-2 order-1 sm:order-2">
                        <i class="fas fa-user-plus"></i>
                        <span>Add Customer</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- subtle footer note (optional) -->
        <p class="text-center text-xs text-gray-500 dark:text-gray-400 mt-6">ServiceDash · Customer management</p>
    </div>

    <!-- JavaScript to handle form submission simulation (same as original add, but without the main dashboard globals) -->
    <script>
        (function() {
            // This script mimics the original "addNewCustomer" behavior, 
            // but for the standalone page we just show a success message and redirect concept.
            // No global customers array here — we treat it as a real form that would send data.
            // const form = document.getElementById('customerFormPage');

            // simple success modal simulation (like in original but we don't have modal HTML on this page, we can show alert or create a toast)
            // for UX we replicate a success message similar to the dashboard.
            function showSuccessMessage(customerName) {
                // just an alert for simplicity, but you can replace with your modal if needed.
                alert(`✅ Customer added successfully!\n\n${customerName} has been added to your database. (Demo mode — no actual data saved.)`);
                // optional: reset form
                form.reset();
            }

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Gather data for demo message
                const firstName = document.getElementById('firstName').value.trim();
                const lastName = document.getElementById('lastName').value.trim();
                const email = document.getElementById('email').value.trim();
                const customerType = document.getElementById('customerType').value;
                const status = document.getElementById('status').value;

                if (!firstName || !lastName || !email || !customerType || !status) {
                    alert('Please fill in all required fields (First Name, Last Name, Email, Customer Type, Status).');
                    return;
                }

                // demo success
                const fullName = firstName + ' ' + lastName;
                showSuccessMessage(fullName);

                // In a real app you would POST to server. Here we just simulate.
                // You can optionally redirect or clear form.
            });

            // Optional: add small dark mode toggle? not needed, but we keep the "light" class.
            // The original page had theme toggle, but we can ignore to keep minimal.
        })();
    </script>

    <!-- If you need the exact success modal from the original, you can paste its HTML here. But to keep it clean I used alert. -->
    <!-- However, to stay 100% consistent, I'll include a hidden success modal that can be triggered via JS if desired. 
         But the brief only asks for the form page, so an alert is fine. For completeness, I'll include a minimal success snackbar -->
    <style>
        /* simulated success snackbar (replaces modal for this standalone page) */
        .toast-success {
            position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%);
            background: #10b981; color: white; padding: 12px 24px; border-radius: 50px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); display: flex; align-items: center;
            gap: 0.75rem; font-weight: 500; transition: all 0.3s; z-index: 1000;
        }
        .toast-success i { font-size: 1.25rem; }
        .hidden-toast { opacity: 0; visibility: hidden; bottom: 16px; }
    </style>
    <div id="successToast" class="toast-success hidden-toast">
        <i class="fas fa-check-circle"></i>
        <span id="toastMessage">Customer added!</span>
    </div>
    <script>
        // override showSuccessMessage to use toast (optional, keeps design consistent)
        const originalShow = showSuccessMessage;
        showSuccessMessage = function(name) {
            const toast = document.getElementById('successToast');
            const msgSpan = document.getElementById('toastMessage');
            msgSpan.innerText = `${name} has been added.`;
            toast.classList.remove('hidden-toast');
            setTimeout(() => {
                toast.classList.add('hidden-toast');
            }, 4000);
            form.reset();
        };
        // re-attach event to use new function
        form.removeEventListener('submit', form.submit); // remove old
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const firstName = document.getElementById('firstName').value.trim();
            const lastName = document.getElementById('lastName').value.trim();
            const email = document.getElementById('email').value.trim();
            const customerType = document.getElementById('customerType').value;
            const status = document.getElementById('status').value;
            if (!firstName || !lastName || !email || !customerType || !status) {
                alert('Please fill in all required fields.');
                return;
            }
            showSuccessMessage(firstName + ' ' + lastName);
        });
    </script>
</body>
</html>