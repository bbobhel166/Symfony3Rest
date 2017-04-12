<?php
/**
 * Created by PhpStorm.
 * User: helvasb
 * Date: 23/01/2017
 * Time: 23:13
 */

namespace Wunderman\EpreventionBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity(repositoryClass="Wunderman\EpreventionBundle\Entity\Repository\TaskRepository")
 * @ORM\Table(name="task")}
 * @Serializer\ExclusionPolicy("all")
 */
class Task
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please enter a clever task")
     * @Serializer\Expose()
     */
    private $task;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please enter a clever estimation")
     * @Serializer\Expose()
     */
    private $estimation;

    /**
     * @ORM\Column(type="datetime")
     * @Serializer\Expose()
     */
    private $start;

    /**
     * @ORM\Column(type="datetime")
     * @Serializer\Expose()
     */
    private $end;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * @param mixed $task
     */
    public function setTask($task)
    {
        $this->task = $task;
    }

    /**
     * @return mixed
     */
    public function getEstimation()
    {
        return $this->estimation;
    }

    /**
     * @param mixed $estimation
     */
    public function setEstimation($estimation)
    {
        $this->estimation = $estimation;
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @return mixed
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param mixed $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }

}