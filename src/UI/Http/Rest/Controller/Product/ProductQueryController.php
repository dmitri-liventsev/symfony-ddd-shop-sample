<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\UI\Http\Rest\Controller\Product;


use App\Application\Query\Product\PurchaseProduct\FindAllProductsQuery;
use App\UI\Http\Rest\Controller\QueryController;
use Assert\Assertion;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductQueryController extends QueryController{

	/**
	 * @Route(
	 *     "/products/{page}",
	 *     name="products_get",
	 *     methods={"GET"}
	 * )
	 *
	 * @throws \Assert\AssertionFailedException
	 */
	public function getAll(Request $request) {
		$page = $request->get('page', 0);

		Assertion::integer($page, "Page should be a number");

		$query = new FindAllProductsQuery($page);
		$products = $this->ask($query);

		return JsonResponse::create($products);
	}
}