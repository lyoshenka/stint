<?php

namespace Stint\ChoreBundle\Entity;

//use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class Chore
{
  // periods
  const
  DAILY = 'daily',
  WEEKLY = 'weekly',
  MONTHLY = 'monthly',
  YEARLY = 'yearly',

  // monthly modes
  DAY_OF_WEEK = 'day_of_week',
  DAY_OF_MONTH = 'day_of_month';

  
  protected $id;

  protected $description;
  protected $period;
  protected $frequency;
  protected $start_date;
  protected $end_count;
  protected $end_date;
  protected $weekdays;
  protected $monthly_mode;

  protected $creator;

  protected $users;
  protected $chore_list;


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
   * Set description
   *
   * @param text $description
   */
  public function setDescription($description)
  {
    $this->description = $description;
  }

  /**
   * Get description
   *
   * @return text
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set period
   *
   * @param text $period
   */
  public function setPeriod($period)
  {
    $this->period = $period;
  }

  /**
   * Get period
   *
   * @return text
   */
  public function getPeriod()
  {
    return $this->period;
  }

  /**
   * Set frequency
   *
   * @param integer $frequency
   */
  public function setFrequency($frequency)
  {
    $this->frequency = $frequency;
  }

  /**
   * Get frequency
   *
   * @return integer
   */
  public function getFrequency()
  {
    return $this->frequency;
  }

  /**
   * Set start_date
   *
   * @param datetime $startDate
   */
  public function setStartDate($startDate)
  {
    $this->start_date = $startDate;
  }

  /**
   * Get start_date
   *
   * @return datetime
   */
  public function getStartDate()
  {
    return $this->start_date;
  }

  /**
   * Set weekdays
   *
   * @param integer $weekdays
   */
  public function setWeekdays($weekdays)
  {
    $this->weekdays = $weekdays;
  }

  /**
   * Get weekdays
   *
   * @return integer
   */
  public function getWeekdays()
  {
    return $this->weekdays;
  }

  /**
   * Set monthly_mode
   *
   * @param text $monthlyMode
   */
  public function setMonthlyMode($monthlyMode)
  {
    $this->monthly_mode = $monthlyMode;
  }

  /**
   * Get monthly_mode
   *
   * @return text
   */
  public function getMonthlyMode()
  {
    return $this->monthly_mode;
  }

  /**
   * @return array Array of weekdays that are encoded as bits in weekdays integer (0 = Sun, 6 = Sat)
   */
  public function getWeekdaysArray()
  {
    $weekdays = array();
    foreach(range(0,6) as $weekday)
    {
      if ($this->getWeekdays() & pow($weekday,2))
      {
        $weekdays[] = $weekday;
      }
    }
    return $weekdays;
  }

  /**
   * Save array of weekdays as bits in integer
   * @param array $weekdays
   */
  public function setWeekdaysFromArray($weekdays)
  {
    $value = 0;
    foreach($weekdays as $weekday)
    {
      $value = $value | $weekday;
    }
    $this->setWeekdays($value);
  }

    /**
     * Set end_count
     *
     * @param integer $endCount
     */
    public function setEndCount($endCount)
    {
        $this->end_count = $endCount;
    }

    /**
     * Get end_count
     *
     * @return integer
     */
    public function getEndCount()
    {
        return $this->end_count;
    }

    /**
     * Set end_date
     *
     * @param datetime $endDate
     */
    public function setEndDate($endDate)
    {
        $this->end_date = $endDate;
    }

    /**
     * Get end_date
     *
     * @return datetime
     */
    public function getEndDate()
    {
        return $this->end_date;
    }
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
}