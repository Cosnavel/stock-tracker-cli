<?php

namespace Tests\Feature;

use Tests\TestCase;

class InspiringCommandTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testInspiringCommand(): void
    {
        $this->artisan('inspiring')
             ->expectsOutput('Simplicity is the ultimate sophistication.')
             ->assertExitCode(0);
    }
}
