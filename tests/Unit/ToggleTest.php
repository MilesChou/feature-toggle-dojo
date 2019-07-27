<?php

namespace Tests\Unit;

use MilesChou\Toggle\Toggle;
use Tests\TestCase;

class ToggleTest extends TestCase
{
    /**
     * @test
     */
    public function returnFeatureSetting()
    {
        $target = $this->app->make(Toggle::class);

        $this->assertTrue($target->isActive('open_feature'));
        $this->assertFalse($target->isActive('close_feature'));
        $this->assertFalse($target->isActive('unknown_feature'));
    }
}
