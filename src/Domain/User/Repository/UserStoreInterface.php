<?php

declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\User;
use Ramsey\Uuid\UuidInterface;

interface UserStoreInterface
{
    public function get(UuidInterface $uuid): User;

    public function store(User $user): void;
}
