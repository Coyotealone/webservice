<?php

namespace Coyote\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Perso
 * @ORM\Entity
 */
class Perso
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
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var string
     *
     * @ORM\Column(name="class", type="string", length=255)
     */
    private $class;

    /**
     * @var string
     *
     * @ORM\Column(name="race", type="string", length=255)
     */
    private $race;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255)
     */
    private $sexe;

    /**
     * @ORM\OneToMany(targetEntity="Register", mappedBy="members")
     */
    private $registers;

    /**
     * @ORM\OneToMany(targetEntity="Stuff", mappedBy="stuffs")
     */
    private $owner;

    /**
     * @ORM\ManyToMany(targetEntity="Perso", mappedBy="myFriends")
     **/
    private $friendsWithMe;

    /**
     * @ORM\ManyToMany(targetEntity="Perso", inversedBy="friendsWithMe")
     * @ORM\JoinTable(name="Contact",
     *      joinColumns={@ORM\JoinColumn(name="perso_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="friend_perso_id", referencedColumnName="id")}
     *      )
     **/
    private $myFriends;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->registers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->owner = new \Doctrine\Common\Collections\ArrayCollection();
        $this->friendsWithMe = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myFriends = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Perso
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
     * Set level
     *
     * @param integer $level
     * @return Perso
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
     * Set class
     *
     * @param string $class
     * @return Perso
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set race
     *
     * @param string $race
     * @return Perso
     */
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return string 
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Perso
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Add registers
     *
     * @param \Coyote\ApiBundle\Entity\Register $registers
     * @return Perso
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

    /**
     * Add owner
     *
     * @param \Coyote\ApiBundle\Entity\Stuff $owner
     * @return Perso
     */
    public function addOwner(\Coyote\ApiBundle\Entity\Stuff $owner)
    {
        $this->owner[] = $owner;

        return $this;
    }

    /**
     * Remove owner
     *
     * @param \Coyote\ApiBundle\Entity\Stuff $owner
     */
    public function removeOwner(\Coyote\ApiBundle\Entity\Stuff $owner)
    {
        $this->owner->removeElement($owner);
    }

    /**
     * Get owner
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Add friendsWithMe
     *
     * @param \Coyote\ApiBundle\Entity\Perso $friendsWithMe
     * @return Perso
     */
    public function addFriendsWithMe(\Coyote\ApiBundle\Entity\Perso $friendsWithMe)
    {
        $this->friendsWithMe[] = $friendsWithMe;

        return $this;
    }

    /**
     * Remove friendsWithMe
     *
     * @param \Coyote\ApiBundle\Entity\Perso $friendsWithMe
     */
    public function removeFriendsWithMe(\Coyote\ApiBundle\Entity\Perso $friendsWithMe)
    {
        $this->friendsWithMe->removeElement($friendsWithMe);
    }

    /**
     * Get friendsWithMe
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFriendsWithMe()
    {
        return $this->friendsWithMe;
    }

    /**
     * Add myFriends
     *
     * @param \Coyote\ApiBundle\Entity\Perso $myFriends
     * @return Perso
     */
    public function addMyFriend(\Coyote\ApiBundle\Entity\Perso $myFriends)
    {
        $this->myFriends[] = $myFriends;

        return $this;
    }

    /**
     * Remove myFriends
     *
     * @param \Coyote\ApiBundle\Entity\Perso $myFriends
     */
    public function removeMyFriend(\Coyote\ApiBundle\Entity\Perso $myFriends)
    {
        $this->myFriends->removeElement($myFriends);
    }

    /**
     * Get myFriends
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyFriends()
    {
        return $this->myFriends;
    }
}
