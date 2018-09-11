<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Tests\Helper;


use App\Application\Command\User\SignUp\SignUpCommand;
use App\Infrastructure\User\Entity\User;
use League\Tactician\CommandBus;

class Command {
	public static function createUser(User $user, $client): void
	{
		$signUp = new SignUpCommand(
			$user->uuid()->toString(),
			$user->email(),
			$user->hashedPassword()
		);

		/** @var CommandBus $commandBus */
		$commandBus = $client->getContainer()->get('tactician.commandbus.command');
		$commandBus->handle($signUp);
	}
}