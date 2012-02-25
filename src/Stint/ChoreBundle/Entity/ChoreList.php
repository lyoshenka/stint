<?php
namespace Stint\ChoreBundle\Entity;
//use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class ChoreList
{
  /**
   * @var integer
   */
  protected $id;
  protected $name;

  protected $creator;
  protected $owner;

  protected $chores;
  protected $users;

  public function __construct()
  {
    $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    $this->chores = new \Doctrine\Common\Collections\ArrayCollection();
  }

  /**
   * Get id
   *
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Add users
   *
   * @param Stint\ChoreBundle\Entity\User $users
   */
  public function addUser(\Stint\ChoreBundle\Entity\User $users)
  {
    $this->users[] = $users;
  }

  /**
   * Get users
   *
   * @return Doctrine\Common\Collections\Collection
   */
  public function getUsers()
  {
    return $this->users;
  }

  /**
   * Add chores
   *
   * @param Stint\ChoreBundle\Entity\Chore $chores
   */
  public function addChore(\Stint\ChoreBundle\Entity\Chore $chores)
  {
    $this->chores[] = $chores;
  }

  /**
   * Get chores
   *
   * @return Doctrine\Common\Collections\Collection
   */
  public function getChores()
  {
    return $this->chores;
  }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set creator
     *
     * @param Stint\ChoreBundle\Entity\User $creator
     */
    public function setCreator(\Stint\ChoreBundle\Entity\User $creator)
    {
        $this->creator = $creator;
    }

    /**
     * Get creator
     *
     * @return Stint\ChoreBundle\Entity\User 
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set owner
     *
     * @param Stint\ChoreBundle\Entity\User $owner
     */
    public function setOwner(\Stint\ChoreBundle\Entity\User $owner)
    {
        $this->owner = $owner;
    }

    /**
     * Get owner
     *
     * @return Stint\ChoreBundle\Entity\User 
     */
    public function getOwner()
    {
        return $this->owner;
    }
}