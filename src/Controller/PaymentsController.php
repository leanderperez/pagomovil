<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Transacciones;
use App\Form\PaymentsType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PaymentsController extends AbstractController
{
    public function __construct(EntityManagerInterface $en)
    {
        $this->en = $en;
    }


    #[Route('/payments', name: 'app_payments')]
    public function app_payments(Request $request,): Response
    {
        $pay = new Transacciones();
        $payments_form = $this->createForm(PaymentsType::class, $pay);
        $payments_form->handleRequest($request);
        if($payments_form->isSubmitted() && $payments_form->isValid())
        {
            $monto = $payments_form->get('monto')->getData();
            $saldo = $en->getBalance(User::class);
            if($saldo <  $monto){
                throw $this->createInvalidArgumentException('Saldo no disponible');
            }

        }

        return $this->render('payments/index.html.twig', [
            'payments_form' => $payments_form->createView(),
        ]);
    }
}
