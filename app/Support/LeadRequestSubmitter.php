<?php

declare(strict_types=1);

namespace App\Support;

use App\Data\LeadRequestData;
use App\Mail\LeadRequestMail;
use App\Models\LeadRequest;
use Illuminate\Support\Facades\Mail;
use InvalidArgumentException;

final class LeadRequestSubmitter
{
    public static function submit(LeadRequestData $data): LeadRequest
    {
        $recipient = config('landing.lead_mail_to');

        if (! is_string($recipient) || $recipient === '') {
            throw new InvalidArgumentException('LEAD_MAIL_TO is not configured');
        }

        $leadRequest = LeadRequest::query()->create([
            'phone' => $data->phone,
            'phone_display' => $data->phoneDisplay,
            'name' => $data->name,
            'source' => $data->source,
            'form_type' => $data->formType,
            'consent' => true,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        Mail::to($recipient)->send(new LeadRequestMail($leadRequest));

        return $leadRequest;
    }
}
