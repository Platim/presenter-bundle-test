<?php

declare(strict_types=1);

namespace App\Tests\Controller\Internal;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InvoiceControllerTest extends WebTestCase
{
    public function testNameConversation(): void
    {
        $client = static::createClient();

        $client->request('GET', '/internal/invoice/1');

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('invoice_id', $response);
        $this->assertArrayNotHasKey('lines', $response);
        $this->assertArrayNotHasKey('customer', $response);
    }

    public function testExpand(): void
    {
        $client = static::createClient();

        $client->request('GET', '/internal/invoice/1', ['expand' => 'customer,lines.track.album']);

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('customer', $response);
        $this->assertArrayHasKey('lines', $response);
        $this->assertArrayHasKey(0, $response['lines']);
        $this->assertArrayHasKey('track', $response['lines'][0]);
        $this->assertArrayHasKey('album', $response['lines'][0]['track']);
    }
}
