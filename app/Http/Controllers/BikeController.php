<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ValueObject\Uuid;
use App\Services\CreateBikeService;
use App\Services\SearchBikeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class BikeController extends Controller
{
    public function __construct(
        private CreateBikeService $createBikeService,
        private SearchBikeService $searchBikeService,
    ) {
    }

    public function create(Request $request): JsonResponse
    {
        $bikeId = Uuid::random();
        $name = $request->request->get('name');
        $description = $request->request->get('description');
        $price = $request->request->get('price');
        $manufacturer = $request->request->get('manufacturer');
        $items = (array)$request->request->get('items', []);

        $this->createBikeService->execute(
            $bikeId,
            $name,
            $description,
            $price,
            $manufacturer,
            $items,
        );

        return new JsonResponse(['id' => $bikeId->value()], Response::HTTP_CREATED);
    }

    public function search(Request $request): JsonResponse
    {
        $name = $request->get('name');
        $manufacturer = $request->get('manufacturer');
        $type = $request->get('type');
        $order = $request->get('order');

        $result = $this->searchBikeService->execute($name, $manufacturer, $type, $order);

        return new JsonResponse($result);
    }
}
