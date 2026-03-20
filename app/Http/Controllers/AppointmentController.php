<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        $customers = Customer::all();
        $appointments = Appointment::all();

        return view('appointment.index', compact('services','customers','appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer' => 'required',
            'service' => 'required',
            'date' => 'required',
            'time' => 'required',
            'note' => 'required',
            'duration'  => 'required'
        ]);

        $data = $request->all();
                $userID = User::where('email', 'admin@admin.com')->value('id');
        // get price from service 
        $service_id = $data['service'];
        $service_price = Service::where('id', $service_id)->value('base_price');

        Appointment::create([
            'user_id' => $userID,
            'customer_id' => $data['customer'],
            'services_id' => $data['service'],
            'appointment_date' => $data['date'],
            'start_time' => $data['time'],
            'duration_minutes' => $data['duration'],
            'price' => $service_price,
            'payment_status' => 'pending',
            'notes' => $data['note']
        ]);

        return redirect()->route('appointment');


        

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
