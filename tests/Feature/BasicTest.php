<?php
namespace Tests\Feature;
use Tests\TestCase;
class BasicTest extends TestCase { public function test_home_route_is_available(): void { $this->get('/')->assertStatus(200); } }
