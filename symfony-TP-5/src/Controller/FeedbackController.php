<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Form\FeedbackType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    #[Route('/feedback', name: 'feedback')]
    public function feedback(Request $request): Response
    { 
        $feedback = new Feedback(); 
        $form = $this->createForm(FeedbackType::class, $feedback); 
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            $Result = $request->request->all();
            
            return $this->render('feedback/result.html.twig',
            [
                'name' => $Result['feedback']['nomClient'],
                'mail' => $Result['feedback']['emailClient'],
                'number' => $Result['feedback']['noteProduit'],
                'comment' => $Result['feedback']['commentaires'],
                'datetimet' => $Result['feedback']['dateSoumission']['date'],
            ]); 
        }
        
        return $this->render('feedback/index.html.twig', [ 'feedbackform' => $form->createView(), ]); 
    } 
}
