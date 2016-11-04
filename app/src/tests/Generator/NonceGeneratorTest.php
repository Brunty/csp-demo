<?php

namespace App\Tests\Generator;


use App\Generator\NonceGenerator;

class NonceGeneratorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var NonceGenerator
     */
    private $generator;

    public function setUp()
    {
        $this->generator = new NonceGenerator;
    }

    /** @test */
    public function it_only_ever_generates_a_single_nonce_even_on_subsequent_calls()
    {
        $nonce = $this->generator->generateNonce();

        self::assertEquals($nonce, $this->generator->generateNonce());
    }

    /** @test */
    public function it_only_ever_generates_a_single_nonce_even_on_subsequent_calls_with_different_lengths()
    {
        $nonce = $this->generator->generateNonce(32);

        self::assertEquals($nonce, $this->generator->generateNonce(64));
    }
}