<?php

namespace App\Http\Controllers;

use App\Mail\ContactInquiryMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10'],
        ];

        if ($request->filled('name')) {
            $rules['name'] = ['required', 'string', 'max:255'];
        } else {
            $rules['first_name'] = ['required', 'string', 'max:255'];
            $rules['last_name'] = ['nullable', 'string', 'max:255'];
        }

        $validated = $request->validate($rules);

        $firstName = trim((string) ($request->input('first_name') ?? ''));
        $lastName = trim((string) ($request->input('last_name') ?? ''));
        $fullName = trim((string) ($request->input('name') ?? ''));

        if ($fullName === '' && $lastName === '') {
            $fullName = $firstName;
        }

        if ($fullName !== '' && ($firstName === '' || $lastName === '')) {
            $nameParts = preg_split('/\s+/', $fullName, 2);
            $firstName = trim((string) ($nameParts[0] ?? '')) ?: 'Customer';
            $lastName = trim((string) ($nameParts[1] ?? '')) ?: 'Inquiry';
        }

        $message = ContactMessage::create([
            'first_name' => $firstName ?: 'Customer',
            'last_name' => $lastName ?: 'Inquiry',
            'email' => $validated['email'],
            'phone' => $request->input('phone'),
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'is_read' => false,
        ]);

        $adminEmail = \SettingsHelper::get('company_emailsssss', 'admin@airportridesuk.com');

        try {
            Mail::to($adminEmail)->send(new ContactInquiryMail($message));
        } catch (\Throwable $e) {
            Log::error('Contact inquiry email failed', [
                'contact_message_id' => $message->id,
                'error' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Your message has been submitted successfully.',
        ]);
    }

    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15);

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('admin.contact-messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
