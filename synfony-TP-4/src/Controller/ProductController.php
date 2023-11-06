<?php

namespace App\Controller;

use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/showProducts', name: 'products_list')]
    public function showProducts() : Response
    {
         $obj1 = (object) ['name' => 'Casque','price' => 42,];
         $obj2 = (object) ['name' => 'Souris','price' => 23,];
         $obj3 = (object) ['name' => 'Téléphone','price' => 200,];
         
         $products = [$obj1, $obj2, $obj3];
         return $this->render('product.html.twig', ['products' => $products,]);
    }

    #[Route('/category/{id<\d+>}', name: 'category_show')]
    public function getCategorie($id) : Response
    {
        $obj1 = (object) ['name' => 'Casque','price' => 42,];
        $obj2 = (object) ['name' => 'Souris','price' => 23,];
        $obj3 = (object) ['name' => 'Téléphone','price' => 200,];

        $products = [$obj1, $obj2, $obj3];
        $category_id = $id;
        
        return $this->render('category.html.twig', ['products' => $products,'id_category' => $category_id,]);
    }
}

?>