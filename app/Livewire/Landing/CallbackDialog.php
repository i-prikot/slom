<?php

declare(strict_types=1);

namespace App\Livewire\Landing;

use App\Data\LeadRequestData;
use App\Support\LeadFormValidator;
use App\Support\LeadRequestSubmitter;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

final class CallbackDialog extends Component
{
    public bool $open = false;
    public string $name = '';
    public string $phone = '+7';
    public bool $consent = false;
    public string $source = 'unknown';

    public function submit(): void
    {
        $normalizedPhone = LeadFormValidator::normalizedPhone($this->phone);
        if ($normalizedPhone === null) {
            Toaster::error(LeadFormValidator::phoneErrorMessage());

            return;
        }

        if (! $this->consent) {
            Toaster::error(LeadFormValidator::consentErrorMessage());

            return;
        }

        LeadRequestSubmitter::submit(new LeadRequestData(
            phone: $normalizedPhone,
            phoneDisplay: $this->phone,
            name: $this->name !== '' ? $this->name : null,
            source: $this->source,
            formType: 'callback',
        ));

        $this->js('window.slomReachGoal && window.slomReachGoal("SEND")');

        Toaster::success('Спасибо! Перезвоним в течение 5 минут.');
        $this->reset(['name', 'consent']);
        $this->phone = '+7 ';
        $this->open = false;
    }

    public function render()
    {
        return view('livewire.landing.callback-dialog');
    }
}
