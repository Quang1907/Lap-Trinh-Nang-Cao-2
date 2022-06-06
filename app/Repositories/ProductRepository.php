<?php

namespace App\Repositories;

class ProductRepository extends EloquentRepository implements ProductRepositoryInterface
{
    public function getModel()
    {return \App\Models\Product::class;
        
    }

    public function loadProductFromShoppe()
    {
        return 'product from shoppe';
    }
}
