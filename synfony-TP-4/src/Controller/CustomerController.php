<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/showCustomers', name: 'cutomers_list')]
    public function showCustomers()
    {
        $obj1 = (object) ['name' => 'Jade','âge' => 42,];
        $obj2 = (object) ['name' => 'Wilfried','âge' => 23,];
        $obj3 = (object) ['name' => 'Oscar','âge' => 50,];

        $Customers = [$obj1, $obj2, $obj3];
        return $this->render('customers.html.twig', ['Customers' => $Customers,]);
    }
}

?>