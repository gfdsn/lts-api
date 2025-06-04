<?php

namespace App\Mail;

use App\Infrastructure\Persistence\User\Models\UserModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public readonly string $email,
        public readonly string $key,
    )
    {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset your password here!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.user.forgot_password',
            with: [
                "resetUrl" => $this->generateResetUrl(),
                'logo' => public_path('assets/logos/lopes-tecnico-soldadura-dark.png'),
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


    private function generateResetUrl(): string
    {
        return env('FRONT_URL') . '/reset-password?key=' . $this->key . '?email=' . $this->email;
    }
}
