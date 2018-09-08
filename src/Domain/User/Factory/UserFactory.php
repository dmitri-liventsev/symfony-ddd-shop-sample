<?php

namespace App\Domain\User\Factory;

use App\Domain\User\Exception\EmailAlreadyExistException;
use App\Domain\User\Repository\CheckUserByEmailInterface;
use App\Domain\User\User;
use App\Domain\User\ValueObject\Auth\Credentials;
use Ramsey\Uuid\UuidInterface;

class UserFactory
{
    public function register(UuidInterface $uuid, Credentials $credentials): User
    {
        if ($this->userCollection->existsEmail($credentials->email)) {
            throw new EmailAlreadyExistException('Email already registered.');
        }

        return User::create($uuid, $credentials);
    }

    public function __construct(CheckUserByEmailInterface $userCollection)
    {
        $this->userCollection = $userCollection;
    }

    /**
     * @var CheckUserByEmailInterface
     */
    private $userCollection;
}
