<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Data\LeadRequestData;
use App\Livewire\Landing\CallbackDialog;
use App\Livewire\Landing\HeroLeadForm;
use App\Mail\LeadRequestMail;
use App\Support\LeadRequestSubmitter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use InvalidArgumentException;
use Livewire\Livewire;
use Tests\TestCase;

final class LeadRequestTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['landing.lead_mail_to' => 'leads@example.com']);
    }

    public function test_callback_dialog_submits_lead_and_sends_mail(): void
    {
        Mail::fake();

        Livewire::test(CallbackDialog::class)
            ->set('phone', '+7 (391) 205-15-15')
            ->set('name', 'Иван')
            ->set('consent', true)
            ->set('source', 'footer')
            ->call('submit')
            ->assertSet('open', false);

        $this->assertDatabaseHas('lead_requests', [
            'phone' => '73912051515',
            'phone_display' => '+7 (391) 205-15-15',
            'name' => 'Иван',
            'source' => 'footer',
            'form_type' => 'callback',
            'consent' => true,
        ]);

        Mail::assertSent(LeadRequestMail::class, function (LeadRequestMail $mail): bool {
            return $mail->hasTo('leads@example.com')
                && $mail->leadRequest->phone === '73912051515'
                && $mail->leadRequest->name === 'Иван';
        });
    }

    public function test_hero_lead_form_submits_lead_and_sends_mail(): void
    {
        Mail::fake();

        Livewire::test(HeroLeadForm::class)
            ->set('phone', '+7 (902) 990-50-05')
            ->set('consent', true)
            ->call('submit');

        $this->assertDatabaseHas('lead_requests', [
            'phone' => '79029905005',
            'phone_display' => '+7 (902) 990-50-05',
            'name' => null,
            'source' => 'hero',
            'form_type' => 'hero',
            'consent' => true,
        ]);

        Mail::assertSent(LeadRequestMail::class, function (LeadRequestMail $mail): bool {
            return $mail->hasTo('leads@example.com')
                && $mail->leadRequest->source === 'hero';
        });
    }

    public function test_submitter_throws_when_lead_mail_to_missing(): void
    {
        Mail::fake();
        config(['landing.lead_mail_to' => null]);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('LEAD_MAIL_TO is not configured');

        LeadRequestSubmitter::submit(new LeadRequestData(
            phone: '73912051515',
            phoneDisplay: '+7 (391) 205-15-15',
            source: 'hero',
            formType: 'hero',
        ));
    }

    public function test_submitter_does_not_create_record_when_lead_mail_to_missing(): void
    {
        Mail::fake();
        config(['landing.lead_mail_to' => '']);

        try {
            LeadRequestSubmitter::submit(new LeadRequestData(
                phone: '73912051515',
                phoneDisplay: '+7 (391) 205-15-15',
                source: 'hero',
                formType: 'hero',
            ));
        } catch (InvalidArgumentException) {
            // expected
        }

        $this->assertDatabaseCount('lead_requests', 0);
        Mail::assertNothingSent();
    }

    public function test_callback_dialog_rejects_invalid_phone(): void
    {
        Mail::fake();

        Livewire::test(CallbackDialog::class)
            ->set('phone', '+7 123')
            ->set('consent', true)
            ->call('submit');

        $this->assertDatabaseCount('lead_requests', 0);
        Mail::assertNothingSent();
    }

    public function test_hero_lead_form_rejects_missing_consent(): void
    {
        Mail::fake();

        Livewire::test(HeroLeadForm::class)
            ->set('phone', '+7 (391) 205-15-15')
            ->set('consent', false)
            ->call('submit');

        $this->assertDatabaseCount('lead_requests', 0);
        Mail::assertNothingSent();
    }
}
