<?php

namespace App\Mail\Admin;

use App\Helpers\Helper;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class TfaVerificationCode extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $admin)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('messages.admin.emails.tfa_verification.subject'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $email_verification = (new Helper)->generate_verification_code();

        $this->admin->update($email_verification);

        return new Content(
            markdown: 'mail.admins.tfa_verification_code',
            with: [
                'name' => $this->admin->name,
                'url' => config('app.url')."/admin",
                'verification_code' => $email_verification['verification_code'],
                'body' => trans_choice('messages.admin.emails.tfa_verification.body', config('app.otp_expiry_in_minutes'))
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
