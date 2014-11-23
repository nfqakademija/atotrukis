<?php
namespace Atotrukis\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users_attending")
 */
class UserAttending
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="attendingTo")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    protected $userId;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="usersAttending")
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
     * @param User $userId
     * @return UserAttending
     */
    public function setUserId(User $userId = null)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return User
     */
    public function getUserId()
    {
        return $this->userId;
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
