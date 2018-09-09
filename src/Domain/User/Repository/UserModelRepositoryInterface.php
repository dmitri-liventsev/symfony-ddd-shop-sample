<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Projection\UserViewInterface;
use App\Domain\User\ValueObject\Email;
use Ramsey\Uuid\UuidInterface;

interface UserModelRepositoryInterface
{
    public function oneByUuid(UuidInterface $uuid): UserViewInterface;

    public function oneByEmail(Email $email): UserViewInterface;

    public function add(UserViewInterface $userRead): void;

    public function remove($userRead): void;

    public function apply(): void;
}
