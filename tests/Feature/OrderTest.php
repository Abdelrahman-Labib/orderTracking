<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_can_be_added()
    {
        $order  = Order::factory()->create();

        $this->post('/orders', [
            'user_id' => $order->user_id,
            'address' => 'address',
            'order_info' => 'Information'
        ]);

        $this->assertCount(1, Order::all());
    }
}
