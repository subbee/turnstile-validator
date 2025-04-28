<?php

namespace TurnstileValidator\Tests;

use Orchestra\Testbench\TestCase;
use TurnstileValidator\TurnstileValidator;

class TurnstileValidatorTest extends TestCase
{
    /** @test */
    public function it_returns_false_with_invalid_response()
    {
        $this->assertFalse(TurnstileValidator::verify('invalid-response'));
    }
}
