<?php

namespace App\Http\Controllers;

use App\Mail\DriverApplicationMail;
use App\Models\DriverApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class DriverApplicationController extends Controller
{
    public function show()
    {
        return view('drive-with-us');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'previous_driver' => 'required|string|in:Yes,No',
            'vehicle_option' => 'required|string|max:255',
            'pco_license' => 'nullable|string|max:255',
            'vehicle_details' => 'nullable|string|max:500',
            'agree_terms' => 'required',
        ], [
            'first_name.required' => 'Please enter your first name.',
            'last_name.required' => 'Please enter your last name.',
            'email.required' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter your mobile phone number.',
            'date_of_birth.required' => 'Please select your date of birth.',
            'previous_driver.required' => 'Please select whether you have driven for us before.',
            'vehicle_option.required' => 'Please select a vehicle option.',
            'agree_terms.required' => 'You must agree to the terms and privacy policy to submit.',
        ]);

        $application = DriverApplication::create([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'] ?? null,
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'date_of_birth' => $validated['date_of_birth'],
            'previous_driver' => $validated['previous_driver'],
            'vehicle_option' => $validated['vehicle_option'],
            'pco_license' => $request->input('pco_license'),
            'vehicle_details' => $request->input('vehicle_details'),
            'status' => 'pending',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Send Email to Admin
        $adminEmail = \SettingsHelper::get('company_email', env('MAIL_FROM_ADDRESS', 'admin@airportridesuk.com'));

        try {
            Mail::to($adminEmail)->send(new DriverApplicationMail($application));
        } catch (\Throwable $e) {
            Log::error('Driver application email delivery failed', [
                'driver_application_id' => $application->id,
                'error' => $e->getMessage(),
            ]);
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for your application! Your details have been submitted and saved. Our team will contact you shortly.',
            ]);
        }

        return back()->with('success', 'Thank you for your application! Your details have been submitted and saved. Our team will contact you shortly.');
    }
}
