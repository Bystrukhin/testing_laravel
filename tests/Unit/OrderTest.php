<?php
/**
 * Created by PhpStorm.
 * User: dev15
 * Date: 5/29/18
 * Time: 4:37 PM
 */

namespace Tests\Unit;

use App\Product;
use App\Order;
use Tests\TestCase;

class OrderTest extends TestCase
{

    public function testOrderConsistsOfProducts ()
    {

        $order = $this->createOrderWithProducts();

        $this->assertCount(2, $order->products());

    }

    public function testOrderTotalCost ()
    {

        $order = $this->createOrderWithProducts();

        $this->assertEquals(71, $order->count());

    }

    public function createOrderWithProducts()
    {

        $order = new Order;

        $product = new Product ('Fallout 4', 59);
        $product2 = new Product('Product 2', 12);

        $order->add($product);
        $order->add($product2);

        return $order;
    }


}