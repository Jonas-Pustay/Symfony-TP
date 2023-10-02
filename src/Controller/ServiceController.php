<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('service/index.html.twig', [
            'controller_name' => 'Page Service',
        ]);
    }
}
