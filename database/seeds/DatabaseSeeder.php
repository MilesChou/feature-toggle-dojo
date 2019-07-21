<?php

use App\Store;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (null === Store::find(1)) {
            /** @var Store $store */
            $store = Store::create([
                'name' => '食神',
                'desc' => '還是只能給零分',
            ]);

            $store->products()->create([
                'name' => '黯然銷魂飯',
                'price' => 100,
            ]);

            $store->products()->create([
                'name' => '甜在心饅頭',
                'price' => 90,
            ]);
        }
    }
}
