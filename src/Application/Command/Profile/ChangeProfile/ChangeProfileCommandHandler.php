<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Application\Command\Profile;


use App\Application\Command\CommandHandlerInterface;
use App\Domain\Profile\Repository\ProfileStoreInterface;

class ChangeProfileCommandHandler implements CommandHandlerInterface {
	/** @var  ProfileStoreInterface */
	private $profileStore;

	/**
	 * ChangeProfileCommandHandler constructor.
	 *
	 * @param ProfileStoreInterface $profileStore
	 */
	public function __construct(ProfileStoreInterface $profileStore) {
		$this->profileStore = $profileStore;
	}

	public function __invoke(ChangeProfileCommand $command): void
	{
		$profile = $this->profileStore->get($command->uuid);
		$profile->change($command->address, $command->contact);
		$this->profileStore->store($profile);
	}
}