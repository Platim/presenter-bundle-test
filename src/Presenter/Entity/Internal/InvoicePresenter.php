<?php

declare(strict_types=1);

namespace App\Presenter\Entity\Internal;

use App\Entity\Invoice;
use Platim\PresenterBundle\Attribute\AsPresenterHandler;

#[AsPresenterHandler(group: 'internal')]
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
