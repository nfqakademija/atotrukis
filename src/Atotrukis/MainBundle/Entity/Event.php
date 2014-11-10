<?php
namespace Atotrukis\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Atotrukis\MainBundle\Validator\Constraints as CustomAssert;


/**
 * @ORM\Entity
 * @ORM\Table(name="events")
 * @CustomAssert\DateRange
 */
class Event
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $endDate;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="events")
     * @ORM\JoinColumn(name="createdBy", referencedColumnName="id")
     */
    protected $createdBy;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdOn;

    /**
     * @ORM\Column(type="string", length=2083)
     */
    protected $map;


    /**
     * @ORM\OneToMany(targetEntity="EventPhoto", mappedBy="eventId")
     */
    protected $photos;

    /**
     * @ORM\OneToMany(targetEntity="UserAttending", mappedBy="eventId")
     */
    protected $usersAttending;

    /**
     * @ORM\OneToMany(targetEntity="EventKeywords", mappedBy="eventId")
     */
    protected $keywords;

    /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="eventId")
     * @ORM\JoinColumn(name="city", referencedColumnName="id")
     */
    protected $city;


    public function __construct()
    {
        $this->createdOn = new \DateTime();
        //parent::__construct();
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
     * Set name
     *
     * @param string $name
     * @return Event
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set description
     *
     * @param string $description
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Event
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Event
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return Event
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return Event
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime 
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Add photos
     *
     * @param \Atotrukis\MainBundle\Entity\EventPhoto $photos
     * @return Event
     */
    public function addPhoto(\Atotrukis\MainBundle\Entity\EventPhoto $photos)
    {
        $this->photos[] = $photos;

        return $this;
    }

    /**
     * Remove photos
     *
     * @param \Atotrukis\MainBundle\Entity\EventPhoto $photos
     */
    public function removePhoto(\Atotrukis\MainBundle\Entity\EventPhoto $photos)
    {
        $this->photos->removeElement($photos);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Set map
     *
     * @param string $map
     * @return Event
     */
    public function setMap($map)
    {
        $this->map = $map;

        return $this;
    }

    /**
     * Get map
     *
     * @return string 
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * Set city
     *
     * @param \Atotrukis\MainBundle\Entity\City $city
     * @return Event
     */
    public function setCity(\Atotrukis\MainBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Atotrukis\MainBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Add usersAttending
     *
     * @param \Atotrukis\MainBundle\Entity\UserAttending $usersAttending
     * @return Event
     */
    public function addUsersAttending(\Atotrukis\MainBundle\Entity\UserAttending $usersAttending)
    {
        $this->usersAttending[] = $usersAttending;

        return $this;
    }

    /**
     * Remove usersAttending
     *
     * @param \Atotrukis\MainBundle\Entity\UserAttending $usersAttending
     */
    public function removeUsersAttending(\Atotrukis\MainBundle\Entity\UserAttending $usersAttending)
    {
        $this->usersAttending->removeElement($usersAttending);
    }

    /**
     * Get usersAttending
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsersAttending()
    {
        return $this->usersAttending;
    }


    /**
     * Add keywords
     *
     * @param \Atotrukis\MainBundle\Entity\EventKeywords $keywords
     * @return Event
     */
    public function addKeyword(\Atotrukis\MainBundle\Entity\EventKeywords $keywords)
    {
        $this->keywords[] = $keywords;

        return $this;
    }

    /**
     * Remove keywords
     *
     * @param \Atotrukis\MainBundle\Entity\EventKeywords $keywords
     */
    public function removeKeyword(\Atotrukis\MainBundle\Entity\EventKeywords $keywords)
    {
        $this->keywords->removeElement($keywords);
    }

    /**
     * Get keywords
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getKeywords()
    {
        return $this->keywords;
    }
}
