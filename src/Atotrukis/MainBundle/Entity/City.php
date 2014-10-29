<?php
namespace Atotrukis\MainBundle\Entity;

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
     * @ORM\OneToOne(targetEntity="Event", mappedBy="city")
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
     * Set priority
     *
     * @param \tinyint $priority
     * @return City
     */
    public function setPriority(\tinyint $priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return \tinyint 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set eventId
     *
     * @param \Atotrukis\MainBundle\Entity\Event $eventId
     * @return City
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
