<?php


namespace App\Application\Command\User\SignUp;

use App\Application\Command\CommandHandlerInterface;
use App\Domain\User\Factory\UserFactory;
use App\Domain\User\Repository\UserStoreInterface;

class SignUpHandler implements CommandHandlerInterface
{
    public function __invoke(SignUpCommand $command): void
    {
        $user = $this->userFactory->register($command->uuid, $command->credentials);

        $this->userRepository->store($user);
    }

    public function __construct(UserFactory $userFactory, UserStoreInterface $userRepository)
    {
        $this->userFactory = $userFactory;
        $this->userRepository = $userRepository;
    }

    /**
     * @var UserFactory
     */
    private $userFactory;

    /**
     * @var UserStoreInterface
     */
    private $userRepository;
}
