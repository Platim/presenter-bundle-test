<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Invoice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class InvoiceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/Json/Invoice.json'), true);
        foreach ($data as $row) {
            $customer = $row['CustomerId'] ? $manager->find(Customer::class, $row['CustomerId']) : null;
            $invoice = (new Invoice())
                ->setId($row['InvoiceId'])
                ->setCustomer($customer)
                ->setInvoiceDate($row['InvoiceDate'] ? new \DateTime($row['InvoiceDate']) : null)
                ->setBillingAddress($row['BillingAddress'])
                ->setBillingCity($row['BillingCity'])
                ->setBillingState($row['BillingState'])
                ->setBillingCountry($row['BillingCountry'])
                ->setBillingPostalCode($row['BillingPostalCode'])
                ->setTotal($row['Total']);
            $manager->persist($invoice);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CustomerFixtures::class,
        ];
    }
}
