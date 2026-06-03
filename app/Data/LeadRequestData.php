<?php

declare(strict_types=1);

namespace App\Data;

final readonly class LeadRequestData
{
    public function __construct(
        public string $phone,
        public string $phoneDisplay,
        public string $source,
        public string $formType,
        public ?string $name = null,
    ) {}
}
