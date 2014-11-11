<?php
namespace Atotrukis\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity
* @ORM\Table(name="users")
*/
class User extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) */
    protected $facebook_id;

    /** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
    protected $facebook_access_token;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="createdBy")
     */
    protected $events;

    /**
     * @ORM\OneToMany(targetEntity="UserInterest", mappedBy="userId")
     */
    protected $interests;

    /**
     * @ORM\OneToMany(targetEntity="UserAttending", mappedBy="userId")
     */
    protected $attendingTo;

    public function __construct()
    {
        parent::__construct();
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
     * Add events
     *
     * @param \Atotrukis\MainBundle\Entity\Event $events
     * @return User
     */
    public function addEvent(\Atotrukis\MainBundle\Entity\Event $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param \Atotrukis\MainBundle\Entity\Event $events
     */
    public function removeEvent(\Atotrukis\MainBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Add interests
     *
     * @param \Atotrukis\MainBundle\Entity\UserInterests $interests
     * @return User
     */
    public function addInterest(\Atotrukis\MainBundle\Entity\UserInterests $interests)
    {
        $this->interests[] = $interests;

        return $this;
    }

    /**
     * Remove interests
     *
     * @param \Atotrukis\MainBundle\Entity\UserInterests $interests
     */
    public function removeInterest(\Atotrukis\MainBundle\Entity\UserInterests $interests)
    {
        $this->interests->removeElement($interests);
    }

    /**
     * Get interests
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInterests()
    {
        return $this->interests;
    }

    /**
     * Add attendingTo
     *
     * @param \Atotrukis\MainBundle\Entity\UserAttending $attendingTo
     * @return User
     */
    public function addAttendingTo(\Atotrukis\MainBundle\Entity\UserAttending $attendingTo)
    {
        $this->attendingTo[] = $attendingTo;

        return $this;
    }

    /**
     * Remove attendingTo
     *
     * @param \Atotrukis\MainBundle\Entity\UserAttending $attendingTo
     */
    public function removeAttendingTo(\Atotrukis\MainBundle\Entity\UserAttending $attendingTo)
    {
        $this->attendingTo->removeElement($attendingTo);
    }

    /**
     * Get attendingTo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAttendingTo()
    {
        return $this->attendingTo;
    }

    public function setEmail($email)
    {
        $email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        $this->setUsername($email);
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
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
     * Set facebook_id
     *
     * @param string $facebookId
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * Get facebook_id
     *
     * @return string 
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Set facebook_access_token
     *
     * @param string $facebookAccessToken
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebook_access_token
     *
     * @return string 
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }
}
