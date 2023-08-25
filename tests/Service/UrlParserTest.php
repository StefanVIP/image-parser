<?php

namespace App\Tests\Service;

use App\Service\UrlParser;
use PHPUnit\Framework\TestCase;

class UrlParserTest extends TestCase
{
    public function testImageParsing(): void
    {
        $url = 'https://en.wikipedia.org/wiki/SOLID';
        $parser = new UrlParser();
        $images = $parser->parse($url);

        $this->assertSame(6, count($images));
    }

    public function testImageUrlParsing(): void
    {
        $url = 'https://en.wikipedia.org/wiki/SOLID';
        $parser = new UrlParser();
        $images = $parser->parse($url);

        $this->assertArrayHasKey('/static/images/icons/wikipedia.png', array_flip($images));
    }
}
