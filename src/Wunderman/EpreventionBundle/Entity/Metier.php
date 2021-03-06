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
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity(repositoryClass="Wunderman\EpreventionBundle\Entity\Repository\MetierRepository")
 * @ORM\Table(name="metiers")}
 * @Serializer\ExclusionPolicy("all")
 * @UniqueEntity(
 *     fields={"titre"},
 *     message="This title is already in use"
 * )
 * @UniqueEntity(
 *     fields={"code"},
 *     message="This code is already in use"
 * )
 */
class Metier
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     * @Serializer\Groups({"metieruser"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please enter a clever title")
     * @Serializer\Expose()
     * @Serializer\Groups({"metieruser"})
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please enter a clever code")
     * @Serializer\Expose()
     * @Serializer\Groups({"metieruser"})
     */
    private $code;

    /**
     * @ORM\Column(name="remote_id", type="integer", nullable=true)
     * @Serializer\Exclude()
     */
    private $remote_id;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="metiers", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="metier_user")
     * @Assert\NotBlank(message="Please enter a clever user")
     * @Serializer\Expose()
     * @Serializer\Groups({"metieruser"})
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRemoteId()
    {
        return $this->remote_id;
    }

    /**
     * @param mixed $remote_id
     */
    public function setRemoteId($remote_id)
    {
        $this->remote_id = $remote_id;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users[] = $users;
    }



}