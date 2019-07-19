<?php

namespace App\Controller\Restaurant;

use App\Entity\Restaurant\Restaurant;
use App\Form\Restaurant\RestaurantType;
use App\Repository\RestaurantRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/restaurant")
 * @Security("is_granted('ROLE_USER')")
 */
class RestaurantController extends AbstractController
{
    /**
     * @Route("/", name="app_restaurant_index", methods={"GET"})
     * @param Request              $request
     * @param RestaurantRepository $restaurantRepository
     *
     * @return Response
     */
    public function index(Request $request, RestaurantRepository $restaurantRepository): Response
    {


        return $this->render(
            'restaurant/index.html.twig',
            [
                'restaurants' => $restaurantRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="app_restaurant_new", methods={"GET","POST"})
     * @param Request $request
     *
     * @return Response
     */
    public function new(Request $request): Response
    {
        $restaurant = new Restaurant();
        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($restaurant);
            $entityManager->flush();

            return $this->redirectToRoute('app_restaurant_index');
        }

        return $this->render(
            'restaurant/new.html.twig',
            [
                'restaurant' => $restaurant,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="app_restaurant_show", methods={"GET"})
     * @param Restaurant $restaurant
     *
     * @return Response
     */
    public function show(Restaurant $restaurant): Response
    {
        return $this->render(
            'restaurant/show.html.twig',
            [
                'restaurant' => $restaurant,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="app_restaurant_edit", methods={"GET","POST"})
     * @param Request    $request
     * @param Restaurant $restaurant
     *
     * @return Response
     */
    public function edit(Request $request, Restaurant $restaurant): Response
    {
        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_restaurant_index');
        }

        return $this->render(
            'restaurant/edit.html.twig',
            [
                'restaurant' => $restaurant,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="app_restaurant_delete", methods={"DELETE"})
     * @param Request    $request
     * @param Restaurant $restaurant
     *
     * @return Response
     */
    public function delete(Request $request, Restaurant $restaurant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$restaurant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($restaurant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_restaurant_index');
    }
}
