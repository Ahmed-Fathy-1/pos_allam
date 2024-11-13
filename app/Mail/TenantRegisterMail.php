<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TenantRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $email, $password, $message, $phone;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $password, $message, $phone)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->message = $message;
        $this->phone = $phone;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Tenant',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.tenant.tenant',
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
