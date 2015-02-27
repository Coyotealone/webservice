<?php

namespace Coyote\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\MappedSuperclass
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\HasLifecycleCallbacks()
 */
class Stuff
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
     * @var integer
     *
     * @ORM\Column(name="rarity", type="integer")
     */
    private $rarity;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var float
     *
     * @ORM\Column(name="weight", type="float")
     */
    private $weight;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Perso", inversedBy="owner")
     * @ORM\JoinColumn(name="perso_id", referencedColumnName="id")
     */
    private $stuffs;

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
     * Set name
     *
     * @param string $name
     * @return Stuff
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
     * Set rarity
     *
     * @param integer $rarity
     * @return Stuff
     */
    public function setRarity($rarity)
    {
        $this->rarity = $rarity;

        return $this;
    }

    /**
     * Get rarity
     *
     * @return integer 
     */
    public function getRarity()
    {
        return $this->rarity;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return Stuff
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
     * Set weight
     *
     * @param float $weight
     * @return Stuff
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return float 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set created_at
     * @ORM\PrePersist
     * @param \DateTime $createdAt
     * @return Stuff
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
     * @return Stuff
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
     * Set stuffs
     *
     * @param \Coyote\ApiBundle\Entity\Perso $stuffs
     * @return Stuff
     */
    public function setStuffs(\Coyote\ApiBundle\Entity\Perso $stuffs = null)
    {
        $this->stuffs = $stuffs;

        return $this;
    }

    /**
     * Get stuffs
     *
     * @return \Coyote\ApiBundle\Entity\Perso 
     */
    public function getStuffs()
    {
        return $this->stuffs;
    }
    
    public function __toString()
    {
        return $this->name;
    }
}
