<?php

declare(strict_types=1);

namespace App\Livewire\Landing;

use App\Data\LeadRequestData;
use App\Support\LeadFormValidator;
use App\Support\LeadRequestSubmitter;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

final class HeroLeadForm extends Component
{
    public string $phone = '+7 ';
    public bool $consent = false;

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
            source: 'hero',
            formType: 'hero',
        ));

        Toaster::success('Спасибо! Перезвоним за 5 минут.');
        $this->reset(['consent']);
        $this->phone = '+7 ';
    }

    public function render()
    {
        return view('livewire.landing.hero-lead-form');
    }
}
