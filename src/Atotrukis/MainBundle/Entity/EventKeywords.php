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
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="keywords", cascade={"all"})
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
     * Set eventId
     *
     * @param Event $eventId
     * @return UserAttending
     */
    public function setEventId(Event $eventId = null)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return Event
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
