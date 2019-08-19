<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TraductionController extends AbstractController
{
    /**
     * @Route("/traduction", name="traduction")
     */
    public function index(Request $request)
    {
        dump($request->attributes->get('_locale'));
        return $this->render('traduction/index.html.twig', [
            'trad' => 'Hello',
        ]);
    }
}
