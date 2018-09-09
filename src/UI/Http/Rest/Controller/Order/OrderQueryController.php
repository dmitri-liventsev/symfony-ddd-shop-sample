<?php

namespace App\UI\Http\Rest\Controller\Order;

use App\Application\Query\Order\FindAllCustomerOrders\FindAllCustomerOrdersQuery;
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
	 *     "/orders/{user_uuid}/{page}",
	 *     name="orders_get",
	 *     methods={"GET"}
	 * )
	 *
	 * @throws \Assert\AssertionFailedException
	 */
	public function getAll(Request $request) {
		$userUuid = $request->get('user_uuid');
		$page = (int) $request->get('page', 0);

		Assertion::notNull($userUuid, "Uuid can\'t be null");
		Assertion::integer($page, "Page should be a number");

		$query = new FindAllCustomerOrdersQuery($page, $userUuid);
		$orders = $this->ask($query);

		return JsonResponse::create($orders);
	}
}