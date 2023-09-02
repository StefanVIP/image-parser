<?php

namespace App\Tests\Controller;

use App\Service\ResultConstructor;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Service\UrlParser;
use Mockery as m;

class UrlParserTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Welcome to image parser');
    }

    public function testResultPage(): void
    {
        $client = static::createClient();

        $container = static::getContainer();
        $parser = m::mock(UrlParser::class);

        $parser
            ->shouldReceive('parse')
            ->once()
            ->andReturn(['https://image.com/image3.jpg']);

        $container->set(UrlParser::class, $parser);

        $resultConstructor = m::mock(ResultConstructor::class);

        $resultConstructor
            ->shouldReceive('construct')
            ->once()
            ->andReturn(['url' => 'https://image.com/',
                'imageCount' => 1,
                'imagesSize' => 0.2,
                'images' => [['https://image.com/image3.jpg']]
            ]);

        $container->set(ResultConstructor::class, $resultConstructor);

        $client->request('GET', '/result', ['url' => 'test']);

        $this->assertResponseIsSuccessful();
        self::assertSelectorTextContains('body', 'Images found: 1');
        self::assertSelectorTextContains('body', 'Size of all images: 0.2 mb');
        self::assertSelectorCount(1, 'img');
    }
}
