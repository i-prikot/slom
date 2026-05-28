<?php

declare(strict_types=1);

namespace App\Support;

final class PricingEstimator
{
    private const MATERIAL_LABELS = [
        'concrete' => 'бетон',
        'monolith' => 'монолит',
        'brick' => 'кирпич',
        'unknown' => 'материал уточним',
    ];

    public const COEFFICIENT_LABELS = [
        'Высокое армирование (d > 12 мм) — 1,3',
        'Труднодоступные места, h до 1,5 м — 1,2',
        'Высотное сверление (h > 2 м) — 2',
        'Отсутствие воды на объекте — 1,1',
        'Зимние условия — 1,3',
        'Глубина сверления 0,5–1 м — 1,1',
        'Глубина 1–1,5 м — 1,2',
        'Глубина 1,5–2 м — 1,4',
        'Срочность исполнения — 1,3',
        'Сложное сверление — 1,3',
    ];

    public const CUTTING_PRICES = [
        ['thickness' => 'до 10 см', 'thicknessCm' => 10, 'concrete' => 900, 'monolith' => 1000, 'brick' => 900],
        ['thickness' => '10–15 см', 'thicknessCm' => 15, 'concrete' => 1300, 'monolith' => 1500, 'brick' => 950],
        ['thickness' => '16–20 см', 'thicknessCm' => 20, 'concrete' => 1800, 'monolith' => 2200, 'brick' => 1000],
        ['thickness' => '22 см', 'thicknessCm' => 22, 'concrete' => 2000, 'monolith' => 2420, 'brick' => 1400],
        ['thickness' => '25 см', 'thicknessCm' => 25, 'concrete' => 2300, 'monolith' => 2500, 'brick' => 1500],
        ['thickness' => '30 см', 'thicknessCm' => 30, 'concrete' => 2900, 'monolith' => 3300, 'brick' => 1500],
        ['thickness' => '35 см', 'thicknessCm' => 35, 'concrete' => 3300, 'monolith' => 3500, 'brick' => 1750],
        ['thickness' => '40 см', 'thicknessCm' => 40, 'concrete' => 3800, 'monolith' => 4000, 'brick' => 1800],
        ['thickness' => '45 см', 'thicknessCm' => 45, 'concrete' => 4300, 'monolith' => 4500, 'brick' => 2200],
        ['thickness' => '50 см', 'thicknessCm' => 50, 'concrete' => 4500, 'monolith' => 5000, 'brick' => 2500],
        ['thickness' => '55 см', 'thicknessCm' => 55, 'concrete' => 5500, 'monolith' => 6000, 'brick' => 2700],
        ['thickness' => '60 см', 'thicknessCm' => 60, 'concrete' => 6000, 'monolith' => 6500, 'brick' => 3000],
        ['thickness' => '65 см', 'thicknessCm' => 65, 'concrete' => 6500, 'monolith' => 7000, 'brick' => 3000],
        ['thickness' => '70 см', 'thicknessCm' => 70, 'concrete' => 7000, 'monolith' => 7500, 'brick' => 3500],
        ['thickness' => '75 см', 'thicknessCm' => 75, 'concrete' => 7500, 'monolith' => 8000, 'brick' => 3500],
    ];
    public const DRILLING_PRICES = [
        ['diameter' => '25–82 мм', 'diameterMm' => 82, 'price' => 25],
        ['diameter' => '92–132 мм (альп. форточки)', 'diameterMm' => 132, 'price' => 30],
        ['diameter' => '152–180 мм', 'diameterMm' => 180, 'price' => 40],
        ['diameter' => '200 мм', 'diameterMm' => 200, 'price' => 45],
        ['diameter' => '225–250 мм', 'diameterMm' => 250, 'price' => 70],
        ['diameter' => '300 мм', 'diameterMm' => 300, 'price' => 80],
        ['diameter' => '350 мм', 'diameterMm' => 350, 'price' => 120],
        ['diameter' => '400 мм', 'diameterMm' => 400, 'price' => 150],
        ['diameter' => '500 мм', 'diameterMm' => 500, 'price' => 200],
        ['diameter' => '600 мм', 'diameterMm' => 600, 'price' => 250],
        ['diameter' => '700 мм', 'diameterMm' => 700, 'price' => 350],
        ['diameter' => '800 мм', 'diameterMm' => 800, 'price' => 450],
    ];
    public const OPENING_PRICES = [
        ['type' => 'Проём с усилением, бетон 12 см', 'price' => '23 000 ₽', 'base' => 23000],
        ['type' => 'Проём с усилением, бетон 16 см', 'price' => '25 000 ₽', 'base' => 25000],
        ['type' => 'Проём с усилением, бетон 40 см', 'price' => '20 000 ₽', 'base' => 20000],
        ['type' => 'Проём с усилением, бетон 50 см', 'price' => '22 000 ₽', 'base' => 22000],
        ['type' => 'Проём без усиления, бетон 12 см', 'price' => 'от 7 000 ₽', 'base' => 7000],
        ['type' => 'Проём без усиления, бетон 16 см', 'price' => 'от 9 000 ₽', 'base' => 9000],
    ];
    public const DEMOLITION_PRICES = [
        ['type' => 'Санкабина бетон', 'price' => 'от 14 000 ₽', 'base' => 14000, 'unit' => 'шт'],
        ['type' => 'Санкабина гипсолит', 'price' => 'от 12 000 ₽', 'base' => 12000, 'unit' => 'шт'],
        ['type' => 'Стена гипсолит (1 м²)', 'price' => 'от 500 ₽', 'base' => 500, 'unit' => 'м²'],
        ['type' => 'Стена бетон до 10 см (1 м²)', 'price' => 'от 800 ₽', 'base' => 800, 'unit' => 'м²'],
        ['type' => 'Кирпич до 12,5 см (1 м²)', 'price' => 'от 900 ₽', 'base' => 900, 'unit' => 'м²'],
    ];
    public const COEFFICIENTS = [
        ['id' => 'noWater', 'label' => 'Нет воды на объекте', 'value' => 1.1, 'hint' => '+10%'],
        ['id' => 'urgent', 'label' => 'Срочно — сегодня/завтра', 'value' => 1.3, 'hint' => '+30%'],
        ['id' => 'highAlt', 'label' => 'Высотные работы (h > 2 м)', 'value' => 2.0, 'hint' => '×2'],
        ['id' => 'winter', 'label' => 'Зимние/неотапливаемые условия', 'value' => 1.3, 'hint' => '+30%'],
    ];

    public static function calculate(array $input): array
    {
        foreach (['workType', 'material', 'coefIds'] as $requiredKey) {
            if (! array_key_exists($requiredKey, $input)) {
                throw new \InvalidArgumentException("Missing calculator input: {$requiredKey}");
            }
        }

        $workType = (string) $input['workType'];
        $material = (string) $input['material'];
        if (! array_key_exists($material, self::MATERIAL_LABELS)) {
            throw new \InvalidArgumentException('Unsupported material value');
        }

        $breakdown = [];
        $base = 0.0;
        $summary = '';

        if ($workType === 'cutting') {
            $thicknessCm = (int) ($input['thicknessCm'] ?? 20);
            $row = self::nearestCutting($thicknessCm);
            $length = max(0.5, (float) ($input['lengthM'] ?? 1));
            $pricePerM = match ($material) {
                'concrete' => (int) $row['concrete'],
                'monolith' => (int) $row['monolith'],
                'brick' => (int) $row['brick'],
                'unknown' => (int) round(((int) $row['concrete'] + (int) $row['monolith'] + (int) $row['brick']) / 3),
                default => throw new \InvalidArgumentException('Unsupported material value'),
            };
            $base = $pricePerM * $length;
            $breakdown[] = 'Резка '.self::MATERIAL_LABELS[$material].", {$row['thickness']}: ".number_format($pricePerM, 0, '.', ' ')." ₽/п.м.";
            $breakdown[] = "Длина реза: {$length} п.м.";
            $summary = 'Алмазная резка, '.self::MATERIAL_LABELS[$material].", толщина {$row['thickness']}, {$length} п.м.";
        } elseif ($workType === 'drilling') {
            $diameterMm = (int) ($input['diameterMm'] ?? 100);
            $row = self::nearestDrilling($diameterMm);
            $depth = max(5, (int) ($input['depthCm'] ?? 20));
            $base = max(2000, $row['price'] * $depth);
            $breakdown[] = "Бурение ⌀{$row['diameter']}: {$row['price']} ₽/см";
            $breakdown[] = "Глубина: {$depth} см (мин. заказ 2 000 ₽)";
            $summary = "Алмазное бурение, ⌀{$row['diameter']}, глубина {$depth} см";
        } elseif ($workType === 'opening') {
            $presetIndex = (int) ($input['presetIndex'] ?? 0);
            if (! array_key_exists($presetIndex, self::OPENING_PRICES)) {
                throw new \InvalidArgumentException('Unsupported opening preset index');
            }
            $row = self::OPENING_PRICES[$presetIndex];
            $base = (float) $row['base'];
            $breakdown[] = "{$row['type']}: {$row['price']}";
            $summary = $row['type'];
        } elseif ($workType === 'demolition') {
            $presetIndex = (int) ($input['presetIndex'] ?? 0);
            if (! array_key_exists($presetIndex, self::DEMOLITION_PRICES)) {
                throw new \InvalidArgumentException('Unsupported demolition preset index');
            }
            $row = self::DEMOLITION_PRICES[$presetIndex];
            $quantity = max(1, (int) ($input['quantity'] ?? 1));
            $base = $row['unit'] === 'шт' ? (float) $row['base'] : (float) $row['base'] * $quantity;
            $breakdown[] = "{$row['type']}: {$row['price']}";
            if ($row['unit'] !== 'шт') {
                $breakdown[] = "Объём: {$quantity} м²";
            }
            $summary = $row['type'].($row['unit'] !== 'шт' ? ", {$quantity} м²" : '');
        } else {
            throw new \InvalidArgumentException('Unsupported work type');
        }

        $multiplier = 1.0;
        $coefIds = $input['coefIds'] ?? [];
        foreach (self::COEFFICIENTS as $coef) {
            if (in_array($coef['id'], $coefIds, true)) {
                $multiplier *= (float) $coef['value'];
                $breakdown[] = "Коэффициент: {$coef['label']} ({$coef['hint']})";
            }
        }

        $total = $base * $multiplier;
        $min = (int) round($total * 0.85);
        $max = (int) round($total * 1.15);

        return [
            'base' => $base,
            'multiplier' => $multiplier,
            'min' => $min,
            'max' => $max,
            'breakdown' => $breakdown,
            'summary' => $summary."\nОриентировочно: ".number_format($min, 0, '.', ' ')." – ".number_format($max, 0, '.', ' ')." ₽",
        ];
    }

    private static function nearestCutting(int $thicknessCm): array
    {
        $best = self::CUTTING_PRICES[0];
        foreach (self::CUTTING_PRICES as $row) {
            if (abs($row['thicknessCm'] - $thicknessCm) < abs($best['thicknessCm'] - $thicknessCm)) {
                $best = $row;
            }
        }

        return $best;
    }

    private static function nearestDrilling(int $diameterMm): array
    {
        $best = self::DRILLING_PRICES[0];
        foreach (self::DRILLING_PRICES as $row) {
            if (abs($row['diameterMm'] - $diameterMm) < abs($best['diameterMm'] - $diameterMm)) {
                $best = $row;
            }
        }

        return $best;
    }
}
