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
use Symfony\Component\Routing\Annotation\Route;

class OrderCommandController extends CommandController {

    /**
     * @Route(
     *     "/purchase",
     *     name="purchase",
     *     methods={"POST"},
     *     requirements={
     *      "user_uuid": "\d+",
     *      "product_uuid": "\d+",
     *      "amount": "\d+"
     * })
     *
     * @throws \Assert\AssertionFailedException
     * @throws \Exception
     */
	public function purchase(Request $request) {
		$userUuidString = $request->get('user_uuid');
		$productUuidString = $request->get('product_uuid');
		$amount = (int) $request->get('amount');
        $uuid = $request->get('uuid', Uuid::uuid4());

		Assertion::notNull($userUuidString, "User uuid can\'t be null");
		Assertion::notNull($productUuidString, "Product uuid can\'t be null");
		Assertion::notNull($amount, "Amount can\'t be null");
		Assertion::integer($amount, "Amount should be a number");

		$userUuid = Uuid::fromString($userUuidString);
		$productUuid = Uuid::fromString($productUuidString);

		$commandRequest = new PurchaseProductCommand($uuid, $userUuid, $productUuid, $amount);
		$this->exec($commandRequest);

		return JsonResponse::create(null, JsonResponse::HTTP_ACCEPTED);
	}
}