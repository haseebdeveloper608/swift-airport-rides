<?php

use App\Mail\ContactInquiryMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

test('contact form stores inquiry and sends email to admin', function () {
    Mail::fake();

    $response = $this->postJson('/contact-us', [
        'name' => 'James Thompson',
        'email' => 'james@example.com',
        'phone' => '+44 7700 000000',
        'subject' => 'booking',
        'message' => 'I need help with my booking.',
    ]);

    $response->assertOk()
        ->assertJsonPath('success', true);

    $this->assertDatabaseHas('contact_messages', [
        'first_name' => 'James',
        'last_name' => 'Thompson',
        'email' => 'james@example.com',
        'subject' => 'booking',
    ]);

    Mail::assertSent(ContactInquiryMail::class, function ($mail) {
        return $mail->hasTo('admin@admin.com');
    });
});
