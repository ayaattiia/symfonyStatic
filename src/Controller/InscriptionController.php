<?php
// src/Controller/InscriptionController.php
namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class InscriptionController extends AbstractController
{

    /**
     *  nhotou l route fout l function toul 
     */
    #[Route('/number', name: 'app_number')]
    public function number(): Response
    {
        $number = random_int(0, 100);
        // return new Response(
        //     '<html><body>Ceci est une première page Symfony<br> Lucky number: ' . $number . '</body></html>'
        // );
        return $this->render('Inscription/accueil.html.twig', [
        'number' => $number,
        ]);
    }
    #[Route('/voir/{id}', name: 'voir', requirements: ['id' => '\d+'])]
    public function voir(int $id): Response
    {
    return $this->render('Inscription/voir.html.twig', [
    'id' => $id,
    ]);
    }


    #[Route('/Accueil', name: 'accueil')]
    public function accueil(): Response
    {
          return new Response(
            '<html><body>bienvenure a notre sitweb </body></html>'
        );
    }


}
