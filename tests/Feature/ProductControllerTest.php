<?php

namespace Tests\Feature;

use App\Product;
use App\Store;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use MilesChou\Toggle\Toggle;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function shouldSeeNewProductWhenAddDataOnStoreSite()
    {
        /** @var Store $store */
        $store = Store::create(['name' => 'test', 'desc' => 'for test']);

        $store->products()->create(['name' => 'excepted-name', 'price' => 100]);

        $this->get(route('store.show', $store->id))
            ->assertStatus(200)
            ->assertSee('excepted-name')
            ->assertSee('100');
    }

    /**
     * @test
     */
    public function shouldSeeNewStoreNameWhenUpdateData()
    {
        /** @var Store $store */
        $store = Store::create(['name' => 'test', 'desc' => 'for test']);

        /** @var Product $product */
        $product = $store->products()->create(['name' => 'name', 'price' => 0]);

        $this->put(route('product.update', $product->id), ['name' => 'excepted-name', 'price' => 100])
            ->assertStatus(302)
            ->assertRedirect(route('store.show', $store->id));

        $this->get(route('store.show', $store->id))
            ->assertStatus(200)
            ->assertSee('excepted-name')
            ->assertSee('100');
    }

    /**
     * @test
     */
    public function shouldSeeHomeLink()
    {
        /** @var Store $store */
        $store = Store::create(['name' => 'test', 'desc' => 'for test']);

        /** @var Toggle $toggle */
        $toggle = $this->app->make(Toggle::class);
        $toggle->result(array('is_show_home_on_product' => true));

        /** @var Product $product */
        $product = $store->products()->create(['name' => 'name', 'price' => 0]);

        $this->get(route('product.create'))
            ->assertStatus(200)
            ->assertSee('回首頁');

        $this->get(route('product.edit', $product->id))
            ->assertStatus(200)
            ->assertSee('回首頁');
    }

    /**
     * @test
     */
    public function shouldNotSeeHomeLink()
    {
        /** @var Store $store */
        $store = Store::create(['name' => 'test', 'desc' => 'for test']);

        /** @var Toggle $toggle */
        $toggle = $this->app->make(Toggle::class);
        $toggle->result(array('is_show_home_on_product' => false));

        /** @var Product $product */
        $product = $store->products()->create(['name' => 'name', 'price' => 0]);

        $this->get(route('product.create'))
            ->assertStatus(200)
            ->assertSee('回首頁');

        $this->get(route('product.edit', $product->id))
            ->assertStatus(200)
            ->assertDontSee('回首頁');
    }
}
