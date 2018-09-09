<?php

namespace App\Infrastructure\Common\Log;

use Broadway\Domain\DomainMessage;

interface EventPublisher
{
    public function handle(DomainMessage $message): void;

    public function publish(): void;
}
