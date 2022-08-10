<?php

namespace App\Http\Controllers\V1;

use App\CommandBus\Commands\Products\CreateProductCommand;
use App\CommandBus\Commands\Products\DeleteProductCommand;
use App\CommandBus\Commands\Products\UpdateProductCommand;
use App\CommandBus\DataTransferObjects\Products\CreateProductDTO;
use App\CommandBus\DataTransferObjects\Products\DeleteProductDTO;
use App\CommandBus\DataTransferObjects\Products\UpdateProductDTO;
use App\Http\Controllers\Controller;
use App\Http\Filters\Products\ProductCategoryIdFilter;
use App\Http\Filters\Products\ProductCategoryTitleFilter;
use App\Http\Filters\Products\ProductEndPriceFilter;
use App\Http\Filters\Products\ProductPublishedFilter;
use App\Http\Filters\Products\ProductStartPriceFilter;
use App\Http\Requests\Products\ProductDeleteRequest;
use App\Http\Requests\Products\ProductStoreRequest;
use App\Http\Requests\Products\ProductUpdateRequest;
use App\Http\Resources\Products\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Spatie\QueryBuilder\AllowedFilter;
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
            ->allowedFilters([
                AllowedFilter::exact("title"),
                AllowedFilter::custom("category_id", new ProductCategoryIdFilter),
                AllowedFilter::custom("category_title", new ProductCategoryTitleFilter),
                AllowedFilter::custom("start_price", new ProductStartPriceFilter),
                AllowedFilter::custom("end_price", new ProductEndPriceFilter),
                AllowedFilter::custom("published_at", new ProductPublishedFilter),
                AllowedFilter::trashed()
            ])
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
        $product = Product::with("categories")->find($id);

        if($product === null) {
            return new Response($product, Response::HTTP_NOT_FOUND);
        }

        return new Response(ProductResource::make($product), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductUpdateRequest $request
     * @return Response
     * @throws UnknownProperties
     */
    public function update(ProductUpdateRequest $request): Response
    {
        $dto = new UpdateProductDTO($request->all());
        $productCommand = new UpdateProductCommand($dto);
        $product = $productCommand->execute();

        return new Response(ProductResource::make($product), Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductDeleteRequest $request
     * @return Response
     * @throws UnknownProperties
     */
    public function destroy(ProductDeleteRequest $request): Response
    {
        $dto = new DeleteProductDTO($request->all());
        $command = new DeleteProductCommand($dto);
        $command->execute();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
