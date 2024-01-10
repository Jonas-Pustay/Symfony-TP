<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Form\FeedbackType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    #[Route('/ShowFeedback', name: 'Feedback_list')]
    public function showFeedback(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        
        $obj1 = (object)['name' => 'Casque', 'price' => 42,];
        $obj2 = (object)['name' => 'Souris', 'price' => 23,];
        $obj3 = (object)['name' => 'Téléphone', 'price' => 200,];

        $products = [$obj1, $obj2, $obj3];
        return $this->render('feedback\showFeedback.html.twig', ['controller_name' => "ShowFeedback", 'feedbacks' => $products]);
    }

    #[Route('/EditFeedback/{id<\d+>}', name: 'EditFeedback')]
    public function EditFeedback($id, Request $request): Response
    {
        $Feedback = new Feedback();
        $FeedbackForm = $this->createForm(FeedbackType::class, $Feedback);
        $FeedbackForm->handleRequest($request);
        if ($FeedbackForm->isSubmitted() && $FeedbackForm->isValid())
        {
            // Traitement des données soumises, par exemple, enregistrement dans la base de données.
        // Pour l'instant, affichons simplement les données soumises :
            dump($request->request->all());
            
            return $this->render('feedback/SaveFeedback.html.twig', []);
        }

        return $this->render('feedback/EditFeedback.html.twig', [ 'feedbackform' => $FeedbackForm->createView(), ]);
    }
}
