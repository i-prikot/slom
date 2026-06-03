<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\LeadRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class LeadRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public LeadRequest $leadRequest,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Новая заявка с сайта СЛОМ24',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.lead-request',
        );
    }
}
