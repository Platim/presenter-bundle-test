<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrackControllerTest extends WebTestCase
{
    public function testFilter(): void
    {
        $client = static::createClient();

        $client->request('GET', '/track', ['album' => 1]);

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('totalCount', $response);
        $this->assertArrayHasKey('page', $response);
        $this->assertArrayHasKey('pageCount', $response);
        $this->assertArrayHasKey('pageSize', $response);
        $this->assertArrayHasKey('items', $response);
        $this->assertEquals(10, $response['totalCount']);
    }

    public function testCustomFilter(): void
    {
        $client = static::createClient();

        $client->request('GET', '/track', ['price' => 'high']);

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('totalCount', $response);
        $this->assertArrayHasKey('page', $response);
        $this->assertArrayHasKey('pageCount', $response);
        $this->assertArrayHasKey('pageSize', $response);
        $this->assertArrayHasKey('items', $response);
        $this->assertEquals(213, $response['totalCount']);
    }
}
