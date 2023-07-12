<?php

declare(strict_types=1);

namespace App\Controller\Internal;

use App\Entity\Invoice;
use Platim\PresenterBundle\Attribute\Presenter;
use Platim\PresenterBundle\Presenter\PresenterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class InvoiceController extends AbstractController
{
    #[Route(path: '/internal/invoice/{invoice<\d+>}', methods: ['GET'])]
    public function index(
        Invoice $invoice,
        #[Presenter(group: 'internal')]
        PresenterInterface $presenter,
    ): JsonResponse {
        return $this->json($presenter->show($invoice));
    }
}
