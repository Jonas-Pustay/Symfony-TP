<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Form\FeedbackType;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    #[Route('/ShowFeedback', name: 'Feedback_list')]
    public function showFeedback(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Feedback::class);
        $Feedbacks = $repository->findAll();

        return $this->render('feedback\showFeedback.html.twig', ['controller_name' => "ShowFeedback", 'feedbacks' => $Feedbacks]);
    }

    #[Route('/EditFeedback/{id<\d+>}', name: 'EditFeedback')]
    public function EditFeedback($id, Request $request, ManagerRegistry $doctrine): Response
    {
        $FeedbackID = $id;

        $entityManager = $doctrine->getManager();
        $Feedback = $entityManager->getRepository(Feedback::class)->find($FeedbackID);

        $FeedbackForm = $this->createForm(FeedbackType::class, $Feedback);
        $FeedbackForm->handleRequest($request);
        if ($FeedbackForm->isSubmitted() && $FeedbackForm->isValid())
        {
            $entityManager = $doctrine->getManager();
            $client = $FeedbackForm->getData();
            $entityManager->persist($client);
            $entityManager->flush();
            
            return $this->render('feedback/SaveFeedback.html.twig', [ 'feedbackid' => $FeedbackID ]);
        }

        return $this->render('feedback/EditFeedback.html.twig', [ 'feedbackform' => $FeedbackForm->createView(), 'feedbackid' => $FeedbackID ]);
    }

        #[Route('/RemoveFeedback/{id<\d+>}', name: 'Feedback_remove')]
        public function RemoveFeedback($id, ManagerRegistry $doctrine): Response
        {
            $FeedbackID = $id;

            $entityManager = $doctrine->getManager();
            $Feedback = $entityManager->getRepository(Feedback::class)->find($FeedbackID);
            if (!$Feedback)
            {
                throw $this->createNotFoundException('No customer found for id '.$FeedbackID);
            }
            $entityManager->remove($Feedback);
            $entityManager->flush();

            return $this->render('feedback\RemoveFeedback.html.twig', [ 'feedbackid' => $FeedbackID ]);
        }
}
