<?php

namespace Tests\Feature;

use App\Store;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use MilesChou\Toggle\Toggle;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function shouldSeeNewStoreWhenAddDataOnStoreList()
    {
        /** @var Store $store */
        $store = Store::create(['name' => 'excepted-name', 'desc' => 'excepted-desc']);

        $this->get(route('store.index'))
            ->assertStatus(200)
            ->assertSee('excepted-name')
            ->assertSee('excepted-desc');

        $this->get(route('store.show', $store))
            ->assertSuccessful();
    }

    /**
     * @test
     */
    public function shouldSeeNewStoreNameWhenUpdateData()
    {
        /** @var Store $store */
        $store = Store::create(['name' => 'name', 'desc' => 'desc']);

        $this->put(route('store.update', $store->id), ['name' => 'excepted-name', 'desc' => 'excepted-desc'])
            ->assertStatus(302)
            ->assertRedirect(route('store.index'));

        $this->get(route('store.index'))
            ->assertStatus(200)
            ->assertSee('excepted-name')
            ->assertSee('excepted-desc');
    }

    /**
     * @test
     */
    public function shouldSeeHomeLink()
    {
        $store = Store::create(['name' => 'name', 'desc' => 'desc']);

        /** @var Toggle $toggle */
        $toggle = $this->app->make(Toggle::class);
        $toggle->result(array('is_show_home_on_home' => true));

        $this->get(route('store.index'))
            ->assertStatus(200)
            ->assertSee('回首頁');

        $this->get(route('store.create'))
            ->assertStatus(200)
            ->assertSee('回首頁');

        $this->get(route('store.edit', $store->id))
            ->assertStatus(200)
            ->assertSee('回首頁');

        $this->get(route('store.show', $store->id))
            ->assertStatus(200)
            ->assertSee('回首頁');
    }

    /**
     * @test
     */
    public function shouldNotSeeHomeLink()
    {
        $store = Store::create(['name' => 'name', 'desc' => 'desc']);

        /** @var Toggle $toggle */
        $toggle = $this->app->make(Toggle::class);
        $toggle->result(array('is_show_home_on_home' => false));

        $this->get(route('store.index'))
            ->assertStatus(200)
            ->assertDontSee('回首頁');

        $this->get(route('store.create'))
            ->assertStatus(200)
            ->assertSee('回首頁');

        $this->get(route('store.edit', $store->id))
            ->assertStatus(200)
            ->assertSee('回首頁');

        $this->get(route('store.show', $store->id))
            ->assertStatus(200)
            ->assertSee('回首頁');
    }
}
