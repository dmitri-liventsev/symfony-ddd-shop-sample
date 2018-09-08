<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Application\Command\User\Remove;

use App\Application\Command\CommandHandlerInterface;
use App\Domain\User\Repository\UserRepositoryInterface;

class RemoveCommandHandler implements CommandHandlerInterface{

	/**
	 * @var UserRepositoryInterface
	 */
	private $userStore;

	public function __construct(UserRepositoryInterface $userStore)
	{
		$this->userStore = $userStore;
	}

	/**
	 * @param RemoveCommand $command
	 */
	public function __invoke(RemoveCommand $command): void
	{
		$user = $this->userStore->get($command->uuid);

		$user->remove();

		$this->userStore->store($user);
	}
}