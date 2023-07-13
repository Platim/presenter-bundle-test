<?php

declare(strict_types=1);

namespace App\Form\Data;

use App\Entity\Customer;
use App\Entity\Track;

class InvoiceData
{
    public Customer $customer;
    public ?string $billingAddress = null;
    public ?string $billingCity = null;
    public ?string $billingState = null;
    public ?string $billingCountry = null;
    public ?string $billingPostalCode = null;

    /**
     * @var Track[]
     */
    public array $tracks;
}
