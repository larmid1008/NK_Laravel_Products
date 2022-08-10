<?php

namespace App\Http\Controllers\V1;

use App\CommandBus\Commands\Products\CreateProductCommand;
use App\CommandBus\DataTransferObjects\Products\CreateProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Resources\Products\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $collection = QueryBuilder::for(Product::class)
            ->with(["categories"])
            ->allowedFilters(["title"])
            ->paginate()
            ->appends($request->query());

        return ProductResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductStoreRequest $request
     * @return Response
     * @throws UnknownProperties
     */
    public function store(ProductStoreRequest $request): Response
    {
        $dto = new CreateProductDTO($request->all());
        $command = new CreateProductCommand($dto);
        $product = ProductResource::make($command->execute());

        return new Response($product, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
