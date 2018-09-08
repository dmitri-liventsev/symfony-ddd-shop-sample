<?php

namespace App\UI\Http\Rest\Controller\Order;

use App\Application\Query\Order\PurchaseProduct\FindAllCustomerOrdersQuery;
use App\UI\Http\Rest\Controller\QueryController;
use Assert\Assertion;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class OrderQueryController extends QueryController {

	/**
	 * @Route(
	 *     "/orders/{page}",
	 *     name="orders_get",
	 *     methods={"GET"}
	 * )
	 *
	 * @throws \Assert\AssertionFailedException
	 */
	public function getAll(Request $request) {
		$page = $request->get('page', 0);
		$userUuid = $request->get('user_uuid');

		Assertion::notNull($userUuid, "Uuid can\'t be null");
		Assertion::integer($page, "Page should be a number");

		$query = new FindAllCustomerOrdersQuery($page, $userUuid);
		$orders = $this->ask($query);

		return JsonResponse::create($orders);
	}
}