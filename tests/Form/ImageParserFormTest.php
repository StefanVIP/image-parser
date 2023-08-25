<?php

namespace App\Tests\Form;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ImageParserFormTest extends WebTestCase
{
    public function testFormSubmitWorkingUrl(): void
    {
        $client = static::createClient();
        $crawler = $client->request(method: 'GET', uri: '/');
        $client->submitForm('image_parser[parse]', [
            'image_parser[url]' => 'https://getcomposer.org/',
        ]);

        $this->assertResponseRedirects('/result?url=https://getcomposer.org/');
    }

    public function testFormValidateFakeURL(): void
    {
        $client = static::createClient();
        $crawler = $client->request(method: 'GET', uri: '/');
        $client->submitForm('image_parser[parse]', [
            'image_parser[url]' => 'https://getcomposer.orggg/',
        ]);

        $this->assertSelectorTextContains('body', 'This page is not available');
    }

    public function testFormValidateNotUrl(): void
    {
        $client = static::createClient();
        $crawler = $client->request(method: 'GET', uri: '/');
        $client->submitForm('image_parser[parse]', [
            'image_parser[url]' => 'parse image for me please',
        ]);

        $this->assertSelectorTextContains('form', 'The url "parse image for me please" is not a valid url');
    }

}