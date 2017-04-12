<?php

namespace Wunderman\EpreventionBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use JMS\Serializer\Annotation as Serializer;

use Wunderman\EpreventionBundle\Entity\Task;
use Wunderman\EpreventionBundle\Form\TaskType;



class TaskController extends FOSRestController
{
    /**
     *
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/api/tasks")
     */
    public function newAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->submit($request->request->all()); // Validation des données

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($task);
            $em->flush();
            return $task;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\Get("/api/tasks/{id}")
     * @Rest\Post("/api/tasks")
     */
    public function showAction($id)
    {
        $task = $this->getDoctrine()
            ->getRepository('EpreventionBundle:Task')
            ->findOneById($id);

        if (!$task) {
            throw $this->createNotFoundException(sprintf(
                'Task inconuue : "%s"',
                $task
            ));
        }

        return $task;
    }

    /**
     *
     * @Rest\Get("/api/tasks")
     * @Rest\View(serializerGroups={"Default", "list"})
     */
    public function listAction(Request $request)
    {
         $filter = $request->query->get('filter');

        $qb = $this->getDoctrine()
            ->getRepository('EpreventionBundle:Task')
            ->findAllQueryBuilder($filter);

        $tasks = $this->get('pagination_factory')
            ->createCollection($qb, $request, 'wunderman_eprevention_api_task_list');
        /* @var $tasks Task[] */

        return $tasks;
    }


}
