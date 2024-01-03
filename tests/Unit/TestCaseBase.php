<?php

namespace Tests\Unit;

use Faker\Factory;
use Prhost\Bling\Bling;
use PHPUnit\Framework\TestCase;

class TestCaseBase extends \Codeception\Test\Unit
{
    protected $faker;

    /**
     * @var Bling
     */
    protected $bling;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->faker = Factory::create('pt_BR');

        $this->bling = new Bling($_ENV['CLIENT_ID'], $_ENV['SECRET_KEY']);

        parent::__construct($name, $data, $dataName);
    }
}
