<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'Test',
        ]);
    }
    
    public function submit(Request $request): Response
    {
        $name = $request->request->get('name'); 
        return new Response('Merci ' . $name . ', votre message a été reçu.');
    }
}
