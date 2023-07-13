<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Invoice;
use App\Entity\InvoiceLine;
use App\Form\Data\InvoiceData;
use Doctrine\ORM\EntityManagerInterface;

class InvoiceService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function createInvoice(InvoiceData $invoiceData): Invoice
    {
        $invoice = (new Invoice())
            ->setCustomer($invoiceData->customer)
            ->setInvoiceDate(new \DateTime())
            ->setBillingAddress($invoiceData->billingAddress)
            ->setBillingCity($invoiceData->billingCity)
            ->setBillingState($invoiceData->billingState)
            ->setBillingCountry($invoiceData->billingCountry)
            ->setBillingPostalCode($invoiceData->billingPostalCode);
        $this->entityManager->persist($invoice);

        $total = 0;
        foreach ($invoiceData->tracks as $track) {
            $invoiceLine = (new InvoiceLine())
                ->setInvoice($invoice)
                ->setTrack($track)
                ->setUnitPrice($track->getUnitPrice())
                ->setQuantity(1);
            $this->entityManager->persist($invoiceLine);
            $total += $track->getUnitPrice();
        }
        $invoice->setTotal($total);

        $this->entityManager->flush();

        return $invoice;
    }
}
