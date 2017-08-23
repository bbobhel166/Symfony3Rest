<?php

namespace Wunderman\EpreventionBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use JMS\Serializer\Annotation as Serializer;

use Wunderman\EpreventionBundle\Entity\Metier;
use Wunderman\EpreventionBundle\Entity\User;
use Wunderman\EpreventionBundle\Form\MetierType;


use FOS\RestBundle\View\View; // FOSRestBundle view to add location for post

class MetierController extends FOSRestController
{
    /**
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/metiers")
     */
    public function newAction(Request $request)
    {

        $metier = new Metier();
        $form = $this->createForm(MetierType::class, $metier);



        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {

            $em = $this->get('doctrine.orm.entity_manager');

            // Add user
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->find('1');

            $metier->setUsers($user);

            $em->persist($metier);
            $em->flush();

            // Create specific FOSRestBundle view response to include location header
            $view = View::create($metier);
            $view->setFormat('json');

            // Set location header
            $location = $this->generateUrl(
                'wunderman_eprevention_api_metier_show',
                ['code' => $metier->getCode()]
            );
            $view->setLocation($location);

            return $view;
            //return $metier;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\Get("/api/metiers/{code}")
     * @Rest\View(serializerGroups={"metieruser"})
     */
    public function showAction($code)
    {
        $metier = $this->getDoctrine()
            ->getRepository('EpreventionBundle:Metier')
            ->findOneByCode($code);

        if (!$metier) {
            throw $this->createNotFoundException(sprintf(
                'Metier inconuue : "%s"',
                $metier
            ));
        }

        return $metier;
    }

    /**
     *
     * @Rest\Get("/api/metiers")
     * @Rest\View(serializerGroups={"Default", "metieruser"})
     */
    public function listAction(Request $request)
    {
        $filter = $request->query->get('filter');

        $qb = $this->getDoctrine()
            ->getRepository('EpreventionBundle:Metier')
            ->findAllQueryBuilder($filter);

        $metiers = $this->get('pagination_factory')
            ->createCollection($qb, $request, 'wunderman_eprevention_api_metier_list');
        /* @var $metiers Metier[] */

        return $metiers;
    }


}
