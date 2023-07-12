<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CustomerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/Json/Customer.json'), true);
        foreach ($data as $row) {
            $supportRep = $row['SupportRepId'] ? $manager->find(Employee::class, $row['SupportRepId']) : null;
            $customer = (new Customer())
                ->setId($row['CustomerId'])
                ->setFirstName($row['FirstName'])
                ->setLastName($row['LastName'])
                ->setCompany($row['Company'])
                ->setAddress($row['Address'])
                ->setCity($row['City'])
                ->setState($row['State'])
                ->setCountry($row['Country'])
                ->setPostalCode($row['PostalCode'])
                ->setPhone($row['Phone'])
                ->setFax($row['Fax'])
                ->setPhone($row['Phone'])
                ->setEmail($row['Email'])
                ->setSupportRep($supportRep);
            $manager->persist($customer);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            EmployeeFixtures::class,
        ];
    }
}
