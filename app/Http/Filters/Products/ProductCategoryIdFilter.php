<?php

namespace App\Http\Filters\Products;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;


class ProductCategoryIdFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->whereHas("categories", static function(Builder $query) use ($value) {
            $query->where("categories.id", $value);
        });
    }
}
