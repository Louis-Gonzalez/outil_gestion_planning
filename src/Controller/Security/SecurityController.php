<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authUtils): Response
    {
        return $this->render('Security/login.html.twig', [
            'error'=> $error = $authUtils->getLastAuthenticationError(),
            'lastname'=>$lastUsername = $authUtils->getLastUsername(),

        ]);
    }

    // #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    // public function register(Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $em) : Response 
    // {
    //     $user = new User;
    //     $form = $this->createForm(UserType::class, $user);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()){
    //         // TODO Hash paswword
    //         // dd($form->get('password')->getData());
    //         $user->setPassword(
    //             $hasher->hashPassword(
    //                 $user, 
    //                 $form->get('password')->getData() // plain password
    //                 )
    //             );
    //         // dd($user);
    //         $em->persist($user);
    //         $em->flush();

    //         $this->addFlash('success', 'Votre compte utilisateur a bien été créé.');
    //         return $this->redirectToRoute('login');
    //     }

    //     return $this->render('Security/register.html.twig', [
    //         'form'=> $form,
    //     ]);
    // }
}
