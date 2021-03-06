<?php

namespace Atotrukis\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="event_photos")
 */
class EventPhoto
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="photos")
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
     * @return EventPhoto
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
}
