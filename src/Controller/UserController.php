<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{

    public function __construct(EntityManagerInterface $en)
    {
        $this->en = $en;
    }


    #[Route('/register', name: 'userRegister')]
    public function userRegister(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $register_form = $this->createForm(UserType::class, $user);
        $register_form->handleRequest($request);
        if($register_form->isSubmitted() && $register_form->isValid()){
            $plaintextPassword = $register_form->get('password')->getData();

            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
            
            $user->setRoles(['ROLE_USER']);
            $this->en->persist($user);
            $this->en->flush();
            return $this->redirectToRoute('userRegister');
        }
        return $this->render('user/index.html.twig', [
            'register_form' => $register_form->createView(),
        ]);
    }
}
