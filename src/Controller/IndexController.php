<?php

namespace App\Controller;

use App\Form\User\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class IndexController
 */
class IndexController extends AbstractController
{
    /**
     * @Route("/", name = "app_home")
     *
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param RouterInterface               $router
     * @param FormFactoryInterface          $formFactory
     * @param AuthenticationUtils           $authenticationUtils
     *
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(
        AuthorizationCheckerInterface $authorizationChecker,
        RouterInterface $router,
        FormFactoryInterface $formFactory,
        AuthenticationUtils $authenticationUtils
    ) {
        if ($authorizationChecker->isGranted('ROLE_USER')) {
            return new RedirectResponse($router->generate('app_restaurant_index'));
        }

        $form = $formFactory->create(
            LoginType::class,
            [
                'username' => $authenticationUtils->getLastUsername(),
            ]
        );

        return $this->render(
            'user/login.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
