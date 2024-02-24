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

    #[Route('/payments', name: 'app_payments')]
    public function app_payments(Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser(); // Obtener el usuario actual
        $form = $this->createForm(PaymentsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $phone = $data->getPhone();
            $identification = $data->getIdentificationNumber();
            $monto = $data->getMonto();

            // Obtener el saldo del usuario
            $saldo = $user->getBalance();

            // Validar si el saldo es mayor que el monto
            if ($saldo < $monto) {
                $this->addFlash('error', 'Saldo insuficiente.');

                return $this->redirectToRoute('app_payments');
            }

            // Restar el monto del saldo
            $user->setBalance($saldo - $monto);

            // Registrar la transacción
            $transaccion = new Transacciones();
            $transaccion->setUser($user);
            $transaccion->setPhone($phone);
            $transaccion->setIdentificationNumber($identification);
            $transaccion->setMonto($monto);

            $em->persist($user);
            $em->persist($transaccion);
            $em->flush();
            return $this->redirectToRoute('app_dashboard');

        }

        return $this->render('/payments/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
