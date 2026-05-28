<?php

declare(strict_types=1);

namespace App\Livewire\Landing;

use Livewire\Component;
use Masmerise\Toaster\Toaster;

final class HeroLeadForm extends Component
{
    public string $phone = '+7 ';
    public bool $consent = false;

    public function submit(): void
    {
        $digits = preg_replace('/\D+/', '', $this->phone) ?? '';
        if (strlen($digits) < 11) {
            Toaster::error('Укажите корректный номер телефона');

            return;
        }
        if (! $this->consent) {
            Toaster::error('Подтвердите согласие с политикой конфиденциальности');

            return;
        }

        Toaster::success('Спасибо! Перезвоним за 5 минут.');
        $this->reset(['consent']);
        $this->phone = '+7 ';
    }

    public function render()
    {
        return view('livewire.landing.hero-lead-form');
    }
}
