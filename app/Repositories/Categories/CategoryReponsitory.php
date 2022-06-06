<?php

namespace App\Repositories\Categories;

use App\Models\Category;
use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Validator;

class CategoryReponsitory extends EloquentRepository implements CategoryReponsitoryInterface
{
    public function getModel()
    {
        return \App\Models\Category::class;
    }
}
