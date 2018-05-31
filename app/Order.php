<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{

    protected $products = [];

    public function add(Product $product)
    {
        $this->products[] = $product;
    }

    public function products()
    {
        return $this->products;
    }

    public function count()
    {
//        $totalCost = 0;
//
//        foreach ($this->products as $product) {
//            $totalCost += $product->getPrice();
//        }
//
//        return $totalCost;

        return array_reduce($this->products, function($carry, $product) {
           return $carry + $product->getPrice();
        });
    }

}
