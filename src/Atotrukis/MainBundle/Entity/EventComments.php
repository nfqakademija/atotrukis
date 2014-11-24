<?php
namespace Atotrukis\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="event_comments")
 */
class EventComments
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
    protected $comment;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="comments", cascade={"all"})
     * @ORM\JoinColumn(name="eventId", referencedColumnName="id")
     */
    protected $eventId;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments", cascade={"all"})
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    protected $userId;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdOn;

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @param mixed $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
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
}
