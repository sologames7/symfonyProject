<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TrainerController extends AbstractController
{
    public function number(): Response
    {
        $number = random_int(100, 1000);
        
        return $this->render('number.html.twig', [
            'number' => $number,
        ]);
    }
}