<?php
/**
 * Created by PhpStorm.
 * User: helvasb
 * Date: 28/01/2017
 * Time: 11:53
 */

namespace Wunderman\EpreventionBundle\Entity\Repository;

use Wunderman\EpreventionBundle\Entity\Metier;
use Doctrine\ORM\EntityRepository;


class TaskRepository extends EntityRepository
{
    public function findAllQueryBuilder($filter = '')
    {
        $qb = $this->createQueryBuilder('task');

        if ($filter) {
            $qb->andWhere('tasks.task LIKE :filter')
                ->setParameter('filter', '%'.$filter.'%');
        }

        return $qb;
    }

    /**
     * @param $id
     * @return Task
     */
    public function findOneById($id)
    {
        return $this->findOneBy(array('id' => $id));
    }
}