<?php

namespace App\Controller;

use App\Entity\Transacciones;
use App\Repository\TransaccionesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function app_dashboard(TransaccionesRepository  $TransaccionesRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $transacciones = $TransaccionesRepository->findByUser($this->getUser());   
        
        return $this->render('dashboard/index.html.twig', [
            'transacciones' => $transacciones,
        ]);
    }
}