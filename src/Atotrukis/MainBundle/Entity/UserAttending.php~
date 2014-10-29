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
}
