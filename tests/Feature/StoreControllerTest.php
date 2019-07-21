<?php

namespace Tests\Feature;

use App\Store;
use Illuminate\Foundation\Testing\DatabaseTransactions;
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
}
