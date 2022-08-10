<?php

namespace App\Http\Controllers\V1;

use App\CommandBus\Commands\Products\CreateProductCommand;
use App\CommandBus\DataTransferObjects\Products\CreateProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Resources\Products\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $collection = QueryBuilder::for(Product::class)
//            ->with(["categories"])
//            ->allowedFilters(["title"])
            ->paginate()
            ->appends($request->query());

        $products = ProductResource::collection($collection);

        return new Response($products, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws UnknownProperties
     */
    public function store(Request $request): Response
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
    public function show($id)
    {
        //
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
