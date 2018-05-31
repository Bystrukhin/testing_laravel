<?php

namespace Tests\Unit;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{

    protected $product;

    public function setUp()
    {
        $this->product = new Product('Fallout 4', 59);
    }


    public function testProductHasName()
    {
        $this->assertEquals('Fallout 4', $this->product->getName());
    }

    public function testProductHasPrice()
    {
        $this->assertEquals(59, $this->product->getPrice());
    }
}