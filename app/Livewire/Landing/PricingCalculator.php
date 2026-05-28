<?php

declare(strict_types=1);

namespace App\Livewire\Landing;

use App\Support\PricingEstimator;
use Livewire\Component;

final class PricingCalculator extends Component
{
    public int $step = 1;
    public ?string $workType = null;
    public string $material = 'concrete';
    public int $thicknessCm = 20;
    public float $lengthM = 2.0;
    public int $diameterMm = 100;
    public int $depthCm = 20;
    public int $presetIndex = 0;
    public int $quantity = 1;
    public array $coefIds = [];

    public function nextStep(): void
    {
        if ($this->step === 1 && in_array($this->workType, ['opening', 'demolition'], true)) {
            $this->step = 3;

            return;
        }
        $this->step = min(5, $this->step + 1);
    }

    public function prevStep(): void
    {
        if ($this->step === 3 && in_array($this->workType, ['opening', 'demolition'], true)) {
            $this->step = 1;

            return;
        }
        $this->step = max(1, $this->step - 1);
    }

    public function resetCalculator(): void
    {
        $this->reset();
        $this->step = 1;
        $this->material = 'concrete';
        $this->thicknessCm = 20;
        $this->lengthM = 2.0;
        $this->diameterMm = 100;
        $this->depthCm = 20;
        $this->presetIndex = 0;
        $this->quantity = 1;
    }

    public function toggleCoef(string $id): void
    {
        if (in_array($id, $this->coefIds, true)) {
            $this->coefIds = array_values(array_filter($this->coefIds, static fn (string $value): bool => $value !== $id));

            return;
        }
        $this->coefIds[] = $id;
    }

    public function getResultProperty(): ?array
    {
        if ($this->step !== 5 || $this->workType === null) {
            return null;
        }

        return PricingEstimator::calculate([
            'workType' => $this->workType,
            'material' => $this->material,
            'thicknessCm' => $this->thicknessCm,
            'lengthM' => $this->lengthM,
            'diameterMm' => $this->diameterMm,
            'depthCm' => $this->depthCm,
            'presetIndex' => $this->presetIndex,
            'quantity' => $this->quantity,
            'coefIds' => $this->coefIds,
        ]);
    }

    public function render()
    {
        return view('livewire.landing.pricing-calculator', [
            'cuttingPrices' => PricingEstimator::CUTTING_PRICES,
            'drillingPrices' => PricingEstimator::DRILLING_PRICES,
            'openingPrices' => PricingEstimator::OPENING_PRICES,
            'demolitionPrices' => PricingEstimator::DEMOLITION_PRICES,
            'coefficients' => PricingEstimator::COEFFICIENTS,
        ]);
    }
}
