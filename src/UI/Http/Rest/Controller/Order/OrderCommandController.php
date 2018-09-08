<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\UI\Http\Rest\Controller\Order;


use App\Application\Command\Order\PurchaseProduct\PurchaseProductCommand;
use App\UI\Http\Rest\Controller\CommandController;
use Assert\Assertion;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class OrderCommandController extends CommandController {

	/**
	 * @Route(
	 *     "/purchase",
	 *     name="purchase",
	 *     methods={"POST"}
	 *     requirements={
	 *      "user_uuid": "\d+",
	 *      "product_uuid": "\d+",
	 *      "amount": "\d+"
	 * })
	 *
	 * @throws \Assert\AssertionFailedException
	 */
	public function purchase(Request $request) {
		$userUuidString = $request->get('user_uuid');
		$productUuidString = $request->get('product_uuid');
		$amount = $request->get('amount');

		Assertion::notNull($userUuidString, "Uuid can\'t be null");
		Assertion::notNull($productUuidString, "Uuid can\'t be null");
		Assertion::notNull($amount, "Uuid can\'t be null");
		Assertion::integer($amount, "Page should be a number");


		$uuid = Uuid::uuid1();
		$userUuid = Uuid::fromString($userUuidString);
		$productUuid = Uuid::fromString($productUuidString);

		$commandRequest = new PurchaseProductCommand($uuid, $userUuid, $productUuid, $amount);
		$this->exec($commandRequest);

		return JsonResponse::create(null, JsonResponse::HTTP_ACCEPTED);
	}
}