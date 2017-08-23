<?php

namespace Wunderman\EpreventionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="Wunderman\EpreventionBundle\Entity\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @Serializer\ExclusionPolicy("all")
 */
class User extends BaseUser implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     * @Serializer\Groups({"metieruser"})
     */
    protected $id;

    /**
     * @var string
     * @Serializer\Expose()
     * @Serializer\Groups({"metieruser"})
     */
    protected $username;

    /**
     * Encrypted password. Must be persisted.
     * @Serializer\Groups({"details"})
     * @var string
     */
    protected $password;

    /**
     * @ORM\ManyToMany(targetEntity="Metier", mappedBy="users")
     * @Serializer\Groups({"metieruser"})
     */
    private $metiers;

    public function __construct()
    {
        parent::__construct();
        $this->metiers = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getMetiers()
    {
        return $this->metiers;
    }

    /**
     * @param mixed
     */
    public function setMetiers($Metiers)
    {
        $this->Metiers[] = $Metiers;
    }


}
