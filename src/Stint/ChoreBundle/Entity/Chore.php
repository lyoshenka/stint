<?php
namespace Stint\ChoreBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Chore
{
  // periods
  const DAILY = 'daily',
  WEEKLY = 'weekly',
  MONTHLY = 'monthly',
  YEARLY = 'yearly',
    
  // monthly modes
  DAY_OF_WEEK = 'day_of_week',
  DAY_OF_MONTH = 'day_of_month';

  /**
   * @var integer
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @var string
   * @ORM\Column(type="text", length=255)
   * @Assert\NotBlank()
   * @Assert\MaxLength(10)
   */
  protected $description;

  /**
   * @var string
   * @ORM\Column(type="text", length=20)
   * @Assert\NotBlank()
   */
  protected $period;

  /**
   * @var integer
   * @ORM\Column(type="integer")
   * @Assert\NotBlank()
   */
  protected $frequency;

  /**
   * @var datetime
   * @ORM\Column(type="datetime")
   * @Assert\NotBlank()
   */
  protected $start_date;

  /**
   * @var integer
   * @ORM\Column(type="integer")
   */
  protected $end_count;

  /**
   * @var datetime
   * @ORM\Column(type="datetime")
   */
  protected $end_date;

  /**
   * @var integer
   * @ORM\Column(type="integer")
   */
  protected $weekdays;

  /**
   * @var string
   * @ORM\Column(type="text", length=20)
   */
  protected $monthly_mode;

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
}