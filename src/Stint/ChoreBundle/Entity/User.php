<?php

namespace Stint\ChoreBundle\Entity;

//use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Validator\Constraints as Assert;
//use Symfony\Component\Security\Core\User\UserInterface;

class User //implements UserInterface
{
  /**
   * @var integer
   */
  protected $id;
  protected $email;
  protected $name;
  
  protected $chores;
  protected $chore_lists;

  protected $owned_lists;
  protected $created_lists;
  protected $created_chores;

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    public function __construct()
    {
        $this->chores = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set chore_list
     *
     * @param Stint\ChoreBundle\Entity\ChoreList $choreList
     */
    public function setChoreList(\Stint\ChoreBundle\Entity\ChoreList $choreList)
    {
        $this->chore_list = $choreList;
    }

    /**
     * Get chore_list
     *
     * @return Stint\ChoreBundle\Entity\ChoreList 
     */
    public function getChoreList()
    {
        return $this->chore_list;
    }

    /**
     * Get created_chores
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCreatedChores()
    {
        return $this->created_chores;
    }

    /**
     * Add owned_lists
     *
     * @param Stint\ChoreBundle\Entity\ChoreList $ownedLists
     */
    public function addChoreList(\Stint\ChoreBundle\Entity\ChoreList $ownedLists)
    {
        $this->owned_lists[] = $ownedLists;
    }

    /**
     * Get owned_lists
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOwnedLists()
    {
        return $this->owned_lists;
    }

    /**
     * Get created_lists
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCreatedLists()
    {
        return $this->created_lists;
    }

    /**
     * Get chore_lists
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChoreLists()
    {
        return $this->chore_lists;
    }
}