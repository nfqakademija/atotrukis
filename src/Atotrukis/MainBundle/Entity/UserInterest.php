<?php
namespace Atotrukis\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_interests")
 */
class UserInterest
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
     * @ORM\Column(type="integer", options={"default" = 0})
     */
    protected $value;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userInterests")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    protected $userId;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $updatedDate;

    public function __construct()
    {
        $this->updatedDate = date('Y-m-d');
        //parent::__construct();
    }

    /**
     * Get updatedDate
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updatedDate;
    }

    /**
     * Set updateDate
     *
     * @param \DateTime $updateDate
     * @return Event
     */
    public function setUpdateDate()
    {
        $this->updatedDate = new \DateTime();
        return $this;
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
     * Set keyword
     *
     * @param string $keyword
     * @return UserInterest
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

    /**
     * Set value
     *
     * @param integer $value
     * @return UserInterest
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set userId
     *
     * @param \Atotrukis\MainBundle\Entity\User $userId
     * @return UserInterest
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
}
