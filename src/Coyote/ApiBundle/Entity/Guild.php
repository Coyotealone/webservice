<?php

namespace Coyote\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Guild
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Guild
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="banner", type="string", length=255)
     */
    private $banner;

    /**
     * @ORM\OneToMany(targetEntity="Register", mappedBy="guilds")
     */
    private $registers;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updated_at;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->registers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->created_at = new \DateTime('now');
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
     * Set name
     *
     * @param string $name
     * @return Guild
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
     * Set banner
     *
     * @param string $banner
     * @return Guild
     */
    public function setBanner($banner)
    {
        $this->banner = $banner;

        return $this;
    }

    /**
     * Get banner
     *
     * @return string 
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * Set created_at
     * @ORM\PrePersist
     * @param \DateTime $createdAt
     * @return Guild
     */
    public function setCreatedAt($createdAt)
    {
    	if(!$this->getCreatedAt())
    	{
    		$this->created_at = new \DateTime();
    	}
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     * @ORM\PreUpdate
     * @param \DateTime $updatedAt
     * @return Guild
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = new \DateTime();
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Add registers
     *
     * @param \Coyote\ApiBundle\Entity\Register $registers
     * @return Guild
     */
    public function addRegister(\Coyote\ApiBundle\Entity\Register $registers)
    {
        $this->registers[] = $registers;

        return $this;
    }

    /**
     * Remove registers
     *
     * @param \Coyote\ApiBundle\Entity\Register $registers
     */
    public function removeRegister(\Coyote\ApiBundle\Entity\Register $registers)
    {
        $this->registers->removeElement($registers);
    }

    /**
     * Get registers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRegisters()
    {
        return $this->registers;
    }
    
    public function __toString()
    {
        return $this->name;
    }
}
