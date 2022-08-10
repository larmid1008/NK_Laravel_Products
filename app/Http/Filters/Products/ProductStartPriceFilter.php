<?php

namespace App\Http\Filters\Products;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;


class ProductStartPriceFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where("price", ">=", $value);
    }
}
