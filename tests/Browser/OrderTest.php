<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class OrderTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_order_can_be_added_through_the_form()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/orders')
                    ->assertSee('Create new order')
                    ->type('user_id', '1')
                    ->type('address', 'address')
                    ->type('order_info', 'order_info')
                    ->press('Save')
                    ->assertPathIs('/orders');
        });
    }
}
