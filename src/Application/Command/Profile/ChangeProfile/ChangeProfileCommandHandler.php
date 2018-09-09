<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Application\Command\Profile\ChangeProfile;


use App\Application\Command\CommandHandlerInterface;
use App\Domain\Profile\Projection\ProfileViewInterface;
use App\Domain\Profile\Repository\ProfileModelRepositoryInterface;
use App\Domain\Profile\Repository\ProfileStoreInterface;

class ChangeProfileCommandHandler implements CommandHandlerInterface {
	/** @var  ProfileStoreInterface */
	private $profileStore;

	/** @var  ProfileModelRepositoryInterface */
	private $profileRepository;

	/**
	 * ChangeProfileCommandHandler constructor.
	 *
	 * @param ProfileStoreInterface $profileStore
	 */
	public function __construct(ProfileStoreInterface $profileStore, ProfileModelRepositoryInterface $profileRepository) {
		$this->profileStore = $profileStore;
		$this->profileRepository = $profileRepository;
	}

	public function __invoke(ChangeProfileCommand $command): void
	{
		/** @var ProfileViewInterface $profileView */
		$profileView = $this->profileRepository->oneByUserUuid($command->userUuid);
		$profile = $this->profileStore->get($profileView->getUuid());

		$profile->change($command->userUuid, $command->address, $command->contact);
		$this->profileStore->store($profile);
	}
}