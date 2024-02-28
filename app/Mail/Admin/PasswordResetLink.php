<?php

namespace App\Mail\Admin;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\PasswordResetToken;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetLink extends Mailable implements ShouldQueue
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
            subject: __('messages.admin.emails.password_reset_link.subject'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        PasswordResetToken::where(['email' => $this->admin->email])->delete();

        $token = Str::random(150);

        PasswordResetToken::insert([
            'email' => $this->admin->email,
            'token' => $token,
            'created_at' => now()
        ]);

        return new Content(
            markdown: 'mail.admins.password_reset_link',
            with: [
                'name' => $this->admin->name,
                'url' => route('admin.resetPasswordLink', $token),
                'body' => __('messages.admin.emails.password_reset_link.body')
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
