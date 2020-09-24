<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GreenhouseTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_create_a_greenhouse()
    {
        sleep(2);
        $this->assertTrue(true);
    }

    /** @test */
    public function greenhouse_has_an_owner()
    {
        sleep(3);
        $this->assertTrue(true);
    }

    /** @test */
    public function greenhouse_can_add_metrics()
    {
        sleep(4);
        $this->assertTrue(true);
    }

    /** @test */
    public function greenhouse_can_modify_environmental_conditions()
    {
        sleep(2);
        $this->assertTrue(true);
    }

    /** @test */
    public function greenhouse_can_modify_actuator_state()
    {
        sleep(4);
        $this->assertTrue(true);
    }




}
