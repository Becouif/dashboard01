<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;



class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        $counts = $customers->count();

        return view('customer.index',compact('customers','counts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.add-customer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validated = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'phone' => 'required',

        ]);
        $data = $request->all();
        
        $userID = User::where('email', 'admin@admin.com')->value('id');

        // dd($userID);


        Customer::create([
            'user_id' => $userID,
            'first_name'=> $data['firstName'],
            'last_name' => $data['lastName'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            
            'customer_since' => now(),
            'total_spent' => 0.00,
            
        ]);
        return redirect()->route('customer')->with('message', 'successfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
