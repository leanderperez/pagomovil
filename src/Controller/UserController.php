<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/register', name: 'userRegister')]
    public function userRegister(Request $request): Response
    {
        $user = new User();
        $register_form = $this->createForm(UserType, $user);
        return $this->render('user/index.html.twig', [
            'register_form' => register_form->createView(),
        ]);
    }
}
