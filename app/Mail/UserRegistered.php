<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class UserRegistered extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $receiver;
    public $password;
    public $fromAddress;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($receiver, $password,$fromAddress)
    {
        $this->receiver = $receiver;
        $this->password = $password;
        $this->fromAddress = $fromAddress;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address($this->fromAddress, 'Orangetoolz'),
            subject: 'User Registered',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.user.createAccount.index',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
