<?php
namespace Atotrukis\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="event_keywords")
 */
class EventKeywords
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
    protected $keyword;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="keywords")
     * @ORM\JoinColumn(name="eventId", referencedColumnName="id")
     */
    protected $eventId;

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
     * Set userId
     *
     * @param \Atotrukis\MainBundle\Entity\User $userId
     * @return UserAttending
     */
    public function setUserId(\Atotrukis\MainBundle\Entity\User $userId = null)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \Atotrukis\MainBundle\Entity\User
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set eventId
     *
     * @param \Atotrukis\MainBundle\Entity\Event $eventId
     * @return UserAttending
     */
    public function setEventId(\Atotrukis\MainBundle\Entity\Event $eventId = null)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return \Atotrukis\MainBundle\Entity\Event
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set keyword
     *
     * @param string $keyword
     * @return EventKeywords
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return string 
     */
    public function getKeyword()
    {
        return $this->keyword;
    }
}
