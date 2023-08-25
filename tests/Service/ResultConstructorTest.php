<?php

namespace App\Tests\Service;

use App\Service\ResultConstructor;
use PHPUnit\Framework\TestCase;

class ResultConstructorTest extends TestCase
{
    public function testImageParser(): void
    {
        $resultConstructor = new ResultConstructor();
        $images = $resultConstructor->imageParser('https://en.wikipedia.org/wiki/SOLID');

        $this->assertIsArray($images);
        $this->assertArrayHasKey('https://en.wikipedia.org//static/images/icons/wikipedia.png', array_flip($images));
    }

    public function testAllImagesSize(): void
    {
        $resultConstructor = new ResultConstructor();
        $images = $resultConstructor->imageParser('https://en.wikipedia.org/wiki/SOLID');
        $allImagesSize = $resultConstructor->allImagesSize($images);

        $this->assertSame(0.03, $allImagesSize);
    }

    public function testAllImagesCount(): void
    {
        $resultConstructor = new ResultConstructor();
        $images = $resultConstructor->imageParser('https://en.wikipedia.org/wiki/SOLID');
        $allImagesCount = $resultConstructor->allImagesCount($images);

        $this->assertSame(6, $allImagesCount);
    }

}
