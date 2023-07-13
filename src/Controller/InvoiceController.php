<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Invoice;
use App\Form\Data\InvoiceData;
use App\Form\InvoiceForm;
use App\Service\InvoiceService;
use Platim\PresenterBundle\Attribute\Presenter;
use Platim\PresenterBundle\Attribute\Request;
use Platim\PresenterBundle\Presenter\PresenterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    #[Route(path: '/invoice', methods: ['POST'])]
    public function create(
        InvoiceService $invoiceService,
        PresenterInterface $presenter,
        #[Request(formClass: InvoiceForm::class)]
        InvoiceData $invoiceData,
    ): JsonResponse {
        return $this->json($presenter->show($invoiceService->createInvoice($invoiceData)));
    }
}
