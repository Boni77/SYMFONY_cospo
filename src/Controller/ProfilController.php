<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="app_profil")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $users = $doctrine->getRepository(User::class)->findAll();
        return $this->render('profil/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/profil/{id}", name="show_profil")
     */
    public function show(User $user)
    {
        return $this->render('profil/show.html.twig', [
            'user' => $user,
        ]);;
    }
}
