<?php


namespace App\Controller\Dashboard;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="show_dashboard")
     */
    public function index()
    {
        return $this->render('dashboard/index.html.twig');
    }
}