<?php

namespace Domain\Units\QueryBuilders;


use Illuminate\Database\Eloquent\Builder;

class UnitQueryBuilder extends Builder
{
    public function whereActive(Builder $builder)
    {
        $builder->where('active', 1);
    }
}
