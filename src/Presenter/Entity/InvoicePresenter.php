<?php

declare(strict_types=1);

namespace App\Presenter\Entity;

use App\Entity\Invoice;
use Platim\PresenterBundle\Attribute\AsPresenterHandler;

#[AsPresenterHandler]
class InvoicePresenter
{
    public function __invoke(Invoice $invoice): array
    {
        return [
            'invoiceId' => $invoice->getId(),
            'total' => $invoice->getTotal(),
        ];
    }
}
