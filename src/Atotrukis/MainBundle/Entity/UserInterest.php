<?php
namespace Atotrukis\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    protected $valueFacebook;

    /**
     * @ORM\Column(type="integer", options={"default" = 0})
     */
    protected $valueGoogle;

    /**
     * @ORM\Column(type="integer", options={"default" = 0})
     */
    protected $valueOurPage;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userInterests")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    protected $userId;


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
     * Set valueFacebook
     *
     * @param integer $valueFacebook
     * @return UserInterest
     */
    public function setValueFacebook($valueFacebook)
    {
        $this->valueFacebook = $valueFacebook;

        return $this;
    }

    /**
     * Get valueFacebook
     *
     * @return integer 
     */
    public function getValueFacebook()
    {
        return $this->valueFacebook;
    }

    /**
     * Set valueGoogle
     *
     * @param integer $valueGoogle
     * @return UserInterest
     */
    public function setValueGoogle($valueGoogle)
    {
        $this->valueGoogle = $valueGoogle;

        return $this;
    }

    /**
     * Get valueGoogle
     *
     * @return integer 
     */
    public function getValueGoogle()
    {
        return $this->valueGoogle;
    }

    /**
     * Set valueOurPage
     *
     * @param integer $valueOurPage
     * @return UserInterest
     */
    public function setValueOurPage($valueOurPage)
    {
        $this->valueOurPage = $valueOurPage;

        return $this;
    }

    /**
     * Get valueOurPage
     *
     * @return integer 
     */
    public function getValueOurPage()
    {
        return $this->valueOurPage;
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
