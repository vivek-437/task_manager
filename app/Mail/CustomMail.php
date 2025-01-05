<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $body;
    public $cc;
    public $bcc;
    public $attachments;
    public $view;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $body, $attachments = [], $cc = [], $bcc = [],$view)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->attachments = $attachments;
        $this->cc = $cc;
        $this->bcc = $bcc;
        $this->view = $view;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // Setting the subject dynamically
        $envelope = new Envelope(
            subject: $this->subject,
        );

        // Adding CC and BCC if provided
        if (!empty($this->cc)) {
            $envelope->cc($this->cc);
        }

        if (!empty($this->bcc)) {
            $envelope->bcc($this->bcc);
        }

        return $envelope;
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->view, // Blade view for email content
            with: [
                'body' => $this->body, // Passing body content to the view
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        // Handle attachments if any
        foreach ($this->attachments as $attachment) {
            $attachments[] = new Attachment(
                path: $attachment['path'],
                name: $attachment['name'],
                mime: $attachment['mime']
            );
        }

        return $attachments;
    }
}
