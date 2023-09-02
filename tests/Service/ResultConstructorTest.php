<?php

namespace App\Tests\Service;

use App\Service\ResultConstructor;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResultConstructorTest extends WebTestCase
{
    public function testConstruct(): void
    {

        $resultConstructor = static::getContainer()->get(ResultConstructor::class);
        $images = $resultConstructor->construct('http://localhost/testPage');

        $this->assertIsArray($images);
        $this->assertArrayHasKey('images', $images);
    }

    public function testAllImagesSize(): void
    {
        $resultConstructor = static::getContainer()->get(ResultConstructor::class);
        $imagesSize = $resultConstructor->construct('http://localhost/testPage');


        $this->assertSame(1.14, $imagesSize['imagesSize']);
    }

    private static function resultConstructor(): ResultConstructor
    {
        return static::getContainer()->get(ResultConstructor::class);
    }
}
