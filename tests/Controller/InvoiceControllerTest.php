<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InvoiceControllerTest extends WebTestCase
{
    public function testCreate(): void
    {
        $client = static::createClient();

        $client->request('POST', '/invoice', [], [], [
            'CONTENT_TYPE' => 'application/json',
        ], json_encode([
            'customerId' => 1,
            'tracks' => [1, 2, 3],
        ]));

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('invoiceId', $response);
    }
}
