<?php

namespace App\Controller;

use App\Security\UserAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index()
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController'
        ]);
    }

    /**
     * @Route("/_navbar", name="navbar")
     */
    public function navbar(UserAuthenticator $userAuthenticator)
    {
        return $this->render('navbar.html.twig');
    }

    /**
     * @Route("/_dashboard", name="_dashboard")
     */
    public function dashboard()
    {
        return $this->render('dashboard/dashboard.html.twig');
    }
}
