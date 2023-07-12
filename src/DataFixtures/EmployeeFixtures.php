<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmployeeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/Json/Employee.json'), true);
        foreach ($data as $row) {
            $reportsTo = $row['ReportsTo'] ? $manager->find(Employee::class, $row['ReportsTo']) : null;
            $employee = (new Employee())
                ->setId($row['EmployeeId'])
                ->setLastName($row['LastName'])
                ->setFirstName($row['FirstName'])
                ->setTitle($row['Title'])
                ->setReportsTo($reportsTo)
                ->setBirthDate($row['BirthDate'] ? new \DateTime($row['BirthDate']) : null)
                ->setHireDate($row['HireDate'] ? new \DateTime($row['HireDate']) : null)
                ->setAddress($row['Address'])
                ->setCity($row['City'])
                ->setState($row['State'])
                ->setCountry($row['Country'])
                ->setPostalCode($row['PostalCode'])
                ->setPhone($row['Phone'])
                ->setFax($row['Fax'])
                ->setEmail($row['Email']);
            $manager->persist($employee);
            $manager->flush();
        }
    }
}
