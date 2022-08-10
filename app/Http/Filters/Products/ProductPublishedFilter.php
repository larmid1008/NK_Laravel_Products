<?php

namespace App\Http\Filters\Products;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;


class ProductPublishedFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->whereNotNull("published_at");
    }
}
