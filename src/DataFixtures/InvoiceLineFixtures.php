<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Invoice;
use App\Entity\InvoiceLine;
use App\Entity\Track;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class InvoiceLineFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/Json/InvoiceLine.json'), true);
        foreach ($data as $row) {
            $invoice = $manager->find(Invoice::class, $row['InvoiceId']);
            $track = $manager->find(Track::class, $row['TrackId']);
            $invoiceLine = (new InvoiceLine())
                ->setId($row['InvoiceLineId'])
                ->setInvoice($invoice)
                ->setTrack($track)
                ->setUnitPrice($row['UnitPrice'])
                ->setQuantity($row['Quantity']);
            $manager->persist($invoiceLine);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            InvoiceFixtures::class,
            TrackFixtures::class,
        ];
    }
}
