<?php

namespace App\Mail;

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
    public function __construct(public $user)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('messages.user.emails.tfa_verification.subject'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $email_verification = (new Helper)->generate_verification_code();

        $this->user->update($email_verification);

        return new Content(
            markdown: 'mail.users.tfa_verification_code',
            with: [
                'name' => $this->user->name,
                'url' => config('app.url'),
                'verification_code' => $email_verification['verification_code'],
                'body' => trans_choice('messages.user.emails.tfa_verification.body', config('app.otp_expiry_in_minutes'))
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
