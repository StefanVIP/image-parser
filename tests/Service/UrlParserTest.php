<?php

namespace App\Tests\Service;

use App\Service\UrlParser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Mockery as m;

class UrlParserTest extends WebTestCase
{
    private UrlParser $parser;
    public function setUp(): void
    {
        parent::setUp();

        $html = <<<'HTML'
<!DOCTYPE html>
<html>
    <body>
        <table class="parsed_pictures">
            <tr>
                <td><img src="/image1.jpg" alt="Parsed picture"></td>
                <td><img src="/image2.jpg" alt="Parsed picture"></td>
            </tr>
        </table>
    </body>
</html>
HTML;

        $client = static::createClient();

        $container = static::getContainer();
        $this->parser = m::mock(UrlParser::class)->makePartial();

        $this->parser
            ->shouldReceive('htmlByUrl')
            ->andReturn($html);

        $container->set(UrlParser::class, $this->parser);
    }

    public function testImageParsing(): void
    {

        $images = $this->parser->parse('https://test.test/');

        $this->assertSame(2, count($images));
    }

    public function testImageUrlParsing(): void
    {
        $images = $this->parser->parse('https://test.test/');
        $this->assertArrayHasKey('https://test.test//image1.jpg', array_flip($images));
    }
}
