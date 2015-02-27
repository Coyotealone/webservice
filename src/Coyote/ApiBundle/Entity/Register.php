<?php

namespace Coyote\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Register
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Register
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
     * @var integer
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var string
     *
     * @ORM\Column(name="rank", type="string", length=255)
     */
    private $rank;

    /**
     * @ORM\ManyToOne(targetEntity="Guild", inversedBy="registers")
     * @ORM\JoinColumn(name="guild_id", referencedColumnName="id")
     */
    private $guilds;

    /**
     * @ORM\ManyToOne(targetEntity="Perso", inversedBy="registers")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */
    private $members;

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
     * Set level
     *
     * @param integer $level
     * @return Register
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set rank
     *
     * @param string $rank
     * @return Register
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return string 
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set created_at
     * @ORM\PrePersist
     * @param \DateTime $createdAt
     * @return Register
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
     * @return Register
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
     * Set guilds
     *
     * @param \Coyote\ApiBundle\Entity\Guild $guilds
     * @return Register
     */
    public function setGuilds(\Coyote\ApiBundle\Entity\Guild $guilds = null)
    {
        $this->guilds = $guilds;

        return $this;
    }

    /**
     * Get guilds
     *
     * @return \Coyote\ApiBundle\Entity\Guild 
     */
    public function getGuilds()
    {
        return $this->guilds;
    }

    /**
     * Set members
     *
     * @param \Coyote\ApiBundle\Entity\Perso $members
     * @return Register
     */
    public function setMembers(\Coyote\ApiBundle\Entity\Perso $members = null)
    {
        $this->members = $members;

        return $this;
    }

    /**
     * Get members
     *
     * @return \Coyote\ApiBundle\Entity\Perso 
     */
    public function getMembers()
    {
        return $this->members;
    }
}
