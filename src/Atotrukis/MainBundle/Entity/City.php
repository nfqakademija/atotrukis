<?php
namespace Atotrukis\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cities")
 */
class City
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
     * @ORM\Column(type="integer", length=2)
     */
    protected $priority; //Didziuosius miestus iskelt i virsu

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
     * @return City
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
     * Constructor
     */
    public function __construct()
    {
        $this->eventId = new ArrayCollection();
    }

    /**
     * Add eventId
     *
     * @param Event $eventId
     * @return City
     */
    public function addEventId(Event $eventId)
    {
        $this->eventId[] = $eventId;

        return $this;
    }

    /**
     * Remove eventId
     *
     * @param Event $eventId
     */
    public function removeEventId(Event $eventId)
    {
        $this->eventId->removeElement($eventId);
    }

    /**
     * Set priority
     *
     * @param integer $priority
     * @return City
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }
}
