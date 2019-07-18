<?php

namespace App\Controller;

use App\Form\User\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
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
     * @Route("/")
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
            return new RedirectResponse($router->generate('app_dashboard_dashboard_index'));
        }

        $form = $formFactory->create(
            LoginType::class,
            [
                'email' => $authenticationUtils->getLastUsername(),
            ]
        );

        if (null !== $error = $authenticationUtils->getLastAuthenticationError(true)) {
            $form->addError(new FormError($error->getMessage(), $error->getMessageKey(), $error->getMessageData()));
        }

        return
            $this->render(
                'home/index.html.twig',
                [
                    'form' => $form->createView(),
                ]
            );
    }
}
