<?php

namespace App\Http\Controllers\V1;

use App\CommandBus\Commands\Categories\CreateCategoryCommand;
use App\CommandBus\Commands\Categories\DeleteCategoryCommand;
use App\CommandBus\DataTransferObjects\Categories\CreateCategoryDTO;
use App\CommandBus\DataTransferObjects\Categories\DeleteCategoryDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CategoryDeleteRequest;
use App\Http\Requests\Categories\CategoryStoreRequest;
use App\Http\Resources\Categories\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $collection = QueryBuilder::for(Category::class)
            ->paginate()
            ->appends($request->query());

        return CategoryResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryStoreRequest $request
     * @return Response
     * @throws UnknownProperties
     */
    public function store(CategoryStoreRequest $request): Response
    {
        $dto = new CreateCategoryDTO($request->all());
        $command = new CreateCategoryCommand($dto);
        $category = CategoryResource::make($command->execute());

        return new Response($category, Response::HTTP_CREATED);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param CategoryDeleteRequest $request
     * @return Response
     * @throws UnknownProperties
     */
    public function destroy(CategoryDeleteRequest $request): Response
    {
        $dto = new DeleteCategoryDTO($request->all());
        $command = new DeleteCategoryCommand($dto);
        $command->execute();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
