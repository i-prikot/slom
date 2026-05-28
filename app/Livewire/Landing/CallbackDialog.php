<?php

declare(strict_types=1);

namespace App\Livewire\Landing;

use Livewire\Component;
use Masmerise\Toaster\Toaster;

final class CallbackDialog extends Component
{
    public bool $open = false;
    public string $name = '';
    public string $phone = '+7 ';
    public bool $consent = false;
    public string $source = 'unknown';

    public function openDialog(string $source = 'unknown'): void
    {
        $this->source = $source;
        $this->open = true;
    }

    public function closeDialog(): void
    {
        $this->open = false;
    }

    public function updatedPhone(string $value): void
    {
        $digits = substr(preg_replace('/\D+/', '', $value) ?? '', 0, 11);
        if ($digits === '') {
            $this->phone = '';

            return;
        }

        $out = '+7';
        if (strlen($digits) > 1) {
            $out .= ' ('.substr($digits, 1, 3);
        }
        if (strlen($digits) >= 4) {
            $out .= ') ';
            $out .= substr($digits, 4, 3);
        }
        if (strlen($digits) >= 7) {
            $out .= '-'.substr($digits, 7, 2);
        }
        if (strlen($digits) >= 9) {
            $out .= '-'.substr($digits, 9, 2);
        }

        $this->phone = $out;
    }

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
