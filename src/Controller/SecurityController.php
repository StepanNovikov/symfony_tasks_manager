<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class SecurityController extends AbstractController
{
    use TargetPathTrait;

    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $helper
     * @param Security $security
     * @return Response
     */
    public function login(AuthenticationUtils $helper, Security $security): Response
    {
        if ($security->isGranted('ROLE_USER') || $security->isGranted('ROLE_DEVELOPER') ||
            $security->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('show_dashboard');
        }

      return $this->render('security/login.html.twig', [
               'last_username' => $helper->getLastUsername(),
               'error'         => $helper->getLastAuthenticationError(),
      ]);

    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
